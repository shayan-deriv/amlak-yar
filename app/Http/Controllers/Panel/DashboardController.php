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
    $type_counts = Property::select(
        \DB::raw('COUNT(*) as count'),
        \DB::raw('(type)')
      )
      ->groupBy('type')->pluck('count','type');
    

    $counts = [
      'villa' => $type_counts[1] ?? 0,
      'apartment'=> $type_counts[3] ?? 0,
      'field' => $type_counts[2] ?? 0,
      'large_field' => $type_counts[5] ?? 0,
      'other' => $type_counts[6] ?? 0,
      'for_rent' => Property::where('for_rent',1)->count(),
      'for_sell' => Property::where('for_sell',1)->count(),
      'for_colleague' => Property::where('for_colleague',1)->count(),
    ];
    return view('panel.admin.dashboard', compact('counts'));
  }

  public function deactivated_users()
  {
    return view('panel.admin.deactivated');
  }
}
