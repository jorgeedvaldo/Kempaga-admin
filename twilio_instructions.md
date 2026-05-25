# Twilio — Instruções de configuração e reversão

## Implementação actual: Twilio Verify API

O sistema usa a **Twilio Verify API (v2)** para enviar e verificar OTPs de pagamento.

### Como funciona

```
Utilizador → [Phone] → POST /send-otp
                ↓
    Twilio Verify API: POST /v2/Services/{ServiceSid}/Verifications
    { To: "+244...", Channel: "sms" }
    → Twilio gera e envia o OTP por SMS

Utilizador → [OTP] → POST /verify-otp
                ↓
    Twilio Verify API: POST /v2/Services/{ServiceSid}/VerificationChecks
    { To: "+244...", Code: "1234" }
    → Twilio responde { status: "approved" } ou { status: "pending" }
```

**Vantagens face à implementação anterior:**
- O Twilio gera o OTP — não é necessário guardar na tabela `phone_verifications`
- Rate limiting e anti-fraude incluídos
- Preço tipicamente igual ou inferior para Angola (+244)

---

## Configuração no painel admin

### 1. Aceder às definições de SMS
`Admin → Business Settings → SMS Module → Twilio`

### 2. Preencher os campos

| Campo | Valor | Obrigatório |
|---|---|---|
| Status | Ativo (1) | Sim |
| SID | `ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` | Sim |
| Token | `xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` | Sim |
| **Verify Service SID** | `VAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` | **Sim (Verify API)** |
| Messaging Service SID | *(deixar vazio)* | Não |
| From | *(deixar vazio)* | Não |
| OTP Template | *(deixar vazio)* | Não |

> **Nota:** O campo `verify_service_sid` começa sempre com `VA`. O campo `messaging_service_sid` começa com `MG`.

### 3. Como o sistema detecta qual API usar

O ficheiro `app/CentralLogics/SmsModule.php` método `usingTwilioVerify()`:

```php
// Se verify_service_sid estiver preenchido → Twilio Verify API
// Se estiver vazio → Legacy Messages API
return isset($config)
    && (int)($config['status'] ?? 0) === 1
    && !empty($config['verify_service_sid']);
```

### 4. Adicionar o campo verify_service_sid via SQL (se não aparecer no form)

Se o registo Twilio já existia na DB antes desta actualização, o campo pode não aparecer no formulário. Corrigir com:

```sql
UPDATE settings
SET live_values = JSON_SET(live_values, '$.verify_service_sid', ''),
    test_values = JSON_SET(test_values, '$.verify_service_sid', '')
WHERE key_name = 'twilio'
  AND settings_type = 'sms_config';
```

Depois guardar o formulário no admin com o valor `VA6f726f1d6b6eaf1616c799e70953530a`.

---

## Como reverter para a implementação anterior (Messages API)

### Opção A — Via painel admin (sem tocar no código)

1. Aceder a `Admin → Business Settings → SMS Module → Twilio`
2. **Apagar o conteúdo** do campo `Verify Service SID` (deixar vazio)
3. Preencher os campos legados:
   - **Messaging Service SID**: o SID do Messaging Service (começa com `MG...`)
   - **From**: número de telefone Twilio (ex: `+14155552671`)
   - **OTP Template**: texto da mensagem com `#OTP#` (ex: `O seu código Kempaga é #OTP#`)
4. Guardar

O sistema detecta automaticamente que `verify_service_sid` está vazio e volta ao fluxo antigo.

### Opção B — Via código (reverter o git)

```bash
# No servidor, dentro do projecto Kempaga-admin:
git log --oneline -5
git revert <hash-do-commit-twilio-verify>
php artisan cache:clear
php artisan config:clear
```

---

## Ficheiros alterados nesta implementação

| Ficheiro | O que mudou |
|---|---|
| `app/CentralLogics/SmsModule.php` | Adicionados métodos `usingTwilioVerify()`, `twilioVerifySend()`, `twilioVerifyCheck()`. O método legado `twilio()` manteve-se intacto. |
| `app/Http/Controllers/Payment/PaymentOrderController.php` | `sendOtp()`, `verifyOtp()` e `resendOtp()` detectam `usingTwilioVerify()` e usam o path correspondente. O código legado permanece no `else`. |
| `app/Http/Controllers/Admin/SMSModuleController.php` | Campos `messaging_service_sid`, `from` e `otp_template` passaram de `required` para `nullable`. Campo `verify_service_sid` adicionado como `nullable`. |

---

## Endpoints Twilio Verify de referência

### Enviar OTP
```bash
curl 'https://verify.twilio.com/v2/Services/{VERIFY_SERVICE_SID}/Verifications' \
  -X POST \
  --data-urlencode 'To=+244940590895' \
  --data-urlencode 'Channel=sms' \
  -u {ACCOUNT_SID}:{AUTH_TOKEN}
```

### Verificar OTP
```bash
curl 'https://verify.twilio.com/v2/Services/{VERIFY_SERVICE_SID}/VerificationChecks' \
  -X POST \
  --data-urlencode 'To=+244940590895' \
  --data-urlencode 'Code=123456' \
  -u {ACCOUNT_SID}:{AUTH_TOKEN}
```

### Resposta esperada ao enviar
```json
{ "status": "pending", "to": "+244940590895", "channel": "sms" }
```

### Resposta esperada ao verificar (código correcto)
```json
{ "status": "approved", "to": "+244940590895" }
```

### Resposta esperada ao verificar (código errado)
```json
{ "status": "pending", "to": "+244940590895" }
```
