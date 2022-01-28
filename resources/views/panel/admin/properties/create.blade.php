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
                        <input autocomplete="off" type="text" id="full_name" name="full_name"
                          value="{{ old('full_name', '') }}"
                          class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('full_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('full_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">نام خانوادگی </label>
                        <input autocomplete="off" type="text" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label"> موبایل 1 </label>
                        <input autocomplete="off" type="text" id="mobile" name="mobile"
                          class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" maxlength="11"
                          value="{{ old('mobile', '') }}" onkeyup="onlyNumber(this)">
                        @if ($errors->has('mobile'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('mobile') }}</small>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">موبایل 2 </label>
                        <input autocomplete="off" type="text" id="mobile" name="mobile"
                          class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" maxlength="11"
                          value="{{ old('mobile', '') }}" onkeyup="onlyNumber(this)">
                        @if ($errors->has('mobile'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('mobile') }}</small>
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
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">استان</label>
                        <select name="type" id="period" class="form-control selectpicker show-tick"
                          data-live-search="true">
                          @foreach ($states as $state)
                            <option value="{{ $state->id }}">
                              {{ $state->fa_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">شهر</label>
                        <select name="type" id="period" class="form-control selectpicker show-tick"
                          data-live-search="true">
                          @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                              {{ $city->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">نوع ملک</label>
                        <select name="type" id="period" class="form-control selectpicker show-tick"
                          data-live-search="true">
                          @foreach (\App\Models\Property::typeList() as $id => $str)
                            <option value="{{ $id }}">
                              {{ $str }}
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
                        <label class="control-label">تعداد اتاق ها</label>
                        <input autocomplete="off" type="number" min="1" max="6" id="father_name" name="father_name"
                          value="{{ old('father_name', '6') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">طبقه</label>
                        <input autocomplete="off" type="number" min="0" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">کل طبقات</label>
                        <input autocomplete="off" type="number" min="0" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">واحد</label>
                        <input autocomplete="off" type="number" min="0" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">کل واحد ها</label>
                        <input autocomplete="off" type="number" min="0" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">مساحت</label>
                        <input autocomplete="off" type="number" min="0" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">بنای مفید</label>
                        <input autocomplete="off" type="number" min="0" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">سن بنا</label>
                        <input autocomplete="off" type="number" min="1" max="6" id="father_name" name="father_name"
                          value="{{ old('father_name', '6') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">قدر السهم (دانگ)</label>
                        <input autocomplete="off" type="number" min="1" max="6" id="father_name" name="father_name"
                          value="{{ old('father_name', '6') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">نمای ساختمان</label>
                        <input autocomplete="off" type="text" id="father_name" name="father_name"
                          value="{{ old('father_name', '') }}"
                          class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('father_name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('father_name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">نوع سند</label>
                        <select name="type" id="period" class="form-control">
                          @foreach (\App\Models\Property::deedList() as $index => $deed)
                            <option value="{{ $index }}">{{ $deed }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">کاربری</label>
                        <select name="type" id="period" class="form-control">
                          @foreach (\App\Models\Property::usageList() as $index => $usage)
                            <option value="{{ $index }}">{{ $usage }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">وضعیت سکنه</label>
                        <select name="type" id="period" class="form-control">
                          <option value="0" selected>خالی نمی باشد</option>
                          <option value="1">خالی می باشد</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">تاریخ تخلیه</label>
                        <input autocomplete="off" type="text" autocomplete="off" id="birth_date"
                          value="{{ old('birth_date', '') }}" name="birth_date"
                          class="form-control datepicker {{ $errors->has('birth_date') ? 'is-invalid' : '' }}">
                        @if ($errors->has('birth_date'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('birth_date') }}</small>
                        @endif
                      </div>
                    </div>





                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">سرویس بهداشتی</label>
                        <br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-secondary">
                            <input type="radio" autocomplete="off" value="1"> باهم
                          </label>
                          <label class="btn btn-secondary">
                            <input type="radio" autocomplete="off" value="0"> جدا
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
                            <input type="checkbox" autocomplete="off"> اجاره
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> فروش
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> پیش فروش
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
                            <input type="checkbox" autocomplete="off"> پارکینگ
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> انباری
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> آسانسور
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> تراس
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> حیاط
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> پارکت
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> سرمایشی
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> گرمایشی
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> تلفن
                          </label>
                          <label class="btn btn-secondary">
                            <input type="checkbox" autocomplete="off"> کابینت
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">سیستم گرمایشی</label>
                        <select name="type" id="period" class="form-control">
                          @foreach (\App\Models\Specification::heatingTypeList() as $index => $heating)
                            <option value="{{ $index }}">{{ $heating }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">آب</label>
                        <select name="type" id="period" class="form-control">
                          @foreach (\App\Models\Specification::powerTypeList() as $index => $heating)
                            <option value="{{ $index }}">{{ $heating }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">برق</label>
                        <select name="type" id="period" class="form-control">
                          @foreach (\App\Models\Specification::powerTypeList() as $index => $heating)
                            <option value="{{ $index }}">{{ $heating }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">گاز</label>
                        <select name="type" id="period" class="form-control">
                          @foreach (\App\Models\Specification::powerTypeList() as $index => $heating)
                            <option value="{{ $index }}">{{ $heating }}</option>
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
                            <input autocomplete="off" type="text" id="bank_account_number" name="bank_account_number"
                              value="{{ old('bank_account_number', '') }}"
                              class="form-control {{ $errors->has('bank_account_number') ? 'is-invalid' : '' }}"
                              onkeyup="onlyNumber(this)">
                            @if ($errors->has('bank_account_number'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('bank_account_number') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">قیمت هر متر</label>
                            <input autocomplete="off" maxlength="16" type="text" id="bank_card_number"
                              name="bank_card_number" value="{{ old('bank_card_number', '') }}"
                              class="form-control {{ $errors->has('bank_card_number') ? 'is-invalid' : '' }}"
                              onkeyup="onlyNumber(this)">
                            @if ($errors->has('bank_card_number'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('bank_card_number') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">قابل معاوضه</label>
                            <select name="type" id="period" class="form-control">
                              <option value="0">نمی باشد</option>
                              <option value="1">می باشد</option>
                            </select>
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">ودیعه</label>
                            <input autocomplete="off" type="text" id="bank_account_owner" name="bank_account_owner"
                              value="{{ old('bank_account_owner', '') }}"
                              class="form-control {{ $errors->has('bank_account_owner') ? 'is-invalid' : '' }}">
                            @if ($errors->has('bank_account_owner'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('bank_account_owner') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">اجاره بها</label>
                            <input autocomplete="off" type="text" id="bank_name" name="bank_name"
                              value="{{ old('bank_name', '') }}"
                              class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}">
                            @if ($errors->has('bank_name'))
                              <small
                                class="form-control-feedback text-danger">{{ $errors->first('bank_name') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">قابل تبدیل</label>
                            <select name="type" id="period" class="form-control">
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
                                <input type="checkbox" autocomplete="off"> فروخته شد
                              </label>
                              <label class="btn btn-secondary">
                                <input type="checkbox" autocomplete="off"> اجاره رفت
                              </label>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="form-actions text-left" style="margin-top:80px">
                        <button type="submit" class="btn btn-success" onclick="submit_form()"> ثبت <i
                            class="fa fa-check"></i> </button>
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
        yearRange: "1300:1400"
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
      let content = ``;
      for (let i = 0; i < donors.length; i++) {
        content += `
            <input type="hidden" name="donors[${i}][id]" value="${donors[i].id}">
            <input type="hidden" name="donors[${i}][type]" value="${donors[i].type}">
            <input type="hidden" name="donors[${i}][money]" value="${donors[i].money}">
            <input type="hidden" name="donors[${i}][no_money]" value="${donors[i].no_money}">
          `
      }

      $("#property_form").append(content)

      $("#property_form").submit();


    }
  </script>


@endsection
