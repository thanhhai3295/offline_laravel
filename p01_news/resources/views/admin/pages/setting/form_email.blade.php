@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');
  $inputHiddenTask = Form::hidden('task','save-email');
  $elements = [
    [
      'label' => Form::label('email', 'Email',$formLabelAttr),
      'element' => Form::text('email', '',$formInputAttr),
      'error' => 'email'
    ],
    [
      'type' => 'btn-submit',
      'element' => $inputHiddenTask.Form::submit('Save',['class' => 'btn btn-success'])
    ]
  ];
@endphp
<div class="tab-pane" id="setting_email">
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