@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');
  $inputHiddenTask = Form::hidden('key_value','setting-email');
  $elements = [
    [
      'label' => Form::label('email', 'Email',$formLabelAttr),
      'element' => Form::text('email', $itemsEmail['email'],$formInputAttr),
      'error' => 'email'
    ],
    [
      'label' => Form::label('cc', 'CC',$formLabelAttr),
      'element' => Form::text('cc', $itemsEmail['cc'],$formInputAttr),
      'error' => 'cc'
    ],
    [
      'label' => Form::label('title', 'Title',$formLabelAttr),
      'element' => Form::text('title', $itemsEmail['title'],$formInputAttr),
      'error' => 'title'
    ],
    [
      'label' => Form::label('content', 'Content',$formLabelAttr),
      'element' => Form::textArea('content', $itemsEmail['content'],$formCkeditorAttr),
      'error' => 'content'
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