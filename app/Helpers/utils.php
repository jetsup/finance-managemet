<?php

use App\Models\BankAccounts;
use App\Models\EmployeeMessages;
use App\Models\Employees;
use App\Models\EmployeeTypes;
use App\Models\Genders;
use App\Models\Departments;
use App\Models\Transactions;
use App\Models\TransactionTypes;
use App\Models\User;

function getGender(int $genderID)
{
    $result = Genders::where("id", "=", $genderID)->get("gender")->pluck("gender")[0];
    return $result;
}

function getEmployeeGender(int $userID)
{
    $genderID = User::where("id", "=", $userID)->get(["gender_id"])->pluck("gender_id")[0];
    $gender = Genders::where("id", "=", $genderID)->get("gender")->pluck("gender")[0];
    return $gender;
}

function getGenders()
{
    $genders = Genders::orderBy("id")->get(["id", "gender"]);
    return $genders;
}

function getDepartmentName($departmentID)
{
    if ($departmentID == 0) {
        $department = "NOT ASSIGNED";
    } else {
        $department = Departments::where("id", "=", $departmentID)->get("name")->pluck("name")[0];
    }
    return $department;
}

function getNotificationsCount()
{
    $results = EmployeeMessages::where("for", "=", auth()->user()->id)->where("read", "=", 0)->where("from", "!=", auth()->user()->id)->get();
    return count($results);
}

function cleanPhoneNumber(string $phone){
    return str_replace(["-", "."], "", $phone);
}

function getUserUsername(int $userID)
{
    $user = User::where("id", "=", $userID)->get("username")->pluck("username")->get(0);
    // if ($user == null){
    //     $user = "(Deleted Account)";
    // }
    return $user;
}

function getUserDP($userID)
{
    if (auth()->user()->dp == "/img/profile.jpg" || auth()->user()->dp == null) {
        return "/img/profile.jpg";
    }
    return "/storage/" . auth()->user()->dp;
}

function getUserFullName(int $userID)
{
    $user = User::where("id", "=", $userID)->get(["first_name", "last_name"]);
    $name = $user[0]->first_name . " " . $user[0]->last_name;
    return $name;
}

function getEmployeeType()
{
    $type = Employees::where("user_id", "=", auth()->user()->id)->get("employee_type_id")->pluck("employee_type_id")[0];
    return $type;
}

function getEmployeeTypeById($id)
{
    $type = EmployeeTypes::where("id", "=", $id)->get("employee_type")->pluck("employee_type")[0];
    return $type;
}

function firstTransactionDate()
{
    $date = Transactions::orderBy("transaction_date", "asc")->get("transaction_date")->pluck("transaction_date")[0];
    $date = explode(" ", Str($date))[0];
    return $date;
}
function lastTransactionDate()
{
    $date = Transactions::orderBy("transaction_date", "desc")->get("transaction_date")->pluck("transaction_date")[0];
    $date = explode(" ", Str($date))[0];
    return $date;
}

function getTransactionTypes()
{
    $types = TransactionTypes::orderBy("id")->get(["id", "transaction_type"]);
    return $types;
}

function getTransactionType(int $typeID)
{
    $type = TransactionTypes::where("id", "=", $typeID)->get(["transaction_type"])->pluck("transaction_type")[0];
    return $type;
}
function extractDate($dateTime)
{
    $dateTime = explode(" ", Str($dateTime))[0];
    return $dateTime;
}


function formatMoney(float $amount)
{
    return number_format($amount, 0, ".", ",");
}

function sumValues($object, string $columnName)
{
    $sum = 0;
    foreach ($object as $obj) {
        $sum += $obj->$columnName;
    }
    return $sum;
}

function getBankAccountName(int $accountID)
{
    $account = BankAccounts::where("id", "=", $accountID)->get(["account_name", "bank_name"])->pluck("account_name")[0];
    return $account;
}