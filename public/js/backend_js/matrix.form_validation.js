
$(document).ready(function(){

	// $("#delCat").click(function(){
	// 	if(confirm('Are you sure you wan to delete this category')){
	// 		return true;
	// 	}
	// 	return false;
	// });

	$(document).ready(function(){
		var maxField = 10;
		var addButton = $('.add_button');
		var wrapper = $('.fields_wrapper');
		var fieldHTML = '<div><input type="text" name"field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field">remove</a></div>';
		var x = 1;
		$(".addButton").click(function(){
			if(x < maxField){
				x++;;
				$(wrapper).append(fieldHTML);
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			$(this).parent('div').remove();
			x--;
		});
	});

	$(".deleteRecord").click(function(){
		var id = $(this).attr('rel');
		var deleteFunction = $(this).attr('rel1');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this record again",
			type:"warning",
			showCancelButton:true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, Cancel!",
			confirmButtonClass: "btn btn-primary",
			cancelButtonClass: "btn btn-danger"
		},

		function() {
			window.location.href = "/admin/"+ deleteFunction+"/"+id;
		});
	});

	


	// $("#delProduct").click(function(){
	// 	if(confirm('Are you sure you wan to delete this Product')){
	// 		return true;
	// 	}
	// 	return false;
	// });

	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				// alert(resp);
				if(resp == "false"){
					$("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
				}
				else if(resp == "true"){
					$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			},
			error: function(){
				// alert("Error");
			},
		})
	});
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	//Add Category validation
	$("#add_category").validate({
		rules:{
			category_name:{
				required: true,
			},
			description:{
				required:true,
			},
			url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//Add Product validation
	// $("#add_product").validate({
	// 	rules:{
	// 		category_id:{
	// 			required: true,
	// 		},
	// 		product_name:{
	// 			required: true,
	// 		},
	// 		product_code:{
	// 			required: true,
	// 		},
	// 		product_color:{
	// 			required: true,
	// 		},
	// 		description:{
	// 			required: true,
	// 		},
	// 		price:{
	// 			required: true,
	// 			number: true,
	// 		},
	// 		discount:{
	// 			required: true,
	// 			number: true,
	// 		},
	// 		image:{
	// 			required: true,
	// 			number: true,
	// 		}
	// 	},
	// 	errorClass: "help-inline",
	// 	errorElement: "span",
	// 	highlight:function(element, errorClass, validClass) {
	// 		$(element).parents('.control-group').addClass('error');
	// 	},
	// 	unhighlight: function(element, errorClass, validClass) {
	// 		$(element).parents('.control-group').removeClass('error');
	// 		$(element).parents('.control-group').addClass('success');
	// 	}
	// });

	//Add Product validation
	$("#edit_product").validate({
		rules:{
			category_id:{
				required: true,
			},
			product_name:{
				required: true,
			},
			product_code:{
				required: true,
			},
			product_color:{
				required: true,
			},
			description:{
				required: true,
			},
			price:{
				required: true,
				number: true,
			},
			discount:{
				required: true,
				number: true,
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//Edit Category validation
	$("#edit_category").validate({
		rules:{
			category_name:{
				required: true,
			},
			description:{
				required:true,
			},
			url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	
	
});
