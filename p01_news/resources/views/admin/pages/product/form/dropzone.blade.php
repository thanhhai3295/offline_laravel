  <div class="x_panel">
    @include('admin.templates.x_title',['title' => 'Upload'])
    <div class="x_content">
      <div class="dropzone digits dz-clickable" id="singleFileUpload" data-url="{{route($controllerName.'/upload')}}">
        <div class="dz-message needsclick"><i class="fa fa-download"></i>
            <h4 class="mb-0 f-w-600">Drop files here or click to upload.</h4>
        </div>
      </div>
      <br>
      <div id="uploaded-image">
        @php
            use App\Helpers\Template as Template; 
            if((isset($item['id']))) {
              $thumb = json_decode($item['thumb'],true);
              $xhtml = '';
              foreach ($thumb as $key => $value) {
                $id = trim(str_replace('.','-',$value['name']));
                $input = '<input type="hidden" name="thumb[]" value="'.$value['name'].'">';
                $alt = '<input type="text" placeholder="Alt Picture" name="alt[]" class="form-control" value="'.$value['alt'].'">';
                $close = '<a href="javascript:void(0)" class="close-btn"><i class="fa fa-times"></i></a>';
                $image = Template::showItemThumb($controllerName,$value['name'],$value['alt']);
                $xhtml .= '<div class="col-md-3 cursor-pointer id="'.$id.'">'.$input.$image.$alt.$close.'</div>';
              }
              echo $xhtml;
            }
        @endphp

      </div>
    </div>
  </div>

  @if (isset($item['id']))
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $('#uploaded-image').sortable();
    $('#uploaded-image').disableSelection();
    $('.close-btn').click(function(e) {
     $(this).parent().remove();
    });
    </script>
  @endif
  


