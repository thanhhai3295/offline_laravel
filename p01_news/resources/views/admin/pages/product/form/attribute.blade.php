@php
  $itemsGroupAttribute = ['default' => 'Select Attribute'] + $itemsGroupAttribute;
  $groupID = $item['group_attribute_id']??'';
@endphp
<div class="x_panel">
  @include('admin.templates.x_title',['title' => 'Attribute'])
  <div class="x_content">
    <div class="form-group">
      <div class="row">
        <div class="col-md-11">
          {!!Form::select('group_attribute_id', $itemsGroupAttribute, $groupID,$formInputAttr)!!}
        </div>
        <div class="col-md-1" style="text-align: center">
          <a href="javascript:void(0)" class="btn btn-success" id="add-more-attr"><i class="fa fa-plus"></i></a>
        </div>
      </div>
    </div>
    <div id="attribute-content">
      @php
          if(isset($item['id'])) {
            $attr = json_decode($item['attribute'],true);
            $xhtml = '';
            if(!empty($attr)) {
              foreach ($attr as $key => $value) {
              $xhtml .= '<div class="form-group"> <div class="row">
                          <div class="col-md-3"> <input value="'.$value['name'].'" class="form-control" type="text" name="attr[name][]"></div>
                          <div class="col-md-9">
                              <input class="form-control tags" type="text" name="attr[value][]" data-tagsinput-init="true" id="tags16046688932890" style="display: none;">
                              <div id="tags16046688932890_tagsinput" class="tagsinput" style="width: auto; min-height: 100px; height: 100px;">';
              foreach ($value['value'] as $key => $value) {
                $xhtml .= '<span class="tag"><span>'.$value.'&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span>';
              }
              $xhtml .= '<div id="tags16046688932890_addTag"><input id="tags16046688932890_tag" value="" data-default="add a tag" style="color: rgb(102, 102, 102); width: 68px;"></div>
                                <div class="tags_clear"></div>
                              </div>
                          </div>
                        </div></div>';
              }
            }
            echo $xhtml;
          }
      @endphp
    </div>
  </div>
</div>

<script src="{{asset('assmin/js/jquery/dist/jquery.min.js')}}"></script>

<script>
  $('select[name=group_attribute_id]').change(function() {
    var id = $(this).val();
    if(id != 'default') {
      $.ajax({
        type: 'POST', 
        url: "{{route($controllerName.'/addFormAttr')}}",
        data: {id: id},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          $('#attribute-content').html(data);
          $('.tags').tagsInput({width:'auto'});
        }
      });
    }
  });
  $('#add-more-attr').click(function() {
    var html = '<div class="form-group"><div class="row"> <div class="col-md-3"> <input class="form-control" type="text" name="attr[name][]" ></div><div class="col-md-9"><input class="form-control tags" type="text" name="attr[value][]" ></div></div></div>';
    $('#attribute-content').append(html);
    $('.tags').tagsInput({width:'auto'});
  });
</script>
