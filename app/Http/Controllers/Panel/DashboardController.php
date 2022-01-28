<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Colleague;


class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    return view('panel.admin.dashboard');
  }

  public function deactivated_users()
  {
    return view('panel.admin.deactivated');
  }
}
