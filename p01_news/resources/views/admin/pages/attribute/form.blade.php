<style>
  #checkbox-dropdown-container {
	background: #99d3de;
	padding: 20px;
}
.custom-select {
    background: #FFF url(downward-arrow.png) no-repeat center right 10px;
    display: inline-block;
    padding: 5px 15px;
    border: #ccc 1px solid;
    color: #3892a2;
    border-radius: 2px;
    width: 200px;
    cursor:pointer;
    
}
div#custom-select-option-box {
    background: #FFF;
    border: #80b2bb 1px solid;
    color: #3892a2;
    border-radius: 2px;
    position:absolute;
    z-index:1;
    display:none;
}
button.search.btn {
   	background: #4c4c4c;
    border: #353535 1px solid;
    color: #ffffff;
    border-radius: 2px;
    padding: 8px 40px;
    margin-top: 20px;
    font-size: 0.9em;
}
.custom-select-option {
    width: 200px;
    padding: 5px 15px;
    margin: 1px 0px;
    cursor:pointer;
}
.custom-select-option:hover {
    
}
.result-list {
    padding-bottom: 20px;
    color: #4d4d4d;
    line-height: 25px;
}
.result-list-heading {
    font-style: italic;
    color: #717171;
    text-decoration: underline;
}
</style>
@extends('admin.main')
@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $inputHiddenID = Form::hidden('id', $item['id']);
  $statusValue = [
    'default'  => config('zvn.template.status.default.name'),
    'active'   => config('zvn.template.status.active.name'),
    'inactive' => config('zvn.template.status.inactive.name')
  ];
  $xhtml = ''; $checked = '';
  foreach ($itemGroupAttr as $key => $value) {
    if($item['attr_group_id']) {
      $checked = in_array($key,$item['attr_group_id']) ? 'checked' : '';
    }
    $xhtml .= '<div class="custom-select-option">
                <input onchange="toggleFillColor(this);"
                  class="custom-select-option-checkbox" type="checkbox"
                  name="groupAttr[]" value="'.$key.'" '.$checked.'> '.$value.'
              </div> ';
  }
  $elements = [
    [
      'label' => Form::label('name', 'Name',$formLabelAttr),
      'element' => Form::text('name', $item['name'],$formInputAttr),
      'error' => 'name'
    ],
    [
      'label' => Form::label('status', 'Status',$formLabelAttr),
      'element' => Form::select('status', $statusValue, $item['status'],$formInputAttr),
      'error' => 'status'
    ],
    [
      'label' => Form::label('groupAttr', 'Group Attribute',$formLabelAttr),
      'element' => '<div class="custom-select" id="custom-select">Select Group Attribute</div>
                    <div id="custom-select-option-box">'.$xhtml.'</div>',
      'error' => 'groupAttr'
    ],
    [
      'type' => 'btn-submit',
      'element' => $inputHiddenID.Form::submit('Save',['class' => 'btn btn-success'])
    ]
  ];
@endphp
@section('content')

@include('admin.templates.page_header',['pageIndex' => false])

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
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
</div>

<script src="{{asset('assmin/js/jquery/dist/jquery.min.js')}}"></script>
<script>
	$("#custom-select").on("click", function() {
		$("#custom-select-option-box").toggle();
	});
	function toggleFillColor(obj) {
		$("#custom-select-option-box").show();
		if ($(obj).prop('checked') == true) {
			$(obj).parent().css("background", '#c6e7ed');
		} else {
			$(obj).parent().css("background", '#FFF');
		}
	}
	$(".custom-select-option").on("click", function(e) {
		var checkboxObj = $(this).children("input");
		if ($(e.target).attr("class") != "custom-select-option-checkbox") {
			if ($(checkboxObj).prop('checked') == true) {
				$(checkboxObj).prop('checked', false)
			} else {
				$(checkboxObj).prop("checked", true);
			}
		}
		toggleFillColor(checkboxObj);
	});

	$("body")
			.on(
					"click",
					function(e) {
						if (e.target.id != "custom-select"
								&& $(e.target).attr("class") != "custom-select-option") {
							$("#custom-select-option-box").hide();
						}
					});
</script>

@endsection