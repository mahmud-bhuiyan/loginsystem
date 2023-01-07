<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complete;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $completes = Complete::orderby('id', 'desc')->where('status', '0')->orwhere('status', '1')->get();

        return view('admin.dashboard', compact('completes'));
    }
}
