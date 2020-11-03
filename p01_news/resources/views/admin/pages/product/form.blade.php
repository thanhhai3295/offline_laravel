@extends('admin.main')
@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');
  $inputHiddenID = Form::hidden('id', $item['id']);
  $arrParent = Template::arrParentTree($arrParent,false);
  $statusValue = [
    'default'  => config('zvn.template.status.default.name'),
    'active'   => config('zvn.template.status.active.name'),
    'inactive' => config('zvn.template.status.inactive.name')
  ];
  $elements = [
    [
      'label' => Form::label('name', 'Name',$formLabelAttr),
      'element' => Form::text('name', $item['name'],$formInputAttr),
      'error' => 'name'
    ],
    [
      'label' => Form::label('price', 'Price',$formLabelAttr),
      'element' => Form::text('price', $item['price'],$formInputAttr),
      'error' => 'price'
    ],
    [
      'label' => Form::label('ordering', 'Ordering',$formLabelAttr),
      'element' => Form::text('ordering', $item['ordering'],$formInputAttr),
      'error' => 'ordering'
    ],

    [
      'label' => Form::label('status', 'Status',$formLabelAttr),
      'element' => Form::select('status', $statusValue, $item['status'],$formInputAttr),
      'error' => 'status'
    ],
    [
      'label' => Form::label('category_id', 'Category',$formLabelAttr),
      'element' => Form::select('category_id', $arrParent, $item['category_id'],$formInputAttr),
      'error' => 'category_id'
    ]

  ];
@endphp
@section('content')
@include('admin.templates.page_header',['pageIndex' => false])


{!! Form::open([
  'method' => 'POST',
  'url' => route("$controllerName/save"),
  'accept-charset' => 'UTF-8',
  'enctype' => 'multipart/form-data',
  'class' => 'form-horizontal form-label-left',
  'id' => 'main-form'
]) !!}
<div class="col-md-6 col-sm-6 col-xs-6">
  <div class="x_panel">
    @include('admin.templates.x_title',['title' => 'Form'])
    <div class="x_content">
      {!! FormTemplate::show($elements,$errors) !!}
    </div>
  </div>
  @include('admin.pages.product.form.dropzone')
  {!! $inputHiddenID.Form::submit('Save',['class' => 'btn btn-success','id'=>'product_submit']); !!}
</div> 
<div class="col-md-6 col-sm-6 col-xs-6">
  @include('admin.pages.product.form.description')
  @include('admin.pages.product.form.attribute')
</div>


{!! Form::close() !!}
@endsection  
