<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;

class IndexController extends Controller
{
    protected $user;

    public function __construct(Guard $auth)
    {
        $this->user = $auth->user();
    }

    public function index()
    {
        if($this->user->is_admin) {
            return redirect('admin');
        }
        return view('welcome');
    }
}
