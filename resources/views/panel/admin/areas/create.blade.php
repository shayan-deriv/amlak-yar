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
    <h3 class="text-primary"> افزودن محله </h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">داشبورد</a></li>
      <li class="breadcrumb-item active">محله </li>
      <li class="breadcrumb-item active">جدید </li>
    </ol>
  </div>
@endsection

@section('content')
  <form id="property_form" action="{{ route('areas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">


      {{-- مشخصات محله  --}}
      <div class="col-lg-12">
        <div class="card card-outline-primary">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">نام محله</label>
                        <input autocomplete="off" type="text" id="name" name="name"
                          value="{{ old('name', '') }}"
                          class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('name'))
                          <small class="form-control-feedback text-danger">{{ $errors->first('name') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-4">
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
                    <div class="col-md-4">
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

                    <div class="col-md-12">
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
