  <div class="x_panel">
    @include('admin.templates.x_title',['title' => 'Upload'])
    <div class="x_content">
      <div class="dropzone digits dz-clickable" id="singleFileUpload" data-url="{{route($controllerName.'/upload')}}">
        <div class="dz-message needsclick"><i class="fa fa-download"></i>
            <h4 class="mb-0 f-w-600">Drop files here or click to upload.</h4>
        </div>
      </div>
    </div>
  </div>


