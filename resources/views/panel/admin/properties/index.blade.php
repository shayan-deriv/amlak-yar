@extends('layouts.admin.panel')
@section('custom_css')
<link rel="stylesheet" href="{{ url('admin/css/lib/date-picker/bootstrap-datepicker.min.css') }}">
<link href="{{ url('admin/css/lib/bootstrap-select/bootstrap-select.min.css?v=3') }}" rel="stylesheet" />
@endsection
@section('page_title')
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary">مدیریت ملک ها </h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
      <li class="breadcrumb-item active">ملک ها</li>
    </ol>
  </div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12 col-m-12 text-left">
    <i class="fa  fa-filter" aria-hidden="true" style="font-size:20px;cursor: pointer;" onclick="toggleFilterBox()"></i>
  </div>
</div>
<div class="row" id="filter_box" style="display:none">
  <div class="col-md-12 col-lg-12 col-sm-12 col-m-12">
    <div class="card simti_responsive_table_no_padding">
      <div class="card-body p-b-0">
        <div class="row p-t-20">


          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">شهر</label>
              <select name="city_id" id="city_id" class="form-control selectpicker show-tick"
                data-live-search="true">
                @foreach ($cities as $city)
                  <option value="{{ $city->id }}" {{old('city_id') == $city->id ? 'selected' : ''}}>
                    {{ $city->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">محله</label>
              <select name="area_id" id="area_id" class="form-control selectpicker show-tick"
                data-live-search="true">
                @foreach ($areas as $area)
                  <option value="{{ $area->id }}" {{old('area_id') == $area->id ? 'selected' : ''}}>
                    {{ $area->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">مجتمع مسکونی</label>
              <select name="complex_id" id="complex_id" class="form-control selectpicker show-tick"
                data-live-search="true">
                <option value="no" selected>
                  ندارد
                </option>
                @foreach ($complexes as $complex)
                  <option value="{{ $complex->id }}" {{old('complex_id') == $complex->id ? 'selected' : ''}}>
                    {{ $complex->title }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">حداکثر بودجه خرید</label>
              <input autocomplete="off" type="text" id="total_price" name="total_price"
                value="{{ old('total_price', '') }}"
                class="form-control {{ $errors->has('total_price') ? 'is-invalid' : '' }}"
                oninput="number_to_word(this)">
              @if ($errors->has('total_price'))
                <small
                  class="form-control-feedback text-danger">{{ $errors->first('total_price') }}</small>
              @endif
              <span class="form-control-feedback text-success text-sm alphabetic-number">
                {{App\Drivers\Number2Word::numberToWords(old('total_price',0))}} تومان
              </span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">حداکثر ودیعه</label>
              <input autocomplete="off" type="text" id="deposit" name="deposit"
                value="{{ old('deposit', '') }}"
                class="form-control {{ $errors->has('deposit') ? 'is-invalid' : '' }}" oninput="number_to_word(this)">
              @if ($errors->has('deposit'))
                <small
                  class="form-control-feedback text-danger">{{ $errors->first('deposit') }}</small>
              @endif

              <span class="form-control-feedback text-success text-sm alphabetic-number">
                {{App\Drivers\Number2Word::numberToWords(old('deposit',0))}} تومان
              </span>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">حداکثر اجاره بها</label>
              <input autocomplete="off" type="text" id="rent" name="rent"
                value="{{ old('rent', '') }}"
                class="form-control {{ $errors->has('rent') ? 'is-invalid' : '' }}" oninput="number_to_word(this)">
              @if ($errors->has('rent'))
                <small
                  class="form-control-feedback text-danger">{{ $errors->first('rent') }}</small>
              @endif
              <span class="form-control-feedback text-success text-sm alphabetic-number">
                {{App\Drivers\Number2Word::numberToWords(old('rent',0))}} تومان
              </span>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">مالک</label>
              <input autocomplete="off" type="text" id="landlord_first_name" name="landlord_first_name"
                value="{{ old('landlord_first_name', '') }}"
                class="form-control {{ $errors->has('landlord_first_name') ? 'is-invalid' : '' }}">
              @if ($errors->has('landlord_first_name'))
                <small class="form-control-feedback text-danger">{{ $errors->first('landlord_first_name') }}</small>
              @endif
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">نوع ملک</label>
              <select name="type" id="type" class="form-control selectpicker show-tick"
                data-live-search="true">
                @foreach (\App\Models\Property::typeList() as $id => $str)
                  <option value="{{ $id }}" {{old('type') == $id ? 'selected' : ''}}>
                    {{ $str }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">تعداد اتاق ها</label>
              <input autocomplete="off" type="number" min="0" max="6" id="total_rooms" name="total_rooms"
                value="{{ old('total_rooms', '') }}"
                class="form-control {{ $errors->has('total_rooms') ? 'is-invalid' : '' }}">
              @if ($errors->has('total_rooms'))
                <small class="form-control-feedback text-danger">{{ $errors->first('total_rooms') }}</small>
              @endif
            </div>
          </div>


          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">طبقه</label>
              <input autocomplete="off" type="number" min="0" id="floor" name="floor"
                value="{{ old('floor', '') }}"
                class="form-control {{ $errors->has('floor') ? 'is-invalid' : '' }}">
              @if ($errors->has('floor'))
                <small class="form-control-feedback text-danger">{{ $errors->first('floor') }}</small>
              @endif
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">مساحت</label>
              <input autocomplete="off" type="number" min="0" id="total_area" name="total_area"
                value="{{ old('total_area', '') }}"
                class="form-control {{ $errors->has('total_area') ? 'is-invalid' : '' }}">
              @if ($errors->has('total_area'))
                <small class="form-control-feedback text-danger">{{ $errors->first('total_area') }}</small>
              @endif
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">بنای مفید</label>
              <input autocomplete="off" type="number" min="0" id="built_area" name="built_area"
                value="{{ old('built_area', '') }}"
                class="form-control {{ $errors->has('built_area') ? 'is-invalid' : '' }}">
              @if ($errors->has('built_area'))
                <small class="form-control-feedback text-danger">{{ $errors->first('built_area') }}</small>
              @endif
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">حداکثر سن بنا</label>
              <input autocomplete="off" type="number" min="0" id="age" name="age"
                value="{{ old('age', '') }}"
                class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}">
              @if ($errors->has('age'))
                <small class="form-control-feedback text-danger">{{ $errors->first('age') }}</small>
              @endif
            </div>
          </div>

          
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">نوع سند</label>
              <select name="deed" id="deed" class="form-control">
                @foreach (\App\Models\Property::deedList() as $index => $deed)
                  <option value="{{ $index }}" {{old('deed') == $index ? 'selected' : ''}}>{{ $deed }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">کاربری</label>
              <select name="usage" id="usage" class="form-control">
                @foreach (\App\Models\Property::usageList() as $index => $usage)
                  <option value="{{ $index }}" {{old('usage') == $index ? 'selected' : ''}}>{{ $usage }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">وضعیت سکنه</label>
              <select name="is_empty" id="is_empty" class="form-control">
                <option value="0" {{old('is_empty') == 0 ? 'selected' : ''}}>خالی نمی باشد</option>
                <option value="1" {{old('is_empty') == 1 ? 'selected' : ''}}>خالی می باشد</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">تاریخ تخلیه</label>
              <input autocomplete="off" type="text" autocomplete="off" name="evacuation_date"
                value="{{ old('evacuation_date', '') }}" name="evacuation_date"
                class="form-control datepicker {{ $errors->has('evacuation_date') ? 'is-invalid' : '' }}">
              @if ($errors->has('evacuation_date'))
                <small class="form-control-feedback text-danger">{{ $errors->first('evacuation_date') }}</small>
              @endif
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">گرمایشی</label>
              <select name="heating" id="heating" class="form-control">
                @foreach (\App\Models\Specification::heatingTypeList() as $index => $heating)
                  <option value="{{ $index }}" {{old('heating') == $index ? 'checked' : ''}}>{{ $heating }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">آب</label>
              <select name="water" id="period" class="form-control">
                @foreach (\App\Models\Specification::powerTypeList() as $index => $water)
                  <option value="{{ $index }}" {{old('water') == $index ? 'checked' : ''}}>{{ $water }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">برق</label>
              <select name="electricity" id="period" class="form-control">
                @foreach (\App\Models\Specification::powerTypeList() as $index => $electricity)
                  <option value="{{ $index }}" {{old('electricity') == $index ? 'checked' : ''}}>{{ $electricity }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">گاز</label>
              <select name="gas" id="period" class="form-control">
                @foreach (\App\Models\Specification::powerTypeList() as $index => $gas)
                  <option value="{{ $index }}" {{old('gas') == $index ? 'checked' : ''}}>{{ $gas }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">نوع درخواست</label>
              <br>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary">
                  <input type="checkbox" name="for_rent" {{old('for_rent') == 1 ? 'checked' : ''}} autocomplete="off"> اجاره
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="for_sell" {{old('for_sell') == 1 ? 'checked' : ''}} autocomplete="off"> فروش
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="for_pre_sell" {{old('for_pre_sell') == 1 ? 'checked' : ''}} autocomplete="off"> پیش فروش
                </label>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group">
              <label class="control-label">سایر امکانات</label>
              <br>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary">
                  <input type="checkbox" name="parking" {{old('parking') == 1 ? 'checked' : ''}} autocomplete="off"> پارکینگ
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="storage" {{old('storage') == 1 ? 'checked' : ''}} autocomplete="off"> انباری
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="elevator" {{old('elevator') == 1 ? 'checked' : ''}} autocomplete="off"> آسانسور
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="balcony" {{old('balcony') == 1 ? 'checked' : ''}} autocomplete="off"> تراس
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="yard" {{old('yard') == 1 ? 'checked' : ''}} autocomplete="off"> حیاط
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="parket" {{old('parket') == 1 ? 'checked' : ''}} autocomplete="off"> پارکت
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="cooling" {{old('cooling') == 1 ? 'checked' : ''}} autocomplete="off"> سرمایشی
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="telephone" {{old('telephone') == 1 ? 'checked' : ''}} autocomplete="off"> تلفن
                </label>
                <label class="btn btn-secondary">
                  <input type="checkbox" name="cabinet" {{old('cabinet') == 1 ? 'checked' : ''}} autocomplete="off"> کابینت
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions text-left" >
          <button type="submit" class="btn btn-success" onclick="submit_form()"> جستجو <i class="fa fa-search"></i> </button>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-m-12">
      <div class="card simti_responsive_table_no_padding">
        <div class="card-body p-b-0">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane  p-20 active" id="donees" role="tabpanel">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table class="table table-striped ">
                    <thead>
                      <tr>
                        {{-- <th class=" ">ردیف</th> --}}
                        <th class=" text-center">مالک</th>
                        <th class=" text-center">نوع ملک</th>
                        <th class=" text-center">نوع معامله</th>
                        <th class=" text-center">آدرس ملک</th>
                        <th class=" text-center">اجاره بها</th>
                        <th class=" text-center">قیمت فروش / پیش فروش</th>
                        <th class=" text-center"> </th>
                      </tr>
                    </thead>
                    <tbody id="donees-content">
                      @forelse ($model as $item)
                        <tr>
                          {{-- <td data-title="ردیف" class="row_col_10" scope="row">{{ $item->id }}</th> --}}
                          <td data-title="مالک" class="simti_td_center">{{ $item->landlord }}</td>
                          <td data-title="مالک" class="simti_td_center">{{ $item->type_str }}</td>
                          <td data-title="نوع معامله" class="simti_td_center">
                            {{ $item->for_rent ? 'اجاره' : '' }}
                            {{ $item->for_sell ? '/ فروش' : '' }}
                            {{ $item->for_pre_sell ? '/ پیش فروش' : '' }}
                          </td>
                          <td data-title="آدرس" class="simti_td_center">{{ $item->city->name }} {{ $item->area ? ' - '.$item->area->name : ''}} {{ $item->complex ? ' - مجتمع '.$item->complex->title : ''}} - {{ $item->address}}</td>

                            <td data-title="اجاره بها" class="simti_td_center">
                              پیش: {{ number_format($item->specification->deposit) ?? '' }}
                              <br>
                              کرایه : {{ number_format($item->specification->rent) ?? '' }}
                            </td>

                          @if (isset($item->for_sell) && $item->for_sell)
                            <td data-title="قیمت فروش" class="simti_td_center">
                              متری : {{ number_format($item->specification->unit_price) ?? '' }}
                              <br>
                              مجموع : {{ number_format($item->specification->total_price) ?? '' }}
                            </td>
                          
                          @elseif (isset($item->for_pre_sell) && $item->for_pre_sell)
                            <td data-title="قیمت پیش فروش" class="simti_td_center">
                              متری : {{ number_format($item->specification->unit_price) ?? '' }}
                              <br>
                              مجموع : {{ number_format($item->specification->total_price) ?? '' }}
                            </td>
                          @else
                            <td></td>
                          @endif

                          <td data-title="عملیات" class="td_btn_custom_width">
                            <a class="has-arrow"  href="{{ route('properties.duplicate', $item->id) }}"
                              aria-expanded="false" style="color:rgb(209, 161, 41)">
                              {{-- <i class="fa fa-edit" aria-hidden="true"></i> --}}
                              <span class="">کپی</span>
                            </a>
                            <span style="padding: 0 2px;border-right:1px solid;"></span>
                            <a class="has-arrow" target="_blank" href="{{ route('properties.edit', $item->id) }}"
                              aria-expanded="false" style="color:green">
                              {{-- <i class="fa fa-edit" aria-hidden="true"></i> --}}
                              <span class="">ویرایش</span>
                            </a>
                            <span style="padding: 0 2px;border-right:1px solid;"></span>
                            <a class="has-arrow" href="{{ route('properties.archive') }}?id={{ $item->id }}" onclick="return confirm('اطمینان دارید؟')"
                              aria-expanded="false" style="color:red">
                              {{-- <i  class="fa fa-close" aria-hidden="true"></i> --}}
                              <span class="">بایگانی</span>
                            </a>
                          </td>
                        </tr>

                      @empty
                        <tr>
                          <td colspan="10" class="text-muted text-center">
                            موردی یافت نشد
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="pt-4">
                  {{ $model->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom_js')
<script src="{{ url('admin/js/lib/date-picker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('admin/js/lib/date-picker/bootstrap-datepicker.fa.min.js') }}"></script>
<script src="{{ url('admin/js/lib/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $(".datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1400:1450"
    });
  });
</script>
  <script>
    filter = false;
    let params = {
      "title": "{{ app('request')->input('title') ? app('request')->input('title') : '' }}",
      "manager": "{{ app('request')->input('manager') ? app('request')->input('manager') : '' }}",
    }

    const search = () => {
      let query = '?'
      params.title = $('#title').val();
      params.manager = $('#manager').val();
      Object.entries(params).forEach(([key, value], index) => {
        if (value != "")
          query += `${key}=${value}&`
      });
      window.location.href = `{{ route('properties.index') }}` + query.slice(0, -1)
    }

    function toggleFilterBox(){
      if(!filter)
        $("#filter_box").show();
      else
        $("#filter_box").hide();
      
      filter = !filter;
    }

    function number_to_word(el){
      onlyNumber(el);
      el.parentNode.querySelector('.alphabetic-number').innerHTML = Num2persian(el.value)+" تومان";
    }
  </script>
@endsection
