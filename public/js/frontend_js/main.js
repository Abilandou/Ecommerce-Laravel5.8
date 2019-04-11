/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

//Change price with product size and quantity.
$(document).ready(function(){
	$("#selectSize").change(function(){
		var idSize = $(this).val();
		if(idSize == ""){
			return false;
		}
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idSize:idSize},
			success:function(resp){
				// alert(resp); return false;
				var arr = resp.split('#'); 
				//get product quantity
				var proQuant = $("#proQuantity").val();
				
				//Multiply productquantity with price from selected size
				var total = proQuant * arr[0];
				
			  $("#getPrice").html("$"+total);
			  //get the total price to pass to cart
			  $("#price").val(total);
			 
			  if(arr[1] == 0){
				  $("#cartButton").hide();
				  $("#Availability").text("Out of Stock");
			  }
			  else{
				$("#cartButton").show();
				$("#Availability").text("In Stock"); 
			  }
			},
			error: function(){
				if(idSize == ""){
					return false;
				}
			}
		});
	});
	
});

//Replace Products Main image with alternate image when alternate image is clicked

$(document).ready(function(){
	$(".changeImage").click(function(){
		var image = $(this).attr('src');
		$(".mainImage").attr("src", image);
	});
});


//Controls product Zoom.
$(document).ready(function(){
	// Instantiate EasyZoom instances
	var $easyzoom = $('.easyzoom').easyZoom();

	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);

		e.preventDefault();

		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});

	// Setup toggles example
	var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

	$('.toggle').on('click', function() {
		var $this = $(this);

		if ($this.data("active") === true) {
			$this.text("Switch on").data("active", false);
			api2.teardown();
		} else {
			$this.text("Switch off").data("active", true);
			api2._init();
		}
	});

});

//Toggle between login and signup forms in divs
$(document).ready(function(){
	$("#signupdiv").hide();
	
	$("#signupInfo").click(function(){
		$("#signupdiv").show();
		$("#logindiv").hide();
	});
	$("#loginInfo").click(function(){
		
		$("#logindiv").show();
		$("#signupdiv").hide();
	});
});

//Input validations

$(document).ready(function(){
	//Validate register form on keyup and submit.
	$("#registerForm").validate({
		rules: {
			name:{
				required:true,
				minlength:4,
				accept: "[a-zA-Z]+"
			},
			password: {
				required: true,
				minlength: 6,

			},
			 email: {
				 required: true,
				 email: true,
				 remote: "check-email"
			 }
		},
		messages: {
			name:{
				required: "Please enter your Name",
				minlength: "name should be atleast 4 characters long",
				accept:"Only letters are allowed for names"
			},	
			password: {
				required: "Please provide your password",
				minlength: "Your Password must be atleast 6 characters long"
			},
			email: {
				required: "Please enter your Email",
				email: "Please enter a valid email",
				remote: "Email already exists try another"
			}
		}
	});

	//Validate Login form on keyup and submit.
	$("#loginFormD").validate({
		rules: {
			email: {
				required: true,
				email: true,
			},
			password: {
				required: true,
			}
			 
		},
		messages: {
			email: {
				required: "Please enter your Email",
				email: "Please enter a valid email",
			},
			password: {
				required: "Please provide your password",
				minlength: "Your Password must be atleast 6 characters long"
			}
		}
	});

	//PassWord Strength validation
	$(document).ready(function($) {
        $('#myPasswordRegister').passtrength({
          passwordToggle: true,
		  tooltip: true,
		  eyeImg: "/images/frontend_images/eye.svg",
        });
	  });
	  
	$(document).ready(function($) {
	$('#myPasswordLogin').passtrength({
		passwordToggle: true,
		tooltip: true,
		eyeImg: "/images/frontend_images/eye.svg",
	});
	});

	//Validate update account form
	$("#accountForm").validate({
		rules: {
			name:{
				required:true,
				minlength:4,
				accept: "[a-zA-Z]+"
			},
			last_name:{
				required:true,
				minlength:4,
				accept: "[a-zA-Z]+"
			},
			address:{
				required:true,
				minlength:2,
			},
			city:{
				required:true,
				minlength:2,
			},
			state:{
				required:true,
				minlength:2,
			},
			country:{
				required:true,
			},
			pincode:{
				required:true,
				minlength:2,
			},
			mobile:{
				required:true,
				minlength:7,
			},
			
		},
		messages: {
			name:{
				required: "Please enter your Name",
				minlength: "Name should be atleast 4 characters long",
				accept:"Only letters are allowed for names"
			},
			laast_name:{
				required: "Please enter your Last Name",
				minlength: "Last Name should be atleast 4 characters long",
				accept:"Only letters are allowed for names"
			},		
			address:{
				required: "Please enter your Addres",
				minlength: "Addres should be atleast 2 characters long",
				
			},
			city:{
				required: "Please enter your City",
				minlength: "City should be atleast 4 characters long",
				
			},
			state:{
				required: "Please enter your State",
				minlength: "State should be atleast 2 characters long",
				
			},
			country:{
				required: "Please enter your Country",
			},
			pincode:{
				required: "Please enter your Pincode",
				minlength: "Pincode should be atleast 2 characters long",
				
			},
			mobile:{
				required: "Please enter your Mobile",
				minlength: "Your Mobile Number should be atleast 7 characters long",
				
			},						
		}
	});

	//Validate update user password form
	$("#updateUserPasswordForm").validate({
		rules: {
			current_password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_password:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_password"
			}
		},
		messages: {
			current_password:{
				required: "Please enter your current Password",
				minlength: "Password should be atleast 6 characters long",
			},	
			new_password:{
				required: "Please enter your New Password",
				minlength: "New Password should be atleast 6 characters long",
			},	
			confirm_password:{
				required: "Please Confirm your New Password",
				minlength: "New Password should be atleast 6 characters long",
			},	
		}
	});

	//PassWord Strength validation
	$(document).ready(function($) {
        $('#current_password').passtrength({
          passwordToggle: true,
		  tooltip: true,
		  eyeImg: "/images/frontend_images/eye.svg",
		});

		$('#new_password').passtrength({
			passwordToggle: true,
			tooltip: true,
			eyeImg: "/images/frontend_images/eye.svg",
		  });
	  });

	  $(document).ready(function($) {
		  $('#confirm_password').passtrength({
			passwordToggle: true,
			tooltip: true,
			eyeImg: "/images/frontend_images/eye.svg",
		  });
		
	  });

	$("#current_password").keyup(function(){
		var current_password = $(this).val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type:'get',
			url:'/check_user_password',
			data:{current_password:current_password},
			success:function(resp){
				// alert(resp);
				if(resp=="false"){
					$("#checkPwd").html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#checkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			},
			error: function(){
				return;
			}
		});
   });

   //Copy Billing Address to Shipping Address Script

   $("#sameAddress").on('click', function(){
		if(this.checked){
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_last_name").val($("#billing_last_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());
		}else{
			$("#shipping_name").val('');
			$("#shipping_last_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_country").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');
		}
   });
});

//select a payment method.
$(document).ready(function(){
	$("#paymentSelectSubmit").click(function(){
		
		if($("#Paypal").is(':checked') || $("#COD").is(':checked')){
			return true;
		}else{
			$("#errorPayment").html("<font color='red'>Please select a payment method.</font>");
			// return exitHere;
			return false;
		}
	});

});

$(document).ready(function() {
    $('#userOrderstable').DataTable();
} );


