<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function index()
    {
        return view('panel.admin.areas.index');
    }

    public function create()
    {
        $states = State::all();
        $cities = City::all();
        return view('panel.admin.areas.create', compact('states', 'cities'));
    }
}
