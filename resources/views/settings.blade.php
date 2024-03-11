@auth
    @if (auth()->user()->account_type_id == 1)
        <x-layout-admin notifications="{{ $notifications }}" title="Settings">

            <body>
                <section id="main-content" style=" margin-right:110px;">
                    <section class="wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header"><i class="fa fa-gear"></i>Settings</h3>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-home"></i>Home</li>
                                    <li><i class="fa fa-gear"></i>Settings</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        Settings
                                    </header>
                                    <div class="panel-body">
                                        {{-- components --}}
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                </section>
            </body>
        </x-layout-admin>
    @else
        <x-layout title="Settings"></x-layout>
    @endif
@endauth
