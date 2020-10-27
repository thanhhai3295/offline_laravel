<div class="col-md-6 col-sm-6 col-xs-6">
  <div class="x_panel">
    @include('admin.templates.x_title',['title' => 'Attribute'])
    <div class="x_content">
      
      <div class="form-group">
        <label for="color">Color</label>
        <p></p>
        <ul id="allowSpacesTags"></ul>
      </div>

      <div class="form-group">
        <label for="Slogan">Slogan</label>
        {!! Form::text('slogan',$item['slogan'],['class' => 'form-control']);  !!}
      </div>

    </div>
  </div>
</div> 

