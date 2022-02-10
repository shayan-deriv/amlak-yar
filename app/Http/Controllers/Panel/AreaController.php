<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\State;
use App\Models\City;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $query = Area::query();

        if ($request->name) {
            $query->where('name', 'like', "%$request->name%");
        }

        $model = $query->published()->paginate(50);
        $model->appends($request->except('page'));
        return view('panel.admin.areas.index', compact('model'));
    }

    public function create()
    {
        $states = State::all();
        $cities = City::all();
        return view('panel.admin.areas.create', compact('states', 'cities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        Area::create($request->all());

        return redirect()->route('areas.index');
    }

    public function edit($area)
    {
        $model = Area::findOrFail($area);
        $states = State::all();
        $cities = City::all();
        $areas = Area::all();
        return view('panel.admin.areas.edit', compact('states', 'cities', 'areas', 'model'));
    }

    public function update(Request $request, $area)
    {
        $this->validate($request, [
            'name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        Area::where('id', $area)->update($request->except(['_token', '_method']));

        return redirect()->route('areas.index');
    }
}
