<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Drivers\Time;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Colleague;

class ColleageController extends Controller
{
    public function index(Request $request)
    {
        $query = Colleague::query();

        if($request->title){
            $query->where('title','like',"%$request->title%");
        }

        if($request->manager){
            $query->where('manager','like',"%$request->manager%");
        }

        $model = $query->published()->paginate(50);
        $model->appends($request->except('page'));
        return view('panel.admin.colleagues.index', compact('model'));
    }

    public function create()
    {
        $states = State::all();
        $cities = City::all();
        $areas = Area::all();
        return view('panel.admin.colleagues.create', compact('states', 'cities', 'areas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        
        Colleague::create($request->all());

        return redirect()->route('colleagues.index');
    }

    public function edit($colleague)
    {
        $model = Colleague::findOrFail($colleague);
        $states = State::all();
        $cities = City::all();
        $areas = Area::all();
        return view('panel.admin.colleagues.edit', compact('states', 'cities', 'areas', 'model'));
    }

    public function update(Request $request, $colleague){
        $this->validate($request, [
            'title' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        
        Colleague::where('id',$colleague)->update($request->except(['_token','_method']));

        return redirect()->route('colleagues.index');
    }

    public function archive(Request $request){
        
        Colleague::where('id',$request->id)->update([
            'status' => Colleague::ARCHIVED
        ]);

        return redirect()->route('colleagues.index');
    }

    public function unarchive(Request $request){
        
        Colleague::where('id',$request->id)->update([
            'status' => Colleague::PUBLISHED
        ]);

        return redirect()->route('colleagues.index');
    }
}
