<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller

{
  public function login(Request $request)
  {
    if ($request->password == "3431") {
      $user = User::firstOrFail();
      Auth::login($user);
      return redirect()->route('dashboard');
    } else {
      return redirect()->back();
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
