@extends('admin.main')
@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');
  $statusValue = [
    'default'  => config('zvn.template.status.default.name'),
    'active'   => config('zvn.template.status.active.name'),
    'inactive' => config('zvn.template.status.inactive.name')
  ];
  $elements = [
    [
      'label' => Form::label('name', 'Name',$formLabelAttr),
      'element' => Form::text('name', '',$formInputAttr),
      'error' => 'name'
    ],
    [
      'type' => 'btn-submit',
      'element' => Form::submit('Save',['class' => 'btn btn-success'])
    ]
  ];
@endphp
@section('content')
@include('admin.templates.page_header',['pageIndex' => false])
<div class="row">
  
  <div class="col-md-12">
    <ul class="nav nav-tabs">
      <li data="setting_main"><a href="#setting_main" data-toggle="tab" aria-expanded="true">Cấu Hình Chung <span class="glyphicon glyphicon-cog"></span></a></li>
      <li data="setting_email"><a href="#setting_email" data-toggle="tab">Cấu Hình Email <span class="glyphicon glyphicon-envelope"></span></a></li>
      <li data="setting_social"><a href="#setting_social" data-toggle="tab">Social Network <span class="glyphicon glyphicon-signal"></span></a></li>
    </ul>
  </div>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="tab-content">
    @include('admin.pages.setting.form_main')
    @include('admin.pages.setting.form_email')
    @include('admin.pages.setting.form_social')
    </div>
  </div> 
</div>

@endsection