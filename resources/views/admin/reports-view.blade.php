<x-layout-admin notifications="{{ $notifications }}" title="Reports|View">

    <body>
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="icon_document_alt"></i>Reports</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="fa fa-file-text-o"></i>Reports</li>
                            <li><i class="fa fa-plus"></i>Create</li>
                            <li><i class="fa fa-folder-open"></i>View</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            {{-- <header class="panel-heading"> --}}
                            {{-- <header class="panel-heading"
                                style="display: flex; align-items: right;"> --}}
                            <header class="panel-heading" style="display: flex;padding: 5px 10px 5px 5px;">
                                Reports
                                <div style="text-align: right;justify-content: flex-end;flex-grow: 1">
                                    <button id="print-btn" class="btn btn-primary" onclick="print()">
                                        <i class="fa fa-print"></i>
                                        Print</button>

                                    <button id="print-btn" class="btn btn-primary btn-success">
                                        <i class="fa fa-download"></i>
                                        Download</button>

                                    <form action="/pdf/generate" method="POST">
                                        <input type="submit" value="View">
                                    </form>
                                </div>
                            </header>
                            <div class="panel-body print">
                                {{-- create a section that will be printed and downloaded as PDF --}}
                                {{-- <div class="panel-heading" style="margin: 0 auto; text-align: right;">
                                    Header
                                    <button id="print-btn" class="btn btn-primary"><i class="fa fa-print"></i>
                                        Print</button>

                                    <button id="print-btn" class="btn btn-primary btn-success"><i
                                            class="fa fa-download"></i>
                                        Download</button>
                                </div> --}}

                                {{-- Print from this div --}}
                                <div style="text-align: center;margin-top: -5%">
                                    <div style="display: inline-block;">
                                        {{-- School Logo --}}
                                        <img src="{{ asset('img/profile.jpg') }}" alt="No Image Available"
                                            style="width: 40%;">
                                        <h1 style="margin-top: -5%;">{{ env('APP_NAME') }}</h1>
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
                                                <th>Transaction ID</th>
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
                                                    <td>{{ $transaction->amount }}</td>
                                                    <td>{{ $transaction->transaction_date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-layout-admin>
