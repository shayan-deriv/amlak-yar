@extends('layouts.admin.panel')
@section('page_title')
  <div class="col-md-5 align-self-center">
      <h3 class="text-primary">داشبورد</h3> </div>
  <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>
          <li class="breadcrumb-item active">داشبورد</li>
      </ol>
  </div>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?type=1">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['villa']}} </h2>
              <p class="m-b-0">ویلایی</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?type=3">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['apartment']}} </h2>
              <p class="m-b-0">آپارتمان</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?type=2">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-home f-s-40 color-warning"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['field']}}</h2>
              <p class="m-b-0">زمین</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?type=5">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-user f-s-40 color-danger"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['large_field']}} </h2>
              <p class="m-b-0">زمین بزرگ</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?type=6">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-usd f-s-40 color-info"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['other']}}</h2>
              <p class="m-b-0">سایر</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?for_rent=true">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-gratipay f-s-40 color-success"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['for_rent']}} </h2>
              <p class="m-b-0">مورد اجاره ای</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?for_sell=true">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-edit f-s-40 color-primary"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['for_sell']}} </h2>
              <p class="m-b-0">مورد فروشی</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a href="{{route('properties.index')}}?for_colleague=true">
        <div class="card p-30">
          <div class="media">
            <div class="media-left meida media-middle">
              <span><i class="fa fa-handshake-o f-s-40 color-warning"></i></span>
            </div>
            <div class="media-body media-text-right">
              <h2>{{$counts['for_colleague']}} </h2>
              <p class="m-b-0">همکاران</p>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#normal_order" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>  معمولی
                      </span>
                      <span class="hidden-xs-down"> سفارش معمولی </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link show" data-toggle="tab" href="#activeOrder" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>پیش سفارش
                      </span>
                      <span class="hidden-xs-down">پیش سفارش </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link" data-toggle="tab" href="#receiveOrder" role="tab" aria-selected="false">
                      <span class="hidden-sm-up">
                        <br>نذری
                      </span>
                      <span class="hidden-xs-down"> نذری</span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="normal_order" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important" >
                          <thead>
                            <tr>
                              <th># سفارش</th>
                              <th>زمان تحویل</th>
                              <th>وضعیت</th>
                              <th>جزئیات</th>
                            </tr>
                          </thead>
                          <tbody id="active-orders-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20 show" id="activeOrder" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th># سفارش</th>
                                    <th>زمان تحویل</th>
                                    <th>وضعیت</th>
                                    <th>جزئیات</th>
                                  </tr>
                                </thead>
                                <tbody id="active-pre_order-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                  <div class="tab-pane p-20" id="receiveOrder" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th># سفارش</th>
                                    <th>زمان تحویل</th>
                                    <th>وضعیت</th>
                                    <th>جزئیات</th>
                                  </tr>
                                </thead>
                                <tbody id="active-recite-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#pending_kitchen" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>  در انتظار تایید
                      </span>
                      <span class="hidden-xs-down"> در انتظار تایید  </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link show" data-toggle="tab" href="#edit_pending_kitchen" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>در انتظار ویرایش 
                      </span>
                      <span class="hidden-xs-down">در انتظار ویرایش  </span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="pending_kitchen" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important">
                          <thead>
                            <tr>
                              <th>نام آشپزخانه </th>
                              <th>محله</th>
                              <th>جزئیات</th>
                            </tr>
                          </thead>
                          <tbody id="pending_kitchens-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20 show" id="edit_pending_kitchen" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th>نام آشپزخانه </th>
                                    <th>محله</th>
                                    <th>جزئیات</th>
                                  </tr>
                                </thead>
                                <tbody id="edited_pending_kitchens-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#suggested_food" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>  پیشنهاد غذا
                      </span>
                      <span class="hidden-xs-down"> پیشنهاد غذا </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link show" data-toggle="tab" href="#suggested_menu" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>پیشنهاد منو
                      </span>
                      <span class="hidden-xs-down">پیشنهاد منو </span>
                    </a>
                  </li>
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link" data-toggle="tab" href="#suggested_include" role="tab" aria-selected="false">
                      <span class="hidden-sm-up">
                        <br>پیشنهاد ترکیبات
                      </span>
                      <span class="hidden-xs-down"> پیشنهاد ترکیبات</span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="suggested_food" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important">
                          <thead>
                            <tr>
                              <th>نام</th>
                              <th>تایید/لغو</th>
                            </tr>
                          </thead>
                          <tbody id="suggested_food-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20 show" id="suggested_menu" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th>نام</th>
                                    <th>تایید/لغو</th>
                                  </tr>
                                </thead>
                                <tbody id="suggested_menu-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                  <div class="tab-pane p-20" id="suggested_include" role="tabpanel">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table table-hover table-striped" style="font-size:14px !important">
                                <thead>
                                  <tr>
                                    <th>نام</th>
                                    <th>تایید/لغو</th>
                                  </tr>
                                </thead>
                                <tbody id="suggested_include-content">
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="card simti_responsive_table_no_padding" style="padding:5px !important">
              <div class="card-body p-b-0">
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item simti_tab_33">
                    <a class="nav-link active show" data-toggle="tab" href="#pending_cm" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        <br>  معمولی
                      </span>
                      <span class="hidden-xs-down">  نظرات </span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane p-20 active show" id="pending_cm" role="tabpanel">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size:14px !important">
                          <thead>
                            <tr>
                              <th>کاربر </th>
                              <th>نظر</th>
                              <th style="text-align:center">تایید / رد</th>
                            </tr>
                          </thead>
                          <tbody id="cm-content">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

    
  </div> --}}
  <script>
    function toTimeFormat(seconds) {
      const date = new Date(seconds * 1000);
      const hh = date.getUTCHours();
      const mm = date.getUTCMinutes();
      const ss = ("0" + date.getUTCSeconds()).slice(-2);
      if (hh) {
        return `${hh}:${("0" + mm).slice(-2)}:${ss}`;
      }
      return `${mm}:${ss}`;
    }

  </script>
@endsection

 