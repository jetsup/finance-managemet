<x-layout-admin notifications="{{ $notifications }}" title="Dashboard">

    <body>
        <!--header start-->

        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-bar-chart-o"></i>Dashboard</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Statistics
                            </header>
                            <div class="flex flex-column charts-div">
                                <div class="panel-body chart">
                                    <div>
                                        {{-- display budget per department --}}
                                        <canvas id="budget-chart"></canvas>
                                    </div>
                                </div>

                                <div class="panel-body chart">
                                    <div>
                                        {{-- display revenue trends --}}
                                        <canvas id="transactions-chart"></canvas>
                                    </div>
                                </div>


                                <div class="panel-body chart">
                                    <div>
                                        {{-- display expense trends --}}
                                        <canvas id="departmental-budgets-chart"></canvas>
                                    </div>
                                </div>

                                <div class="panel-body chart">
                                    <div>
                                        <canvas id="annual-transactions-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
    @if (getEmployeeType() == 1 || getEmployeeType() == 2)
        <script src="{{ asset('js/kambiti/admins.js') }}"></script>
    @endif
</x-layout-admin>
