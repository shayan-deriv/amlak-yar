@extends('layouts.admin.panel')
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
  <script>
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
  </script>
@endsection
