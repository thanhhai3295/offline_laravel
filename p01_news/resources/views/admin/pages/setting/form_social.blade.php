@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');
  $inputHiddenTask = Form::hidden('setting_social','value');
  $inputHiddenKey = Form::hidden('key_value','setting-social');
  $elements = [
    [
      'label' => Form::label('facebook', 'Facebook',$formLabelAttr),
      'element' => Form::text('facebook', $itemsSocial['facebook'],$formInputAttr),
      'error' => 'facebook'
    ],
    [
      'label' => Form::label('youtube', 'Youtube',$formLabelAttr),
      'element' => Form::text('youtube', $itemsSocial['youtube'],$formInputAttr),
      'error' => 'youtube'
    ],
    [
      'label' => Form::label('twitter', 'Twitter',$formLabelAttr),
      'element' => Form::text('twitter', $itemsSocial['twitter'],$formInputAttr),
      'error' => 'twitter'
    ],
    [
      'type' => 'btn-submit',
      'element' => $inputHiddenKey.$inputHiddenTask.Form::submit('Save',['class' => 'btn btn-success'])
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