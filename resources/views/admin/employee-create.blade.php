<x-layout-admin notifications="{{ $notifications }}" title="Employ">
    {{-- This page will be used to manage a single employee as well as create one --}}

    <body>
        <!--header start-->
        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-user"></i>Create/Hire an Employee</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="fa fa-users"></i>Employees</li>
                            <li><i class="fa fa-user-plus"></i>Employ</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <span class="fa fa-plus"></span>
                                Create Employee Identity
                            </header>
                            <div class="panel-body">
                                <x-register-form action="/employees/create">
                                </x-register-form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>

</x-layout-admin>
