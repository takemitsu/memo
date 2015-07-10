<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;

class adminController extends Controller
{

    protected $user;

    public function __construct(Guard $auth)
    {
        $this->user = $auth->user();
    }

    public function index()
    {
        return view('admin.index',['user' => $this->user,]);
    }
}
