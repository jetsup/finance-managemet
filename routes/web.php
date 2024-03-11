<?php

use App\Http\Controllers\EmployeeMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use App\Models\Budgets;
use App\Models\Complains;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\EmployeeMessages;
use App\Models\EmployeePayments;
use App\Models\EmployeeTypes;
use App\Models\Reports;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;

use function PHPSTORM_META\type;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// handle both authenticated and unauthenticated users
Route::get('/', function () {
    if (auth()->user()) {
        if (auth()->user()->account_type_id == 1) {
            // these are school officials
            return view("admin/dashboard", ["notifications" => getNotificationsCount()]);
        } else {
            // these are people logged in to use the website like vendors and students
            return view('dashboard', ["notifications" => getNotificationsCount()]);
        }
    } else {
        return view("index");
    }
})->name("home");

Route::get("about-us", function() {
    return view("about-us");
});

Route::get("contact-us", function() {
    return view("contact-us");
});

Route::get("career", function() {
    return view("career");
});

Route::get("services", function() {
    return view("services");
});

Route::get("terms-of-service", function() {
    return view("terms-of-service");
});

Route::get('profile', function () {
    if (auth()->user()->account_type_id == 1) {
        return view("admin/profile", ["notifications" => getNotificationsCount()]);
    } else {
        return view("profile", ["notifications" => getNotificationsCount()]);
    }
})->middleware("auth");

// Notifications
Route::get("notifications", function () {
    $results = EmployeeMessages::where("for", "=", auth()->user()->id, "or")
        // ->where("for", "=", 0) /*FIXME: for 0 is a notification tailered for every employee*/
    ->where("from", "!=", auth()->user()->id)->where("deleted", "=", 0)->orderBy("created_at", "desc")->get();
    if(auth()->user()->account_type_id == 1) {
        return view("admin/notifications", ["messages" => $results]);
    } else {
        return view("user/notifications", ["messages" => $results]);
    }
})->middleware("auth");

Route::delete("notifications/delete/{id}", function ($id) {
    // instead of deleting, just update the status of is_active to 0
    EmployeeMessages::where("id", "=", $id)->where("for", "=", auth()->user()->id)->update(["deleted" => 1]);
    return back();
})->middleware("auth");

Route::put("notifications/create", function (Request $request) {
    $msgID = $request->input("message-id", 0);
    $notificationMsg = $request->input("msgtext");
    $targetAudience = $request->input("sendto");
    EmployeeMessages::create(["prev_msg_id" => $msgID, "for" => $targetAudience, "from" => auth()->user()->id, "message" => $notificationMsg]);
    EmployeeMessages::where("id", "=", $msgID)->update(["replied" => 1]);
    return back();
})->middleware("auth");

Route::put("notifications/message", function (Request $request) {
    $msgID = $request->input("message-id", 0);
    $msgReply = $request->input("msgtext");
    $replyTo = $request->input("sendto");
    EmployeeMessages::create(["prev_msg_id" => $msgID, "for" => $replyTo, "from" => auth()->user()->id, "message" => $msgReply]);
    EmployeeMessages::where("id", "=", $msgID)->update(["replied" => 1]);
    return back();
})->middleware("auth");

Route::get("notifications/markread/{id}", function ($id) {
    EmployeeMessages::where("id", "=", $id, "and", "for", "=", auth()->user()->id)->update(["read" => 1]);
    return response()->json(["notifications" => getNotificationsCount(), "status" => 1]);
})->middleware("auth");

// Reports
Route::get("reports", function () {
    return view("user/reports");
})->middleware("auth");

Route::get("reports/generate", function () {
    return view("admin/reports-generate", ["notifications" => getNotificationsCount()]);
})->middleware("auth");

Route::post("reports/generate", function () {
    $startDate = str(request()->input("combo-startdate")) . " 00:00:00";
    $endDate = str(request()->input("combo-enddate")) . " 23:59:59";
    $typeID = request()->input("combo-transactiontype");
    $transactions = Transactions::where("transaction_type_id", "=", $typeID)->whereBetween("transaction_date", [$startDate, $endDate])->get();
    $transactionType = getTransactionType($typeID);
    $pdf = Pdf::loadView("admin/print-reports", ["transactions" => $transactions, "transaction_types" => getTransactionTypes(), "transaction_type" => $transactionType, "transaction_type_id" => $typeID, "from" => $startDate, "to" => $endDate]);
    $pdf->setPaper('A4', 'landscape');
    Reports::create(["generated_by" => auth()->user()->id, "from" => $startDate, "to" => $endDate, "transaction_type_id" => $typeID]);
    // return view("admin/print-reports", ["transactions" => $transactions, "transaction_types" => getTransactionTypes(), "notifications" => getNotificationsCount(), "transaction_type" => $transactionType, "transaction_type_id" => $typeID, "from" => $startDate, "to" => $endDate]);
    return $pdf->download('report.pdf');
})->middleware("auth");

