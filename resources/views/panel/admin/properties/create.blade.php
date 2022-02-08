@extends('layouts.admin.panel')

@section('custom_css')
  <link rel="stylesheet" href="{{ url('admin/css/lib/date-picker/bootstrap-datepicker.min.css') }}">
  <link href="{{ url('admin/css/lib/bootstrap-select/bootstrap-select.min.css?v=3') }}" rel="stylesheet" />

  <style>
    .form-control:focus {
      color: #000000;
    }

    .form-control {
      color: #000000;
    }

    .bootstrap-select.show-tick .dropdown-menu .selected span.check-mark {
      left: 30px !important;
      top: 15px !important;
      right: initial !important;
    }

    .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
      text-align: right;
    }

    a.dropdown-item.selected.active {
      color: white !important;
    }

    .bootstrap-select .dropdown-toggle .filter-option {
      color: #000 !important;
    }


    .dropdown-item.active,
    .dropdown-item:active {
      background-color: #1d9742;
    }

    .filter-option {
      border: 1px solid #e7e7e7;
      border-radius: 4px !important;
    }

    .btn-light {
      background: white !important;
    }

    .btn-secondary:not(:disabled):not(.disabled).active,
    .btn-secondary:not(:disabled):not(.disabled):active,
    .show>.btn-secondary.dropdown-toggle {
      color: #fff !important;
    }

    .specifications {
      display: table !important;
    }

  </style>
@endsection
@section('page_title')
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary"> افزودن ملک</h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">داشبورد</a></li>
      <li class="breadcrumb-item active">ملک</li>
      <li class="breadcrumb-item active">جدید </li>
    </ol>
  </div>
@endsection

