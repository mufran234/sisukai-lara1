<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\UserCertification;

class DashboardController extends Controller
{
  public function index() {
    $user = auth()->user();
    $active = UserCertification::with('certification')->where('user_id',$user->id)->get();
    $all = Certification::orderBy('is_active','desc')->get();
    return view('dashboard', compact('active','all','user'));
  }
}