Route::get("reports/history", function () {
    return view("admin/reports-history", ["notifications" => getNotificationsCount()]);
})->middleware("auth");

Route::get("reports/transactiontypes", function () {
    return response()->json(["types" => getTransactionTypes()]);
})->middleware("auth");

// Complaints
Route::get("complains", function () {
    $complains = Complains::where("for", "=", auth()->user()->id)->where("from", "!=", auth()->user()->id) /*from != this user*/
        ->where("deleted", "=", 0)
        ->orderBy("created_at", "desc")->get();
    return view("admin/complains", ["complains" => $complains, "notifications" => getNotificationsCount(), "mine" => 0]);
})->middleware("auth");

Route::get("complains/me", function () {
    $complains = Complains::where("from", "=", auth()->user()->id) /*->where("for", "!=", auth()->user()->id)*//*from != this user*/
        ->where("deleted", "=", 0)
        ->where("prev_complain_id", "=", 0)
        ->orderBy("created_at", "desc")->get();
    return view("admin/complains", ["complains" => $complains, "notifications" => getNotificationsCount(), "mine" => 1]);
})->middleware("auth");

Route::delete("complains/delete/{id}", function ($id) {
    // instead of deleting, just update the status of is_active to 0
    Complains::where("id", "=", $id)->where("for", "=", auth()->user()->id)->update(["deleted" => 1]);
    return back();
})->middleware("auth");

Route::put("complains/post", function (Request $request) {
    $complainID = $request->input("complain-id", 0);
    $msgReply = $request->input("replytext");
    $replyTo = $request->input("from");
    Complains::create(["prev_complain_id" => $complainID, "for" => $replyTo, "from" => auth()->user()->id, "message" => $msgReply]);
    // check if complainID is present in the database then update the replied field to true
    Complains::where("id", "=", $complainID)->update(["replied" => 1]);
    return back();
})->middleware("auth");

Route::get("complains/markread/{id}", function ($id) {
    Complains::where("id", "=", $id, "and", "for", "=", auth()->user()->id)->update(["read" => 1]);
    return response()->json([1]);
})->middleware("auth");

// Settings
Route::get("settings", function () {
    return view("settings", ["notifications" => getNotificationsCount()]);
})->middleware("auth");

Route::get('register', [UserController::class, "create"])->middleware("guest")->name("register");
Route::post('signup', [UserController::class, "store"])->middleware("guest");

Route::get('login', [UserController::class, "login"])->middleware("guest")->name("login");
Route::post('signin', [UserController::class, 'signin'])->middleware("guest");

Route::get('logout', [UserController::class, 'logout']);

// Employees create and manage and process payments
Route::get("employees/create", function () {
    return view("admin/employee-create", ["notifications" => getNotificationsCount(), "create" => 1]);
})->middleware("auth");

Route::post("employees/create", function () {
    // later use a controller
    $employeeNumber = request()->input("employee_number");
    $username = request()->input("username");
    $employeeTypeID = request()->input("employee-category");
    $departmentID = request()->input("department");

    $userID = User::where("username", "=", $username)->get(["id"])->pluck("id")[0];

    dd(request(), $userID, $employeeNumber, $employeeTypeID, $departmentID);

    Employees::create(["employee_number" => $employeeNumber, "user_id" => $userID, "employee_type_id" => $employeeTypeID, "department_id" => $departmentID]);
    return view("admin/employee-create", ["notifications" => getNotificationsCount(), "create" => 1]);
})->middleware("auth");

// DARAJA API (M-PESA Integrations)
Route::get("employees/payment", function() {
    // list employees with an option to pay them
    $employees = Employees::get();
    $payments = EmployeePayments::where("transaction_id", "=", null)->get(["id", "employee_id", "due_amount", "total_received", "transaction_id"]);
    
    // Create an associative array to store payments data using employee_id as the key
    $paymentsData = [];
    foreach ($payments as $payment) {
        $paymentsData[$payment->employee_id] = [
            "id" => $payment->id,
            "due_amount" => $payment->due_amount,
            "total_received" => $payment->total_received,
            "transaction_id" => $payment->transaction_id,
            "last_paid_date" => EmployeePayments::where("employee_id", "=", $payment->employee_id)->orderBy("created_at")->get("created_at")->pluck("created_at")[0],//Transactions::where("id", "=", $payment->transaction_id)->get(["transaction_date"])->pluck("transaction_date")[0],
        ];
    }
    // Add payments data to each employee, a user with no payment data will be assigned null
    foreach ($employees as $employee) {
        $employee->payments = $paymentsData[$employee->id] ?? null;
    }
    return view("admin/employees-manage", ["notifications" => getNotificationsCount(), "employees" => $employees, "payment" => 1]);
})->middleware("auth");

