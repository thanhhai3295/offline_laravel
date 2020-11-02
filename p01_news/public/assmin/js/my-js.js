function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
function changeStatus(e) {
	let url = e.getAttribute('data-url');
	let status = e.getAttribute('data-status');
	$.get(url, function(data){ 
		data = JSON.parse(data);
		if(data['success']) {
			$(e).attr('class','btn btn-round '+data['class']);
			$(e).text(data['name']);
			$(e).attr('data-url',url.replace(status,data['status']));
			$(e).attr('data-status',data['status']);
			notify('Status Update!');
		}
	});
}
$(document).ready(function() {
	let $btnSearch        = $("button#btn-search");
	let $btnClearSearch	  = $("button#btn-clear");

	let $inputSearchField = $("input[name  = search_field]");
	let $inputSearchValue = $("input[name  = search_value]");
	let $categoryFilter   = $("select[name = cat_filter]");
	let $selectFilter     = $("select[name = select_filter]");

	let $selectChangeAttr = $("select[name =  select_change_attr]");
	let $selectChangeAttrAjax = $("select[name =  select_change_attr_ajax]");


	$("a.select-field").click(function(e) {
		e.preventDefault();

		let field 		= $(this).data('field');
		let fieldName 	= $(this).html();
		$("button.btn-active-field").html(fieldName + ' <span class="caret"></span>');
    $inputSearchField.val(field);
	});

	$btnSearch.click(function() {

		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);
		params 			= ['page', 'filter_status', 'select_field', 'select_value','filter_category'];

		let link		= "";
		$.each( params, function( key, value ) {
			if (searchParams.has(value) ) {
				link += value + "=" + searchParams.get(value) + "&";
			}
		});

		let search_field = $inputSearchField.val();
		let search_value = $inputSearchValue.val();

		window.location.href = pathname + "?" + link + 'search_field='+ search_field + '&search_value=' + search_value.replace(/\s+/g, '+').toLowerCase();
	});

	$btnClearSearch.click(function() {
		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);

		params 			= ['page', 'filter_status', 'select_filter'];

		let link		= "";
		$.each( params, function( key, value ) {
			if (searchParams.has(value) ) {
				link += value + "=" + searchParams.get(value) + "&"
			}
		});

		window.location.href = pathname + "?" + link.slice(0,-1);
	});

	//Event onchange select filter
	$selectFilter.on('change', function () {
		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);

		params 			= ['page', 'filter_status', 'search_field', 'search_value'];

		let link		= "";
		$.each( params, function( key, value ) {
			if (searchParams.has(value) ) {
				link += value + "=" + searchParams.get(value) + "&";
			}
		});

		let filter = $(this).data('filter');
		let value = $(this).val();
		window.location.href = pathname + "?" + link + 'filter_'+ filter + '=' + value;
 	});

	// Change attributes with selectbox
	// $selectChangeAttr.on('change', function() {
	// 	let item_id = $(this).data('id');
	// 	let url = $(this).data('url');
	// 	let csrf_token = $("input[name=csrf-token]").val();
	// 	let select_field = $(this).data('field');
	// 	let select_value = $(this).val();
	//
	// 	$.ajax({
	// 		url : url,
	// 		type : "post",
	// 		dataType: "html",
	// 		headers: {'X-CSRF-TOKEN': csrf_token},
	// 		data : {
	// 			id : item_id,
	// 			field: select_field,
	// 			value: select_value
	// 		},
	// 		success : function (result){
	// 			if(result == 1)
	// 				alert('Bạn đã cập nhật giá trị thành công!');
	// 			else
	// 				console.log(result)
	//
	// 		}
	// 	});
	// });
	$("#thumb").change(function() {
		readURL(this);
	});
	$("#avatar").change(function() {
		readURL(this);
	});
	$selectChangeAttr.on('change', function() {
		let select_value = $(this).val();
		let $url = $(this).data('url');
		window.location.href = $url.replace('value_new', select_value);
	});

	$selectChangeAttrAjax.on('change', function() {
		let select_value = $(this).val();
		let $url = $(this).data('url');
		let csrf_token = $("input[name=csrf-token]").val();
		$.ajax({
			url : $url.replace('value_new', select_value),
			type : "GET",
			dataType: "json",
			headers: {'X-CSRF-TOKEN': csrf_token},
			success : function (result){
				if(result) {
					notify('Type Updated!');
				}else {
					console.log(result);
				}
			}
		});

	});
	$categoryFilter.on('change', function(e) {
		var id = $(this).val();
		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);
		params 			= ['page', 'filter_status', 'search_field', 'search_value'];
		let link		= "";
		$.each( params, function( key, value ) {
			if (searchParams.has(value) ) {
				link += value + "=" + searchParams.get(value) + "&";
			}
		});
		window.location.href = pathname + "?" + link +'filter_category='+id;
	});
	//Confirm button delete item
	$('.btn-delete').on('click', function() {
		if(!confirm('Bạn có chắc muốn xóa phần tử?'))
			return false;
	});
	$('input[name=ordering]').on('blur',function() {
		var new_value = $(this).val();
		var old_value = $(this).attr('value');
		var url       = $(this).data('url');
		var id 				= $(this).data('id');
		if(isNaN(new_value)) {
			warning('Please Insert Number');
		}
		if(old_value != new_value) {
			$.ajax({
				type: "GET",
				url: url.replace('value',new_value),
				dataType: "json",
				success: function(result) {
					if(result) notify('Ordering Updated!');
				}
			});
		} 
	});


	var setting = localStorage.getItem('setting');
	if(!setting) {
		$('#setting_main').addClass('active');
		$('[data = setting_main]').addClass('active');
	} else {
		$('#'+setting).addClass('active');
		$('[data = '+setting+']').addClass('active');
	}
	
	$('ul.nav.nav-tabs li').each(function(key, value) {
		$(value).click(function(e) {
			var setting = $(e.target).attr('href').replace('#','');
			localStorage.setItem('setting',setting);
		});
	});

	//Init datepicker
	// $('.datepicker').datepicker({
	// 	format: 'dd-mm-yyyy',
	// });

	//TAG-IT
	$('#allowSpacesTags').tagit({
		availableTags: 'php',
		allowSpaces: true,
		fieldName: "tags[]"
	});
	//DROPZONE
	
	Dropzone.options.singleFileUpload = {
		acceptedFiles: ".jpeg,.jpg,.png,.gif",
		autoProcessQueue: true,
		paramName: "file",
		url: $('#singleFileUpload').data('url'),
    init: function() {
      var myDropzone = this;
      myDropzone.on("addedfile", function(file) { 
        file.previewElement.addEventListener("click", function() {
					myDropzone.removeFile(file);
					var id = file.name.replace('.','-');
          document.getElementById(id).remove();
        });
			});
			$("#main-form").submit(function (e) {
				myDropzone.processQueue();
			}); 
		},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
    success: function(file,response) {
			var id = file.name.replace('.','-');
			var input = '<input type="hidden" name="thumb[]" value='+response.name+' id='+id+'>';
			$('#main-form').append(input);
    },
	};
	
});