@php
    use Illuminate\Support\Facades\Session;
    $direction = Session::get('direction');
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$direction}}"
      style="text-align: {{$direction === "rtl" ? 'right' : 'left'}};"
      xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <title>{{ translate('statement') }}</title>
        <meta http-equiv="Content-Type" content="text/html;"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>

            * {
                margin: 0;
                padding: 0;
                line-height: 1.2;
                font-family: "Open Sans", sans-serif;
                color: #212B36;
            }

            body {
                font-size: 10px;
                font-family: "Open Sans", sans-serif;
                font-optical-sizing: auto;
                font-weight: 400;
                font-style: normal;

            }

            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: #fafafa;
                text-align: center;
                padding: 10px;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                width: 100%;
            }

            table thead th {
                padding: 8px;
                font-size: 9px;
                text-align: left
            }

            table tbody th,
            table tbody td {
                padding: 8px;
                font-size: 10px;
            }

            .text-left {
                text-align: {{$direction === "rtl" ? 'right' : 'left'}} !important;
            }
            .text-right {
                text-align: {{$direction === "rtl" ? 'left' : 'right'}} !important;
            }
            .text-center{
                text-align: center !important;
            }

            table th.text-right {
                text-align: {{$direction === "rtl" ? 'left' : 'right'}} !important;
            }

            @media print {
                table th.text-right {
                    text-align: {{$direction === "rtl" ? 'left' : 'right'}} !important;
                }
            }

            .mt-30 {
                margin-top: 30px !important;
            }
            .mb-30 {
                margin-bottom: 30px !important;
            }

            .m-0 {
                margin: 0;
            }

            .my-12 {
                margin-top: 12px;
                margin-bottom: 12px;
            }

            .mx-20{
                margin-left: 20px !important;
                margin-right: 20px !important;
            }

            .fw-normal {
                font-weight: 400;
            }

            .fw-medium {
                font-weight: 500;
            }

            .fw-semibold {
                font-weight: 600;
            }

            .fw-bold {
                font-weight: 700;
            }

            .border-dashed-top {
                border-top: 1px dashed #E6E7EC;
            }

            .border-dashed-bottom {
                border-bottom: 1px dashed #E6E7EC;
            }

            .bg-light {
                background-color: #FAFAFA;
            }

            a {
                color: #212B36;
            }

            h2 {
                font-size: 20px;
                font-weight: 700;
            }

            h4 {
                font-size: 14px;
                font-weight: 600;
            }

            h6 {
                font-size: 10px;
                font-weight: 500;
            }

            .opacity-80{
                opacity: 0.8;
            }

            .w-100 {
                width: 100%;
            }

            .h-100 {
                height: 100%;
            }

            .vertical-align-top {
                vertical-align: top;
            }

            .h-100 {
                height: 100%;
            }

            .text-capitalize{
                text-transform: capitalize;
            }

            .mw-100{
                max-width: 100px;
            }

            @media print {
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                tr {
                    page-break-inside: avoid;
                }

                thead {
                    display: table-header-group;
                }

                tbody {
                    display: table-row-group;
                }

                td,
                th {
                    word-wrap: break-word;
                }
                table tbody th,
                table tbody td {
                    padding: 8px;
                    font-size: 10px;
                }
            }
        </style>


    </head>

    <body>
        <table style="width:595px; height: auto; margin:0 auto; border-collapse: collapse;">
            <tr>
                <td style="padding: 0;">
                    <div style="padding: 30px 20px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <h2>{{\App\CentralLogics\helpers::get_business_settings('business_name') }} {{ translate('Statement') }}</h2>
                                        </div>
                                    </td>
                                    @php
                                        $logoSetting = \App\CentralLogics\helpers::get_business_settings('logo');
                                        $logoPath = storage_path('app/public/business/' . $logoSetting);

                                        if (!file_exists($logoPath)) {
                                            $logoPath = public_path('assets/admin/img/1920x400/img2.jpg');
                                        }

                                        $logoData = base64_encode(file_get_contents($logoPath));
                                        $logoMime = mime_content_type($logoPath);
                                    @endphp

                                    <td class="text-right">
                                        <div>
                                            <img class="mw-100" src="data:{{ $logoMime }};base64,{{ $logoData }}" alt="{{ translate('Logo') }}" style="max-height: 100px;">
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                        <div class="border-dashed-top my-12"></div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td><h6>{{ translate('Name') }}</h6></td>
                                            <td>:</td>
                                            <td>{{ $user->f_name . ' ' . $user->l_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><h6>{{ translate('Account Number') }}</h6></td>
                                            <td>:</td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td><h6>{{ translate('User Type') }}</h6></td>
                                            <td>:</td>
                                            <td>{{ $user->type == '0' ? translate('Admin') : ($user->type == '1' ? translate('agent') : translate('customer')) }}</td>
                                        </tr>
                                        @if(!is_null($start_date) && !is_null($end_date))
                                            <tr>
                                                <td><h6>{{ translate('Statement Period') }}</h6></td>
                                                <td>:</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($start_date)->format('d-M-Y') }}
                                                    {{ translate('to') }}
                                                    {{ \Carbon\Carbon::parse($end_date)->format('d-M-Y') }}
                                                </td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                    </td>
                                    <td class="text-right">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>{{ translate('Summery') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><h6>{{ translate('Total Credit') }}</h6></td>
                                                    <td>:</td>
                                                    <td>{{ Helpers::set_symbol($totalCredit) }}</td>
                                            </tr>
                                                <tr>
                                                    <td><h6>{{ translate('Total Debit') }}</h6></td>
                                                    <td>:</td>
                                                    <td>{{ Helpers::set_symbol($totalDebit) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="border-dashed-bottom my-12"></div>
                        <table>
                            <thead class="bg-light fw-semibold">
                                <tr>
                                    <th>{{ translate('Sl') }}</th>
                                    <th>{{ translate('Date') }}</th>
                                    <th>{{ translate('Transaction type') }}</th>
                                    <th>{{ translate('Transaction ID') }}</th>
                                    <th class="text-right">{{ translate('Credit') }}</th>
                                    <th class="text-right">{{ translate('Debit') }}</th>
                                    <th class="text-right">{{ translate('Charge') }}</th>
                                    <th class="text-right">{{ translate('Balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $transaction->transaction_type)) }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td class="text-right">{{ Helpers::set_symbol($transaction->credit) }}</td>
                                    <td class="text-right">{{ Helpers::set_symbol($transaction->debit) }}</td>
                                    <td class="text-right">{{ Helpers::set_symbol($transaction->charge) }}</td>
                                    <td class="text-right">{{ Helpers::set_symbol($transaction->balance) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    <div class="invoice-footer mt-30">
                        <div class="border-dashed-top mx-20"></div>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        {{ translate('Thanks for using our service.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="border-dashed-bottom mx-20"></div>
                        <div class="bg-light mt-30" style="padding: 4px 20px">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="text-left">{{ url('/') }}</td>
                                        <td class="text-center">{{ \App\CentralLogics\helpers::get_business_settings('phone') }}</td>
                                        <td class="text-right">{{ \App\CentralLogics\helpers::get_business_settings('email') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>

</html>
