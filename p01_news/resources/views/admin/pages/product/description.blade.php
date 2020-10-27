<div class="col-md-6 col-sm-6 col-xs-6">
  <div class="x_panel">
    @include('admin.templates.x_title',['title' => 'Description'])
    <div class="form-group">
      {!! Form::textArea('description', $item['description'],$formCkeditorAttr) !!}
    </div>
  </div>
</div>
