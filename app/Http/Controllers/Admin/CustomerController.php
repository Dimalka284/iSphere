<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(){
        $customers = User::latest()->paginate(10);
        return view('admin.customer',compact('customers'));
    }
}
