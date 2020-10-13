@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $formCkeditorAttr = config('zvn.template.form_ckeditor');
  $inputHiddenTask = Form::hidden('key_value','setting-main');
  $inputHiddenThumb = Form::hidden('thumb_current', $itemsMain['thumb']);
  $elements = [
    [
      'label' => Form::label('thumb', 'Thumb',$formLabelAttr),
      'element' => Form::file('thumb',$formInputAttr),
      'thumb' => Template::showItemThumb($controllerName,$itemsMain['thumb'],'logo'),
      'type' => 'thumb',
      'error' => 'thumb'
    ],
    [
      'label' => Form::label('hotline', 'Hotline',$formLabelAttr),
      'element' => Form::text('hotline', $itemsMain['hotline'],$formInputAttr),
      'error' => 'hotline'
    ],
    [
      'label' => Form::label('copyright', 'Copyright',$formLabelAttr),
      'element' => Form::text('copyright', $itemsMain['copyright'],$formInputAttr),
      'error' => 'copyright'
    ],
    [
      'label' => Form::label('time_work', 'Thời Gian Làm Việc',$formLabelAttr),
      'element' => Form::text('time_work', $itemsMain['time_work'],$formInputAttr),
      'error' => 'time_work'
    ],
    [
      'label' => Form::label('address', 'Địa Chỉ',$formLabelAttr),
      'element' => Form::text('address', $itemsMain['address'],$formInputAttr),
      'error' => 'address'
    ],
    [
      'label' => Form::label('intro', 'Giới Thiệu',$formLabelAttr),
      'element' => Form::textArea('intro',$itemsMain['intro'],$formCkeditorAttr),
      'error' => 'intro'
    ],
    [
      'type' => 'btn-submit',
      'element' => $inputHiddenTask.$inputHiddenThumb.Form::submit('Save',['class' => 'btn btn-success'])
    ]
  ];
@endphp
<div class="tab-pane" id="setting_main">
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