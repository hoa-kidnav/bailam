<?php

namespace App\Controllers\Users;
use App\Controllers\BaseController;
class HomeController extends BaseController
{
    public function index()
    {
        return view('users/main');
    }
}
