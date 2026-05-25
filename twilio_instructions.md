# Twilio — Instruções de configuração e reversão

## Implementação actual: Twilio Verify API

O sistema usa a **Twilio Verify API (v2)** para enviar e verificar OTPs de pagamento.
Não foi adicionado nenhum campo novo — o campo **Messaging Service SID** existente
é reutilizado para guardar o Verify Service SID (que começa com `VA`).

### Como funciona

```
Utilizador → [Phone] → POST /send-otp
                ↓
    Twilio Verify API: POST /v2/Services/{messaging_service_sid}/Verifications
    { To: "+244...", Channel: "sms" }
    → Twilio gera e envia o OTP por SMS (sem guardar na DB)

Utilizador → [OTP] → POST /verify-otp
                ↓
    Twilio Verify API: POST /v2/Services/{messaging_service_sid}/VerificationChecks
    { To: "+244...", Code: "1234" }
    → Twilio responde { status: "approved" } ou { status: "pending" }
```

### Como o sistema detecta qual API usar

O campo `messaging_service_sid` no painel admin determina o comportamento:

| Valor do campo | API usada |
|---|---|
| Começa com `VA...` | **Twilio Verify API** (implementação actual) |
| Começa com `MG...` | Legacy Twilio Messages API |

Código em `app/CentralLogics/SmsModule.php`:

```php
public static function usingTwilioVerify(): bool
{
    $config = self::get_settings('twilio');
    return isset($config)
        && (int)($config['status'] ?? 0) === 1
        && str_starts_with($config['messaging_service_sid'] ?? '', 'VA');
}
```

---

## Configuração no painel admin

`Admin → Business Settings → SMS Module → Twilio`

Não é necessário alterar os campos — o sistema lê os dados já existentes.

O campo **Messaging Service SID** deve conter o **Verify Service SID** (começa com `VA`).
Se contiver um Messaging Service SID (começa com `MG`), o sistema volta automaticamente
ao fluxo legado.

---

## Como reverter para a implementação anterior (Messages API)

### Opção A — Via painel admin (sem tocar no código)

1. Aceder a `Admin → Business Settings → SMS Module → Twilio`
2. Substituir o valor do campo **Messaging Service SID** pelo SID do Messaging Service
   (começa com `MG...` — disponível na consola Twilio em Messaging → Services)
3. Guardar

O sistema detecta automaticamente que o valor começa com `MG` e volta ao fluxo legado:
gera OTP localmente → guarda na tabela `phone_verifications` → envia via Messages API.

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
| `app/CentralLogics/SmsModule.php` | Adicionados 3 métodos: `usingTwilioVerify()`, `twilioVerifySend()`, `twilioVerifyCheck()`. O método legado `twilio()` manteve-se **intacto**. |
| `app/Http/Controllers/Payment/PaymentOrderController.php` | `sendOtp()`, `verifyOtp()` e `resendOtp()` detectam `usingTwilioVerify()` e usam o caminho correspondente. O código legado permanece no bloco `else`. |

O ficheiro `SMSModuleController.php` **não foi alterado** — nenhum campo novo foi adicionado.

---

## Endpoints Twilio Verify de referência

### Enviar OTP
```bash
curl 'https://verify.twilio.com/v2/Services/{MESSAGING_SERVICE_SID}/Verifications' \
  -X POST \
  --data-urlencode 'To=+244912345678' \
  --data-urlencode 'Channel=sms' \
  -u {SID}:{TOKEN}
```

### Verificar OTP
```bash
curl 'https://verify.twilio.com/v2/Services/{MESSAGING_SERVICE_SID}/VerificationChecks' \
  -X POST \
  --data-urlencode 'To=+244912345678' \
  --data-urlencode 'Code=123456' \
  -u {SID}:{TOKEN}
```

### Resposta ao enviar (sucesso)
```json
{ "status": "pending", "to": "+244912345678", "channel": "sms" }
```

### Resposta ao verificar (código correcto)
```json
{ "status": "approved", "to": "+244912345678" }
```

### Resposta ao verificar (código errado)
```json
{ "status": "pending", "to": "+244912345678" }
```
