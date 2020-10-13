@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');

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
<div class="tab-pane" id="setting_social">
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
  </div>
</div>