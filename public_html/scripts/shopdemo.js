/*slide show*/
	$(function(){
		$("#slideShow").slides({
				preload: true,
				play: 5000,
				pause: 2000,
				effect: 'slide, fade',
				crossfade: false,
				slideSpeed: 900,
				fadeSpeed: 1000,
				hoverPause: true,
				generatePagination: false
		});
		
		$("#slideShowDetail").slides({
				preload: true,
				play: 5000,
				pause: 2000,
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				hoverPause: true,
				generatePagination: false
		});
	});

	
	$(document).ready(function(){
	
	/*sign up form slides down*/
	$('#clickme').click(function(){
		$('#signUp').slideToggle('slow');
		
		});
	/*login form validation*/
	/*$('#loginform').validate({
		'rules':{
			 'email':{
				'required':true,
				'email':true
				},
		'password':{
				 'required':true,
				 'minlength':5
				 },
		 
			}
		});*/
	/*signup form validation*/
	$('#signup').validate({
		'rules':{
			'email':{
				'required':true,
				'email':true
				},
				
			 'fname':'required',
			 'lname':'required',
			 'password1':{
				 'required':true,
				 'minlength':5
				 },
		     'password2':{
				 'required':true,
				 'minlength':5
				 }
			},
		'messages':{
			'email':'Please input valid email address',
			 'fname':'Please input your first name',
			'lname':'Please input your last name',
			'password1':'Please input valid password, at least 5 characters',
			'password2':'Please input valid password, at least 5 characters'
			}
		});
	/*address form validation*/
	
	$('#addressform').validate({
		'rules':{
			'street':'required',
			'suburb':'required',
			'state':'required',
			'code':{
				'required':true,
				'digits':true
				}
			},
		'messages':{
			'street':'Please input valid street number and name',
			'suburb':'Please input valid suburb name',
			'state':'Please input valid state name',
			'code':'Please input valid post code',
			}
		
		});
	});
	



function requireLogin(){
    alert("To Use this demo, please sign up or press login button on the top.Email and password have been provided.");
    
}
