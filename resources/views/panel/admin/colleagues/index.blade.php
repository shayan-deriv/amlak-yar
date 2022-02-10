@extends('layouts.admin.panel')
@section('custom_css')
  <link rel="stylesheet" href="{{ url('admin/css/lib/date-picker/bootstrap-datepicker.min.css') }}">
  <link href="{{ url('admin/css/lib/bootstrap-select/bootstrap-select.min.css?v=3') }}" rel="stylesheet" />


@endsection
@section('page_title')
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary">مدیریت همکاران </h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
      <li class="breadcrumb-item active">همکاران</li>
    </ol>
  </div>
@endsection

@section('content')
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
                        <th class=" text-center">نام بنگاه</th>
                        <th class=" text-center"> صاحب بنگاه</th>
                        <th class=" text-center"> موبایل</th>
                        <th class=" text-center"> تلفن</th>
                        <th class=" text-center">محله</th>  
                        <th class=" text-center"> </th>
                      </tr>
                      <tr>
                        {{-- <th class=" "></th> --}}
                        <th class=" text-center">
                          <div id="example_filter" class="dataTables_filter" style="float:none">
                            <label>
                              <input autocomplete="off" type="text" id="title"
                                value="{{ app('request')->input('title') ? app('request')->input('title') : '' }}"
                                aria-controls="example">
                            </label>
                          </div>
                        </th>
                        <th class=" text-center">
                          <div id="example_filter" class="dataTables_filter" style="float:none">
                            <label>
                              <input autocomplete="off" type="text" id="owner"
                                value="{{ app('request')->input('owner') ? app('request')->input('owner') : '' }}"
                                aria-controls="example">
                            </label>
                          </div>
                        </th>
                        <th></th>
                        <th></th>
                        <th class=" text-center" style="min-width: 200px;padding-top:15px">
                          <select name="area_id" id="area_id" class="form-control selectpicker show-tick"
                            data-live-search="true">
                            <option value="" selected>
                              همه محله ها
                            </option>
                            @foreach ($areas as $area)
                              <option value="{{ $area->id }}" {{ app('request')->input('area_id') == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}
                              </option>
                            @endforeach
                          </select>
                        </th>
                        <th class=" text-center"> <button style="margin-top:7px" type="submit" class="btn btn-success"
                            onclick="search()"> جستجو <i class="fa fa-search"></i> </button> </th>
                      </tr>
                    </thead>
                    <tbody id="donees-content">
                      @forelse ($model as $item)
                        <tr>
                          <td data-title="نام بنگاه" class="simti_td_center" scope="row">{{ $item->title }}</th>
                          <td data-title="صاحب" class="simti_td_center">{{ $item->owner }}</td>
                          <td data-title="موبایل" class="simti_td_center">{{ $item->primary_mobile }}</td>
                          <td data-title="تلفن" class="simti_td_center">{{ $item->phone }}</td>
                          <td data-title="نام محله" class="simti_td_center">{{ $item->area->name }}</td>
                          <td data-title="عملیات" class="td_btn_custom_width">
                            <a class="has-arrow" target="_blank" href="{{ route('colleagues.edit', $item->id) }}"
                              aria-expanded="false" style="color:green">
                              {{-- <i class="fa fa-edit" aria-hidden="true"></i> --}}
                              <span class="">ویرایش</span>
                            </a>
                            <span style="padding: 0 2px;border-right:1px solid;"></span>
                            <a class="has-arrow" href="{{ route('colleagues.archive') }}?id={{ $item->id }}" onclick="return confirm('اطمینان دارید؟')"
                              aria-expanded="false" style="color:red">
                              {{-- <i  class="fa fa-close" aria-hidden="true"></i> --}}
                              <span class="">آرشیو</span>
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
  <script src="{{ url('admin/js/lib/bootstrap-select/bootstrap-select.min.js') }}"></script>
  <script>
    let params = {
      "title": "{{ app('request')->input('title') ? app('request')->input('title') : '' }}",
      "owner": "{{ app('request')->input('owner') ? app('request')->input('owner') : '' }}",
      "area_id": "{{ app('request')->input('area_id') ? app('request')->input('area_id') : '' }}",
    }

    const search = () => {
      let query = '?'
      params.title = $('#title').val();
      params.owner = $('#owner').val();
      params.area_id = $('#area_id').val();
      Object.entries(params).forEach(([key, value], index) => {
        if (value != "")
          query += `${key}=${value}&`
      });
      window.location.href = `{{ route('colleagues.index') }}` + query.slice(0, -1)
    }
  </script>
@endsection