@section('content')
  <form id="property_form" action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

      {{-- اطلاعات مالک --}}
      <div class="col-lg-12">
        <div class="card card-outline-primary">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-body">
                  <h3 class="card-title m-t-15">۱) اطلاعات مالک</h3>
                  <hr>
                  <div class="row p-t-20">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">نام</label>
                        <input autocomplete="off" type="text" id="landlord_first_name" name="landlord_first_name"
                          value="{{ old('landlord_first_name', '') }}"
                          class="form-control {{ $errors->has('landlord_first_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('landlord_first_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('landlord_first_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">نام خانوادگی </label>
                        <input autocomplete="off" type="text" id="landlord_last_name" name="landlord_last_name"
                          value="{{ old('landlord_last_name', '') }}"
                          class="form-control {{ $errors->has('landlord_last_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('landlord_last_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('landlord_last_name') }}</small>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label"> موبایل 1 </label>
                        <input autocomplete="off" type="text" id="primary_mobile" name="primary_mobile"
                          class="form-control {{ $errors->has('primary_mobile') ? 'is-invalid' : '' }}" maxlength="11"
                          value="{{ old('primary_mobile', '') }}" onkeyup="onlyNumber(this)">
                        @if ($errors->has('primary_mobile'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('primary_mobile') }}</small>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">موبایل 2 </label>
                        <input autocomplete="off" type="text" id="secondary_mobile" name="secondary_mobile"
                          class="form-control {{ $errors->has('secondary_mobile') ? 'is-invalid' : '' }}" maxlength="11"
                          value="{{ old('secondary_mobile', '') }}" onkeyup="onlyNumber(this)">
                        @if ($errors->has('secondary_mobile'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('secondary_mobile') }}</small>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">شماره تلفن </label>
                        <input autocomplete="off" maxlength="11" type="text" id="phone" name="phone"
                          class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                          value="{{ old('phone', '') }}" onkeyup="onlyNumber(this)">
                        @if ($errors->has('phone'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('phone') }}</small>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- مشخصات ملک --}}
      <div class="col-lg-12">
        <div class="card card-outline-primary">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-body">
                  <h3 class="card-title m-t-15">2) اطلاعات ملک</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">استان</label>
                        <select name="state_id" id="state_id" class="form-control selectpicker show-tick"
                          data-live-search="true">
                          @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{old('state_id') == $state->id ? 'selected' : ''}}>
                              {{ $state->fa_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">مجتمع مسکونی</label>
                        <select name="complex_id" id="complex_id" class="form-control selectpicker show-tick"
                          data-live-search="true">
                          <option value="no" selected>
                            ندارد
                          </option>
                          @foreach ($complexes as $complex)
                            <option value="{{ $complex->id }}" {{old('complex_id') == $complex->id ? 'selected' : ''}}>
                              {{ $complex->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">آدرس</label>
                        <input autocomplete="off" type="text" id="address" name="address"
                          class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                          value="{{ old('address', '') }}">
                        @if ($errors->has('address'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('address') }}</small>
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
                        <label class="control-label">کل طبقات</label>
                        <input autocomplete="off" type="number" min="0" id="total_floor" name="total_floor"
                          value="{{ old('total_floor', '') }}"
                          class="form-control {{ $errors->has('total_floor') ? 'is-invalid' : '' }}">
                        @if ($errors->has('total_floor'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('total_floor') }}</small>
                        @endif
                      </div>
                    </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">واحد</label>
                        <input autocomplete="off" type="number" min="0" id="unit" name="unit"
                          value="{{ old('unit', '') }}"
                          class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}">
                        @if ($errors->has('unit'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('unit') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">کل واحد ها</label>
                        <input autocomplete="off" type="number" min="0" id="total_unit" name="total_unit"
                          value="{{ old('total_unit', '') }}"
                          class="form-control {{ $errors->has('total_unit') ? 'is-invalid' : '' }}">
                        @if ($errors->has('total_unit'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('total_unit') }}</small>
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
                        <label class="control-label">سن بنا</label>
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
                        <label class="control-label">قدر السهم (دانگ)</label>
                        <input autocomplete="off" type="number" min="1" max="6" id="share" name="share"
                          value="{{ old('share', '6') }}"
                          class="form-control {{ $errors->has('share') ? 'is-invalid' : '' }}">
                        @if ($errors->has('share'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('share') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">نمای ساختمان</label>
                        <input autocomplete="off" type="text" id="texture" name="texture"
                          value="{{ old('texture', '') }}"
                          class="form-control {{ $errors->has('texture') ? 'is-invalid' : '' }}">
                        @if ($errors->has('texture'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('texture') }}</small>
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
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="control-label">توضیحات</label>
                        <input autocomplete="off" type="text" id="description" name="description"
                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                          value="{{ old('description', '') }}">
                        @if ($errors->has('description'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('description') }}</small>
                        @endif
                      </div>
                    </div>




                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">سرویس بهداشتی</label>
                        <br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-secondary">
                            <input type="radio" autocomplete="off" name="toilet_together" value="1" {{old('toilet_together') == 1 ? 'checked' : ''}}> باهم
                          </label>
                          <label class="btn btn-secondary">
                            <input type="radio" autocomplete="off" name="toilet_together" value="0" {{old('toilet_together') == 1 ? 'checked' : ''}}> جدا
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
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
                    <div class="col-md-12">
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

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">گرمایشی</label>
                        <select name="heating" id="heating" class="form-control">
                          @foreach (\App\Models\Specification::heatingTypeList() as $index => $heating)
                            <option value="{{ $index }}" {{old('heating') == $index ? 'checked' : ''}}>{{ $heating }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">آب</label>
                        <select name="water" id="period" class="form-control">
                          @foreach (\App\Models\Specification::powerTypeList() as $index => $water)
                            <option value="{{ $index }}" {{old('water') == $index ? 'checked' : ''}}>{{ $water }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">برق</label>
                        <select name="electricity" id="period" class="form-control">
                          @foreach (\App\Models\Specification::powerTypeList() as $index => $electricity)
                            <option value="{{ $index }}" {{old('electricity') == $index ? 'checked' : ''}}>{{ $electricity }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- ثمن معامله --}}

      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-outline-primary">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-body">
                      <h3 class="box-title m-t-7">3) قیمت ملک</h3>
                      <hr>
                      <div class="row p-t-20">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">مبلغ کل</label>
                            <input autocomplete="off" type="text" id="total_price" name="total_price"
                              value="{{ old('total_price', '') }}"
                              class="form-control {{ $errors->has('total_price') ? 'is-invalid' : '' }}"
                              onkeyup="onlyNumber(this)">
                            @if ($errors->has('total_price'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('total_price') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">قیمت هر متر</label>
                            <input autocomplete="off" maxlength="16" type="text" id="unit_price"
                              name="unit_price" value="{{ old('unit_price', '') }}"
                              class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}"
                              onkeyup="onlyNumber(this)">
                            @if ($errors->has('unit_price'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('unit_price') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">قابل معاوضه</label>
                            <select name="exchangeable" id="period" class="form-control">
                              <option value="0">نمی باشد</option>
                              <option value="1">می باشد</option>
                            </select>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">ودیعه</label>
                            <input autocomplete="off" type="text" id="deposit" name="deposit"
                              value="{{ old('deposit', '') }}"
                              class="form-control {{ $errors->has('deposit') ? 'is-invalid' : '' }}">
                            @if ($errors->has('deposit'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('deposit') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">اجاره بها</label>
                            <input autocomplete="off" type="text" id="rent" name="rent"
                              value="{{ old('rent', '') }}"
                              class="form-control {{ $errors->has('rent') ? 'is-invalid' : '' }}">
                            @if ($errors->has('rent'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('rent') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">قابل تبدیل</label>
                            <select name="flexible" id="period" class="form-control">
                              <option value="0">نمی باشد</option>
                              <option value="1">می باشد</option>
                            </select>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">وضعیت</label>
                            <br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                              <label class="btn btn-secondary">
                                <input type="checkbox" autocomplete="off" name="sold"> فروخته شد
                              </label>
                              <label class="btn btn-secondary">
                                <input type="checkbox" autocomplete="off" name="rented"> اجاره رفت
                              </label>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="form-actions text-left" style="margin-top:80px">
                        <button type="submit" class="btn btn-success" onclick="submit_form()"> ثبت <i class="fa fa-check"></i> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </form>
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

@endsection

@section('custom_modal')

  <script>
    function disable_input() {
      if (Number($("#support_type").val()) == 1) {
        $("#support_amount").removeAttr("disabled")
        $("#support_description").val('')
        $("#support_description").attr("disabled", true)
      } else {
        $("#support_amount").attr("disabled", true)
        $("#support_amount").val(0);
        $("#support_description").removeAttr("disabled")
      }
    }

    function disable_input_edit() {
      if (Number($("#support_type_edit").val()) == 1) {
        $("#support_amount_edit").removeAttr("disabled")
        $("#support_description_edit").val('')
        $("#support_description_edit").attr("disabled", true)
      } else {
        $("#support_amount_edit").attr("disabled", true)
        $("#support_amount_edit").val(0);
        $("#support_description_edit").removeAttr("disabled")
      }
    }


    function submit_form() {
      $("#property_form").submit();
    }
  </script>


@endsection