Route::post("employee/pay/{employeeID}/{paymentID}/{amount}", function($employeeID, $paymentID, $amount) {
    // make a trigger that will execute at end month so that payments can be processed
    // create a new transaction then update the employee_payments
    $userID = Employees::where("id", "=", $employeeID)->get("user_id")->pluck("user_id")[0];
    $employeePhone = cleanPhoneNumber(User::where("id", "=", $userID)->get("phone")->pluck("phone")[0]);
    $transactionCode = "CODE";// from M-Pesa endpoint
    $transaction = Transactions::create(["transaction_date" => now(),
        "transaction_type_id" => 2 /*EXPENSE*/,
        "from_account_id" => 1/*organisations account*/,
        "to_account_id" => 2, // test account actually a mobile phone number
        "amount" => $amount,
        "transaction_code" => $transactionCode]);
    $totalPayments = EmployeePayments::where("id", "=", $paymentID)->get("total_received")->pluck("total_received")[0] + $amount;
    EmployeePayments::where("id", "=", $paymentID)->update(["transaction_id" => $transaction->id, "total_received" => $totalPayments]);
    return back();
})->middleware("auth");

Route::get("employees/manage", function () {
    $employees = Employees::get();
    return view("admin/employees-manage", ["notifications" => getNotificationsCount(), "employees" => $employees, "payment" => 0]);
})->middleware("auth");

Route::get("employees/manage/{employeeID}", function ($employeeID) {
    return view("admin/employees-create", ["notifications" => getNotificationsCount(), "create" => 0]);
})->middleware("auth");

// requests start
Route::get("/finduser/{username}", function ($username) {
    $user = User::where("username", "=", $username)->get(["id"])->pluck("id");
    // dd($user);
    try {
        $user = $user[0];
        if ($user > 0) {
            $employeeID = Employees::where("user_id", "=", $user)->get("id")->pluck("id")[0];
        } else {
            $employeeID = [];
        }
    } catch (Exception $e) {
        $employeeID = [];
    }
    return response()->json(["user" => $user, "employee" => $employeeID]);
})->middleware("auth");

Route::get("/find_emp_number/{empNumber}", function ($empNumber) {
    $employee = Employees::where("employee_number", "=", $empNumber)->get(["id"]);
    return response()->json(["employee" => $employee]);
})->middleware("auth");

Route::get("genders", function () {
    return response()->json(["genders" => getGenders()]);
});

Route::get("employeetypes", function () {
    $employeeTypes = EmployeeTypes::orderBy("id")->get(["id", "employee_type"]);
    return response()->json(["employee_types" => $employeeTypes]);
})->middleware("auth");

Route::get("departments", function () {
    $departments = Departments::orderBy("id")->get(["id", "name"]);
    return response()->json(["departments" => $departments]);
})->middleware("auth");

Route::get("budgets", function () {
    $resultsBudget = Budgets::orderBy("allocated_amount", "asc")->get();
    $resultsDepartments = Departments::orderBy("id", "desc")->get();
    // TODO: perform all computations here
    return response()->json([
        "budgets" => $resultsBudget,
        "departments" => $resultsDepartments,
    ]);
})->middleware("auth");

Route::get("transactions", function () {
    $income = Transactions::where("transaction_type_id", "=", 1)->orderBy("transaction_date", "asc")->get(["id", "transaction_date", "transaction_type_id", "from_account_id", "to_account_id", "amount"]);
    $expenses = Transactions::where("transaction_type_id", "=", 2)->orderBy("transaction_date", "asc")->get(["id", "transaction_date", "transaction_type_id", "from_account_id", "to_account_id", "amount"]);
    $other = Transactions::where("transaction_type_id", "=", 3)->orderBy("transaction_date", "asc")->get(["id", "transaction_date", "transaction_type_id", "from_account_id", "to_account_id", "amount"]);
    return response()->json(["income" => $income, "expenses" => $expenses, "other" => $other]);
})->middleware("auth");
// requests end

// utility routes start
Route::post('pdf/generate', [PDFController::class, "generatePDF"]);
// utility routes end