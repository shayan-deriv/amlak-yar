<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Drivers\Time;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Complex;

class ComplexController extends Controller
{
    public function index(Request $request)
    {
        $query = Complex::query();

        if($request->title){
            $query->where('title','like',"%$request->title%");
        }

        if($request->manager){
            $query->where('manager','like',"%$request->manager%");
        }

        $model = $query->published()->paginate(50);
        $model->appends($request->except('page'));
        return view('panel.admin.complexes.index', compact('model'));
    }

    public function create()
    {
        $states = State::all();
        $cities = City::all();
        $areas = Area::all();
        return view('panel.admin.complexes.create', compact('states', 'cities', 'areas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        
        Complex::create($request->all());

        return redirect()->route('complexes.index');
    }

    public function edit($complex)
    {
        $model = Complex::findOrFail($complex);
        $states = State::all();
        $cities = City::all();
        $areas = Area::all();
        return view('panel.admin.complexes.edit', compact('states', 'cities', 'areas', 'model'));
    }

    public function update(Request $request, $complex){
        $this->validate($request, [
            'title' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        
        Complex::where('id',$complex)->update($request->except(['_token','_method']));

        return redirect()->route('complexes.index');
    }
}
