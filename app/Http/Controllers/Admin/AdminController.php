<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return Inertia::render('Admin/AdminDashboard');
    }
}
