@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary">مدیریت محله ها </h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
      <li class="breadcrumb-item active">محله ها</li>
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
                        <th class=" text-center">نام محله</th>
                        {{-- <th class=" text-center">استان</th>
                        <th class=" text-center">شهر</th> --}}
                        <th class=" text-center"> </th>
                      </tr>
                      <tr>
                        {{-- <th class=" "></th> --}}
                        <th class=" text-center">
                          <div id="example_filter" class="dataTables_filter" style="float:none">
                            <label>
                              <input autocomplete="off" type="text" id="name"
                                value="{{ app('request')->input('name') ? app('request')->input('name') : '' }}"
                                aria-controls="example">
                            </label>
                          </div>
                        </th>
                        <th class=" text-center"> <button style="margin-top:7px" type="submit" class="btn btn-success"
                            onclick="search()"> جستجو <i class="fa fa-search"></i> </button> </th>
                      </tr>
                    </thead>
                    <tbody id="donees-content">
                      @forelse ($model as $item)
                        <tr>
                          {{-- <td data-title="ردیف" class="row_col_10" scope="row">{{ $item->id }}</th> --}}
                          <td data-title="نام محله" class="simti_td_center">{{ $item->name }}</td>
                          <td data-title="عملیات" class="td_btn_custom_width">
                            <a class="has-arrow" target="_blank" href="{{ route('areas.edit', $item->id) }}"
                              aria-expanded="false" style="color:green">
                              {{-- <i class="fa fa-edit" aria-hidden="true"></i> --}}
                              <span class="">ویرایش</span>
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
  <script>
    let params = {
      "name": "{{ app('request')->input('name') ? app('request')->input('name') : '' }}",
    }

    const search = () => {
      let query = '?'
      params.name = $('#name').val();
      Object.entries(params).forEach(([key, value], index) => {
        if (value != "")
          query += `${key}=${value}&`
      });
      window.location.href = `{{ route('areas.index') }}` + query.slice(0, -1)
    }
  </script>
@endsection
