<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Admin - Print</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="{{ asset('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" type="text/css">
    <link href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
    <link href="{{ asset('css/widgets.css" rel="stylesheet') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ asset('css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <!-- =======================================================
    Theme Name: NiceAdmin
    Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
    <script defer src="{{ asset('js/alpine.min.js') }}"></script>
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('js/kambiti_utils.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/kstyles.css') }}">
</head>

<body>
    <section class="panel">
        <div class="panel-body print">
            {{-- Print from this div --}}
            <div style="text-align: center;margin-top: -5%">
                <div style="display: inline-block;">
                    {{-- Data in this field should be specified in env file --}}
                    {{-- {{ 'storage/'.asset('img/profile.jpg') }} --}}
                    {{-- {{'data:image/png;base64,'.base64_encode(file_get_contents(asset('img/profile.jpg')))}}"> --}}
                    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/img/profile.jpg'))) }}"
                        width="120"> --}}
                    {{-- <img src="{{ asset('img/profile.jpg') }}" alt="No Image Available" style="width: 40%;"> --}}
                    {{-- <img src="data:image/*;base64,{{ base64_encode(file_get_contents(base_path('public/img/profile.jpg'))) }}"
                        alt="No Image Available" style="width: 40%;"> --}}
                    {{-- {{ base64_encode(file_get_contents(preg_replace('/public/', '/', public_path('public/img/profile.jpg'), 1))) }} --}}
                    <img src="data:image/*;base64,{{ base64_encode(file_get_contents(preg_replace('/public/', '/', public_path('public/img/profile.jpg'), 1))) }}"
                        alt="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" style="width: 40%;">
                    <h1>{{ env('APP_NAME') }}</h1>
                    <h4>Our school motto</h4>
                    <h3>Tel: +254700000000</h3>
                    <h3>Email: {{ env('MAIL_FROM_ADDRESS') }}</h3>
                    <hr>
                    <h3>Transcript for <b><em>{{ $transaction_type }}</em></b>
                        Transactions
                        between
                        <b><em>{{ $from }}</em></b> and <b><em>{{ $to }}</em></b>
                    </h3>
                    <hr>
                </div>
            </div>
            <div style="margin: 0 5%;">
                <table style="width: 90%; margin: 0 auto;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            @if ($transaction_type_id == 1)
                                {{-- INCOME --}}
                                <th>From</th>
                            @elseif ($transaction_type_id == 2 || $transaction_type_id == 3)
                                {{-- EXPENSE --}}
                                <th>For</th>
                                {{-- @elseif ($transaction_type_id == 3) --}}
                                {{-- OTHER --}}
                            @else
                                {{-- ALL --}}
                                <th>From</th>
                            @endif
                            <th>Debited To</th>
                            <th>Amount</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ getBankAccountName($transaction->from_account_id) }}</td>
                                <td>{{ getBankAccountName($transaction->to_account_id) }}</td>
                                <td>{{ formatMoney($transaction->amount) }}</td>
                                <td>{{ extractDate($transaction->transaction_date) }}</td>
                            </tr>
                        @endforeach
                        {{-- put a boundary --}}
                        <tr style="background-color: aqua;">
                            <td colspan="3"><b>Total</b></td>
                            <td colspan="2"><b>{{ formatMoney(sumValues($transactions, 'amount')) }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>
