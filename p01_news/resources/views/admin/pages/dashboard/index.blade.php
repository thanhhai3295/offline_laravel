@extends('admin.main')
@section('content')
<div class="page-header zvn-page-header clearfix">
  <div class="zvn-page-header-title">
      <h3>DashBoard</h3>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
          @include('admin.templates.x_title',['title' => 'Quản Lý Thống Kê'])
          <div class="x_content">
            <div class="row">
              @php
                  $dashboardIcon = config('zvn.dashboard');
              @endphp
              @foreach ($countItems as $key => $value)
                <div class="col-md-3">
                  <div class="analytics">
                    <span class="count">{{$value}}</span>
                    <p>Tổng Số {{Str::ucfirst($key)}}</p>
                    <a href="{{route($key)}}">Xem Chi Tiết</a>
                    <span class="icon"><i class="{{$dashboardIcon[$key]['icon']}}"></i></span>
                  </div>
                </div>
              @endforeach  
           </div>
          </div>
      </div>
  </div>
</div>
@endsection