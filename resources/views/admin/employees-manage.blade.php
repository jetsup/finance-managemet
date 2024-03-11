<x-layout-admin notifications="{{ $notifications }}" title="Manage Employees">

    <body>
        <!--header start-->
        <!--main content start-->
        <section id="main-content" style=" margin-right:110px;">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-group"></i>
                            @if ($payment == 1)
                                Pay Employees
                            @else
                                Manage Employees
                            @endif
                        </h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i>Home</li>
                            <li><i class="fa fa-users"></i>Employees</li>
                            @if ($payment == 1)
                                <li><i class="fa fa-money"></i>Payments</li>
                            @else
                                <li><i class="fa fa-gear"></i>Manage</li>
                            @endif
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                @if ($payment == 1)
                                    Billings
                                @else
                                    Tweak Employees
                                @endif
                            </header>
                            <div class="panel-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Employee Number</th>
                                            <th>Employee Type</th>
                                            <th>Gender</th>

                                            @if ($payment == 1)
                                                <th>Total Paid</th>
                                            @else
                                                <th>Username</th>
                                            @endif

                                            @if ($payment == 1)
                                                <th>Payment Amount</th>
                                            @else
                                                <th>Department</th>
                                            @endif

                                            @if ($payment == 1)
                                                <th>Last Paid</th>
                                            @else
                                                <th>Employed On</th>
                                            @endif

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td><i class="fa fa-user"></i> {{ getUserFullName($employee->user_id) }}
                                                </td>
                                                <td>{{ $employee->employee_number }}</td>
                                                <td>{{ getEmployeeTypeById($employee->employee_type_id) }}</td>
                                                <td>{{ getEmployeeGender($employee->user_id) }}</td>

                                                @if ($payment == 1)
                                                    <td>KES. {{ formatMoney($employee->payments['total_received']) }}
                                                    </td>
                                                @else
                                                    <td>{{ getUserUsername($employee->user_id) }}</td>
                                                @endif

                                                @if ($payment == 1)
                                                    <td>KES. {{ formatMoney($employee->payments['due_amount']) }}</td>
                                                @else
                                                    <td>{{ getDepartmentName($employee->department_id) }}</td>
                                                @endif

                                                @if ($payment == 1)
                                                    <td>{{ extractDate($employee->payments['last_paid_date']) }}</td>
                                                @else
                                                    <td>{{ extractDate($employee->created_at) }}</td>
                                                @endif
                                                <td>
                                                    @if ($payment == 1)
                                                        <form
                                                            action="{{ '/employee/pay/' . $employee->id . '/' . $employee->payments['id'] . '/' . $employee->payments['due_amount'] }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fa fa-dollar"></i> Pay
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ '/employee/delete/' . $employee->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </body>
</x-layout-admin>
