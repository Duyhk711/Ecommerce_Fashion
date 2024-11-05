<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThongkeController extends Controller
{
    public function index()
{

    return view('admin.thongkes.index');
}
}
