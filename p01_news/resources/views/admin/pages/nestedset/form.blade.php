@extends('admin.main')
@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $elements = [
    [
      'label' => Form::label('name', 'Name',$formLabelAttr),
      'element' => Form::text('name', '',$formInputAttr),
      'error' => 'name'
    ],
    [
      'label' => Form::label('parent', 'Status',$formLabelAttr),
      'element' => Form::select('parent', $arrParent, '',$formInputAttr),
      'error' => 'status'
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
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      @include('admin.templates.x_title',['title' => 'Form'])
      <div class="x_content">
      {!! Form::open([
            'method' => 'POST',
            'url' => route("$controllerName/save"),
            'accept-charset' => 'UTF-8',
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal form-label-left',
            'id' => 'main-form'
      ]) !!}
      {!! FormTemplate::show($elements,$errors) !!}
      {!! Form::close() !!}
    </div>
      
        {{-- 
          <div class="form-group">
            <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb">
              <p style="margin-top: 50px;"><img src="#" alt="Ưu đãi học phí" class="zvn-thumb"></p>
            </div>
          </div>--}}            
    </div>
  </div> 
</div>

@endsection