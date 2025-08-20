<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
  public function index(){ $users = User::paginate(20); return view('admin.users.index', compact('users')); }
  public function edit(User $user){ return view('admin.users.edit', compact('user')); }
  public function update(Request $r, User $user){
    $user->update([
      'is_admin' => (bool)$r->input('is_admin', false),
      'tier' => $r->input('tier','free'),
      'pro_until' => $r->input('pro_until')
    ]);
    return redirect()->route('admin.users.index')->with('status','Updated.');
  }
}
