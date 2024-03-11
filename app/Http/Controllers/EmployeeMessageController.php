<?php

namespace App\Http\Controllers;

use App\Models\EmployeeMessages;
use Illuminate\Http\Request;

class EmployeeMessageController extends Controller
{
    // get all messages for this employee
    public function notifications(){
        return view("admin/notifications", ["messages", auth()->user()->messages]); // user -> employee
    }
}
