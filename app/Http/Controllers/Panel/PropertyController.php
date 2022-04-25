<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drivers\Time;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Complex;
use App\Models\Property;
use App\Models\Attachment;
use App\Models\Specification;
use Carbon\Carbon;
use App\Http\Requests\DoneeRequest;

class PropertyController extends Controller
{
  public function index(Request $request)
  {
    $states = State::all();
    $cities = City::all();
    $areas = Area::all();
    $complexes = Complex::all();
    $query = Property::published();
    if($request->city_id){
      $query->where('city_id',$request->city_id);
    }
    if($request->area_id){
      $query->where('area_id',$request->area_id);
    }
    if($request->complex_id){
      if($request->complex_id == "no")
        $query->where('complex_id',null);
      else
        $query->where('complex_id',$request->complex_id);
    }
    if($request->total_price){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('total_price',"<=",$request->total_price);
      });
    }
    if($request->deposit){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('deposit',"<=",$request->deposit);
      });
    }
    if($request->rent){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('rent',"<=",$request->rent);
      });
    }
    if($request->landlord){
      $query->where('landlord',"like","%$request->landlord%");
    }
    if($request->type){
      $query->where('type',$request->type);
    }
    if($request->total_rooms){
      $query->where('total_rooms',$request->total_rooms);
    }
    if($request->floor){
      $query->where('floor',$request->floor);
    }
    if($request->total_area){
      $query->where('total_area',"<=",$request->total_area);
    }
    if($request->built_area){
      $query->where('built_area',"<=",$request->built_area);
    }
    if($request->age){
      $query->where('age',"<=",$request->age);
    }
    if($request->deed){
      $query->where('deed',$request->deed);
    }
    if($request->usage){
      $query->where('usage',$request->usage);
    }
    if($request->is_empty){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('is_empty',$request->is_empty);
      });
    }
    if($request->evacuation_date){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->whereDate('evacuation_date',"<=",\Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $request->evacuation_date)->format('Y-m-d H:i:s'));
      });
    }
    // if($request->heating){
    //   $query->where('heating',$request->heating);
    // }
    // if($request->water){
    //   $query->where('water',$request->water);
    // }
    // if($request->electricity){
    //   $query->where('electricity',$request->electricity);
    // }
    // if($request->gas){
    //   $query->where('gas',$request->gas);
    // }
    if($request->for_rent){
      $query->where('for_rent',1);
    }
    if($request->for_sell){
      $query->where('for_sell',1);
    }
    if($request->for_pre_sell){
      $query->where('for_pre_sell',1);
    }
    if($request->parking){
      $query->where('parking',1);
    }
    if($request->storage){
      $query->where('storage',1);
    }
    if($request->elevator){
      $query->where('elevator',1);
    }
    if($request->balcony){
      $query->where('balcony',1);
    }
    if($request->yard){
      $query->where('yard',1);
    }
    if($request->parket){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('parket',1);
      });
    }
    if($request->cooling){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('cooling',1);
      });
    }
    if($request->telephone){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('telephone',1);
      });
    }
    if($request->cabinet){
      $query->whereHas('specification',function($sub_query)  use($request){
        $sub_query->where('cabinet',1);
      });
    }

    if($request->for_colleague){
      $query->where('for_colleague',1);
    }

    $model = $query->orderByDesc('created_at')->paginate(50);
    $model->appends($request->except('page'));
    return view('panel.admin.properties.index', compact('model', 'states', 'cities', 'areas', 'complexes'));
  }
  public function create()
  {
    $states = State::all();
    $cities = City::all();
    $areas = Area::all();
    $complexes = Complex::all();
    return view('panel.admin.properties.create', compact('states', 'cities', 'areas', 'complexes'));
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'landlord' => 'required',
      'state_id' => 'required',
      'city_id' => 'required',
      'area_id' => 'required',
      'complex_id' => 'required',
      'type' => 'required',
      'water' => 'required',
      'electricity' => 'required',
      'gas' => 'required',
      'attachments.*' => ""
    ]);

    $property = Property::create([
      'type' => $request->type ?? 1,
      'landlord' => $request->landlord,
      'primary_mobile' => $request->primary_mobile ?? null,
      'secondary_mobile' => $request->secondary_mobile ?? null,
      'phone' => $request->phone ?? null,
      'house_phone' => $request->house_phone ?? null,
      'address' => $request->address ?? null,
      'description' => $request->description ?? null,
      'deed' => $request->deed ?? Property::SANAD,
      'usage' => $request->usage ?? Property::RESIDENTIAL,
      'for_rent' => ($request->for_rent && $request->for_rent == "on") ? true : false,
      'for_sell' => ($request->for_sell && $request->for_sell == "on") ? true : false,
      'for_pre_sell' => ($request->for_pre_sell && $request->for_pre_sell == "on") ? true : false,
      'for_colleague' => ($request->for_colleague && $request->for_colleague == "on") ? true : false,
      'parking' => ($request->parking && $request->parking == "on") ? true : false,
      'storage' => ($request->storage && $request->storage == "on") ? true : false,
      'elevator' => ($request->elevator && $request->elevator == "on") ? true : false,
      'balcony' => ($request->balcony && $request->balcony == "on") ? true : false,
      'yard' => ($request->yard && $request->yard == "on") ? true : false,
      'share' => $request->share ?? 6,
      'floor' => $request->floor ?? 0,
      'total_floor' => $request->total_floor ?? null,
      'unit' => $request->unit ?? 0,
      'total_unit' => $request->total_unit ?? null,
      'total_area' => $request->total_area ?? null,
      'built_area' => $request->built_area ?? null,
      'age' => $request->age ?? null,
      'total_rooms' => $request->total_rooms ?? 0,
      'toilet_together' => $request->toilet_together ?? false,
      'state_id' => $request->state_id ?? null,
      'city_id' => $request->city_id ?? null,
      'area_id' => $request->area_id ?? null,
      'complex_id' => $request->complex_id && $request->complex_id != 'no' ? $request->complex_id : null,
    ]);

    $property->refresh();

    Specification::create([
      'property_id' => $property->id,
      'total_price' => $request->total_price ?? null,
      'tenant_mobile' => $request->tenant_mobile ?? null,
      'tenant' => $request->tenant ?? null,
      'unit_price'  => $request->unit_price ?? null,
      'deposit' => $request->deposit ?? null,
      'rent'  => $request->rent ?? null,
      'is_empty'  => $request->is_empty ?? 0,
      'sold'  => ($request->rent && $request->rent == "on") ? true : false,
      'rented'  => ($request->rented && $request->rented == "on") ? true : false,
      'exchangeable'  => $request->exchangeable ?? 0,
      'flexible'  => $request->flexible ?? 0,
      'cabinet' => ($request->cabinet && $request->cabinet == "on") ? true : false,
      'parket'  => ($request->parket && $request->parket == "on") ? true : false,
      'heating' => $request->heating ? serialize($request->heating) : serialize(['0']),
      'cooling' => ($request->cooling && $request->cooling == "on") ? true : false,
      'telephone' => ($request->telephone && $request->telephone == "on") ? true : false,
      'water' => $request->water ?? 0,
      'electricity' => $request->electricity ?? 0,
      'gas' => $request->gas ?? 0,
      'ceramic_floor' => ($request->ceramic_floor && $request->ceramic_floor == "on") ? true : false,
      'farangi_toilet' => ($request->farangi_toilet && $request->farangi_toilet == "on") ? true : false,
      'evacuation_date' =>  $request->evacuation_date ? (\Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $request->evacuation_date)->format('Y-m-d H:i:s')) : null
    ]);

    if($request->hasFile('attachments')){
      foreach($request->file('attachments') as $image)
      {
          $destinationPath = 'images/';
          $filename = time()."_".str_random(10).".".pathinfo($image->getClientOriginalName(),PATHINFO_EXTENSION);
          $image->move($destinationPath, $filename);
          $attachment = Attachment::create([
            'property_id' => $property->id,
            'url' => $destinationPath.$filename
          ]);

      }
    }

    return redirect()->route('properties.index');
  }
  public function edit($property)
  {
    $model = Property::find($property);
    $states = State::all();
    $cities = City::all();
    $areas = Area::all();
    $complexes = Complex::all();
    return view('panel.admin.properties.edit', compact('model', 'states', 'cities', 'areas', 'complexes'));
  }
  public function update(Request $request, $property)
  {
    $this->validate($request, [
      'landlord' => 'required',
      'state_id' => 'required',
      'city_id' => 'required',
      'area_id' => 'required',
      'complex_id' => 'required',
      'type' => 'required',
      'water' => 'required',
      'electricity' => 'required',
      'gas' => 'required',
    ]);

    Property::findOrFail($property)->update([
      'type' => $request->type ?? 1,
      'landlord' => $request->landlord,
      'primary_mobile' => $request->primary_mobile ?? null,
      'secondary_mobile' => $request->secondary_mobile ?? null,
      'phone' => $request->phone ?? null,
      'house_phone' => $request->house_phone ?? null,
      'for_colleague' => ($request->for_colleague && $request->for_colleague == "on") ? true : false,
      'address' => $request->address ?? null,
      'description' => $request->description ?? null,
      'deed' => $request->deed ?? Property::SANAD,
      'usage' => $request->usage ?? Property::RESIDENTIAL,
      'for_rent' => ($request->for_rent && $request->for_rent == "on") ? true : false,
      'for_sell' => ($request->for_sell && $request->for_sell == "on") ? true : false,
      'for_pre_sell' => ($request->for_pre_sell && $request->for_pre_sell == "on") ? true : false,
      'parking' => ($request->parking && $request->parking == "on") ? true : false,
      'storage' => ($request->storage && $request->storage == "on") ? true : false,
      'elevator' => ($request->elevator && $request->elevator == "on") ? true : false,
      'balcony' => ($request->balcony && $request->balcony == "on") ? true : false,
      'yard' => ($request->yard && $request->yard == "on") ? true : false,
      'share' => $request->share ?? 6,
      'floor' => $request->floor ?? 0,
      'total_floor' => $request->total_floor ?? null,
      'unit' => $request->unit ?? 0,
      'total_unit' => $request->total_unit ?? null,
      'total_area' => $request->total_area ?? null,
      'built_area' => $request->built_area ?? null,
      'age' => $request->age ?? null,
      'total_rooms' => $request->total_rooms ?? 0,
      'toilet_together' => $request->toilet_together ?? false,
      'state_id' => $request->state_id ?? null,
      'city_id' => $request->city_id ?? null,
      'area_id' => $request->area_id ?? null,
      'complex_id' => $request->complex_id && $request->complex_id != 'no' ? $request->complex_id : null,
    ]);


    Specification::where('property_id', $property)->update([
      'total_price' => $request->total_price ?? null,
      'tenant_mobile' => $request->tenant_mobile ?? null,
      'tenant' => $request->tenant ?? null,
      'unit_price'  => $request->unit_price ?? null,
      'deposit' => $request->deposit ?? null,
      'rent'  => $request->rent ?? null,
      'ceramic_floor' => $request->ceramic_floor ?? 0,
      'farangi_toilet' => $request->farangi_toilet ?? 0,
      'is_empty'  => $request->is_empty ?? 0,
      'sold'  => ($request->rent && $request->rent == "on") ? true : false,
      'rented'  => ($request->rented && $request->rented == "on") ? true : false,
      'exchangeable'  => $request->exchangeable ?? 0,
      'flexible'  => $request->flexible ?? 0,
      'cabinet' => ($request->cabinet && $request->cabinet == "on") ? true : false,
      'parket'  => ($request->parket && $request->parket == "on") ? true : false,
      'heating' => $request->heating ? serialize($request->heating) : serialize(['0']),
      'cooling' => ($request->cooling && $request->cooling == "on") ? true : false,
      'telephone' => ($request->telephone && $request->telephone == "on") ? true : false,
      'ceramic_floor' => ($request->ceramic_floor && $request->ceramic_floor == "on") ? true : false,
      'farangi_toilet' => ($request->farangi_toilet && $request->farangi_toilet == "on") ? true : false,
      'water' => $request->water ?? 0,
      'electricity' => $request->electricity ?? 0,
      'gas' => $request->gas ?? 0,
      'evacuation_date' =>  $request->evacuation_date ? (\Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $request->evacuation_date)->format('Y-m-d H:i:s')) : null
    ]);

    if($request->hasFile('attachments')){
      foreach($request->file('attachments') as $image)
      {
          $destinationPath = 'images/';
          $filename = time()."_".str_random(10).".".pathinfo($image->getClientOriginalName(),PATHINFO_EXTENSION);
          $image->move($destinationPath, $filename);
          $attachment = Attachment::create([
            'property_id' => $property,
            'url' => $destinationPath.$filename
          ]);

      }
    }

    return redirect()->route('properties.index');
  }

  public function archive(Request $request)
  {

    Property::where('id', $request->id)->update([
      'status' => Property::ARCHIVED
    ]);

    return redirect()->route('properties.index');
  }

  public function delete(Request $request)
  {

    Property::where('id', $request->id)->update([
      'status' => Property::DELETED
    ]);

    return redirect()->route('properties.index');
  }

  public function archived(Request $request)
  {
    $model = Property::archived()->orderByDesc('created_at')->paginate(50);
    $model->appends($request->except('page'));
    return view('panel.admin.archived.properties', compact('model'));
  }

  public function publish(Request $request)
  {

    Property::where('id', $request->id)->update([
      'status' => Property::PUBLISHED
    ]);

    return redirect()->route('archived.properties');
  }

  public function toBeEvacuated(Request $request)
  {
    $model = Property::published()
      ->join('specifications', 'specifications.property_id', '=', 'properties.id')
      ->where('for_rent',1)
      ->where('specifications.evacuation_date', '!=', null )
      ->where('specifications.evacuation_date', '<=', Carbon::now()->addDays(60)->toDateString())
      ->where('specifications.evacuation_date', '>=', Carbon::now()->toDateString())
      ->orderBy('specifications.evacuation_date')
      ->paginate(50); 

    $model->appends($request->except('page'));
    return view('panel.admin.to_be_evacuated.index', compact('model'));
  }

  public function duplicate($property)
  {
    $model = Property::find($property);
    $states = State::all();
    $cities = City::all();
    $areas = Area::all();
    $complexes = Complex::all();
    return view('panel.admin.properties.duplicate', compact('model', 'states', 'cities', 'areas', 'complexes'));
  }

  public function deleteAttachment($attachment){
    $pic = Attachment::find($attachment);
    $path_to_be_deleted = $pic->url;
    if($pic->delete()){
      if (file_exists($path_to_be_deleted)) {
        @unlink($path_to_be_deleted);
     }
    }

    return redirect()->back();
  }
}
