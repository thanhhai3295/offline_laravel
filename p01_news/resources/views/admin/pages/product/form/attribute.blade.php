@php
  $itemsGroupAttribute = ['default' => 'Select Attribute'] + $itemsGroupAttribute;
@endphp
<div class="x_panel">
  @include('admin.templates.x_title',['title' => 'Attribute'])
  <div class="x_content">
    <div class="form-group">
      <div class="row">
        <div class="col-md-11">
          {!!Form::select('groupAttribute', $itemsGroupAttribute, null,$formInputAttr)!!}
        </div>
        <div class="col-md-1" style="text-align: center">
          <a href="javascript:void(0)" class="btn btn-success" id="add-more-attr"><i class="fa fa-plus"></i></a>
        </div>
      </div>
    </div>
    <div id="attribute-content">

    </div>
  </div>
</div>

<script src="{{asset('assmin/js/jquery/dist/jquery.min.js')}}"></script>

<script>
  $('select[name=groupAttribute]').change(function() {
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
