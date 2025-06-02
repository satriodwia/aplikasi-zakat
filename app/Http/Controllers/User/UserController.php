<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function payment()
{
    return view('user.payment');
}
    public function zakat()
    {
        return view('user.zakat');
    }
}
