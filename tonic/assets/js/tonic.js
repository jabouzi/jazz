$(document).ready(function() {
	 
	$(".tablesorter").tablesorter();
	
	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		$('#active_lang').val($(this).attr('id'));
		return false;
	});

	$('.column').equalHeight();

	$('.submit_form').bind({
		click: function() {
			clear_messages();
			validate_from($(this).closest('form').attr('id'));
		}
	});
	
	$('#save_user_password').bind({
		click: function() {
			clear_messages();
			validate_password($(this).closest('form').attr('id'));
		}
	});
	
	$('#add_language').bind({
		click: function() {
			clear_messages();
			add_language();
		}
	});
	
	$('#add_workflow').bind({
		click: function() {
			clear_messages();
			add_workflow();
		}
	});
	
	$('#add_permission').bind({
		click: function() {
			clear_messages();
			add_permission();
		}
	});
	
	var build = function(select, tr) {
		select.multiselect();
		
		if (select.length === 0) {
			return 'Select not present anymore.';
		}
		
		if (select.css('display') !== 'none') {
			return 'Select still visible (expected <code>display: none;</code>).';
		}
		
		if ($('button.multiselect', tr).length === 0) {
			return 'Multiselect button not present.';
		}
		
		if ($('option', select).length !== 5) {
			return 'Not all options present anymore.';
		}
		
		if ($('ul.multiselect-container', tr).length === 0) {
			return 'Unordered list <code>.multiselect-container</code> not present.';
		}
		
		if ($('ul.multiselect-container li', tr).length !== 5) {
			return 'No list item for each option present.';
		}
		
		if ($('ul.multiselect-container li a', tr).length !== 5) {
			return 'Not all list items come with an anchor inside.';
		}
		
		return false;
	}($('.permissions-multi-select'));
});

function add_language()
{
	$('#language_number').val(parseInt($('#language_number').val()) + 1);
	$('#language_list').append('<tr><td>'+$('#new_language').html()+'</td></tr>');
}

function add_workflow()
{
	$('#workflow_number').val(parseInt($('#workflow_number').val()) + 1);
	$('#workflow_list').append('<tr><td>'+$('#new_workflow').html()+'</td></tr>');
}

function add_permission()
{
	$('#permission_number').val(parseInt($('#permission_number').val()) + 1);
	$('#permission_list').append('<tr><td>'+$('#new_permission').html()+'</td></tr>');
}

function validate_from(form_id)
{
	var required = 0;
	$('.alert_error').html('');
	$("#" + form_id).find('[data-validate]').each(function() {
		required += validate_element($(this));
	});
	
	if (required)
	{
		$('.alert_error').html($('#error_message').val());
		$('.alert_error').show();  
		blinkit('alert_error');
	}
	else
	{
		if ($('#user_email').length > 0)
		{
			if ($('#user_id').length == 0) var user_id = 0;
			else var user_id = $('#user_id').val();
			$.post( $('#email_exists_url').val()+'/'+encodeURIComponent($('#user_email').val())+'/'+user_id, function( response ) {
				if (response == '0') $("#" + form_id).submit();
				else
				{
					$('.alert_warning').html(response);
					$('.alert_warning').show();  
					blinkit('alert_warning');
				}
			});
		}
		else
		{
			$("#" + form_id).submit();
		}
		
	}
}

function validate_element(element)
{
	var required = 0;
	$('#error_message').val($('#admin_error').val());
	if (element.attr('data-type') == 'email')
	{
		if (!isValidEmailAddress(element)) {  $(this).addClass('error-input'); required++; message = append_message(element); }
		else if ($("#" + element.attr('id') + '_confirmation').length > 0 && $("#" + element.attr('id') + '_confirmation').val() != element.val()) 
		{ $(this).addClass('error-input'); required++; append_message(element); }
	}		
	else if (element.attr('data-type') == 'date')
	{
		if (!isValideDate(element)) {  $(this).addClass('error-input'); required++; append_message(element); }
	}
	else if (element.attr('data-type') == 'postalcode')
	{
		if (!isValidPostalCode(element)) {  $(this).addClass('error-input'); required++; append_message(element); }
	}
	else if (element.attr('data-type') == 'checkbox')
	{
		if (!element.is(':checked')) {  $(this).addClass('error-input'); required++; append_message(element); }
	}
	else if (element.attr('data-type') == 'option')
	{
		if (element.val() == '') {  $(this).addClass('error-input'); required++; append_message(element); }
	}
	else if (element.attr('data-type') == 'phone')
	{
		if (!isValidPhone(element)) {  $(this).addClass('error-input'); required++; append_message(element); }
	}
	else if (element.attr('data-validate') == 'required') 
	{
		if (element.val() == '')
		{
			if (element.is(":visible"))
			{
				{ $(this).addClass('error-input'); required++; append_message(element); }
			}
		}
	}
	
	return required;
}

function validate_password(form_id)
{
	var required = 0;
	$('#error_message').val($('#admin_error').val());
	$("#" + form_id).find('[data-validate]').each(function() {
		required += validate_element($(this));
	});
	
	if (required)
	{
		$('.alert_error').html($('#error_message').val());
		$('.alert_error').show();  
		blinkit('alert_error');
	}
	else
	{
		$.post( $('#good_password_url').val()+'/'+$('#user_oldpassword').val()+'/'+$('#user_id').val(), function( response ) {
			if (response == '1')
			{
				if ($('#user_newpassword').val() == '') 
				{
					append_message($('#user_newpassword'))
					$('.alert_error').html($('#error_message').val());
					$('.alert_error').show();  
					blinkit('alert_error');
				}
				else if ($('#user_confirm_newpassword').val() == '') 
				{
					append_message($('#user_newpassword'))
					$('.alert_error').html($('#error_message').val());
					$('.alert_error').show();  
					blinkit('alert_error');
				}
				else if ($('#user_newpassword').val() != $('#user_confirm_newpassword').val())
				{
					append_message($('#user_newpassword'))
					$('.alert_error').html($('#error_message').val());
					$('.alert_error').show();  
					blinkit('alert_error');
				}
				else if ($('#user_newpassword').val() == $('#user_confirm_newpassword').val())	$("#" + form_id).submit();
			}
			else
			{
				$('.alert_warning').html(response);
				$('.alert_warning').show();  
				blinkit('alert_warning');
			}
		});
	}
}

function isValidEmailAddress(element) 
{
	var isValid = false;
	var emailAddress = element.val();
	if (element.attr('data-validate') == 'validate' && emailAddress == '') isValid = true;
	else { var regex = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		isValid = regex.test(emailAddress.toLowerCase()) ? true : false; }
	return isValid;
}

function isValidPhone(element)
{
	var isValid = false;
	var phoneNumber = element.val();
	if (element.attr('data-validate') == 'validate' && phoneNumber  == '') isValid = true;
	else { var regex = new RegExp(/^\+?1?( |-)?\(?(\d{3})\)?( |-)?(\d{3})( |-)?(\d{4})$/i);
		isValid = regex.test(phoneNumber.toLowerCase()) ? true : false;}
	return isValid;
}

function isValidPostalCode(element)
{
	var isValid = false;
	var postalCode = element.val();
	if (element.attr('data-validate') == 'validate' && postalCode == '') isValid = true;
	else {var regex = new RegExp(/^[abceghjklmnprstvxy]{1}\d{1}[a-z]{1}\d{1}[a-z]{1}\d{1}$/i);
		isValid = regex.test(postalCode.toLowerCase()) ? true : false;}
	return isValid;
}

function isValidCardNumber(element)
{
	var creditNumber = $(element).val();
	var regex =  new RegExp(/^(5[1-5]\d{14})|(4[0-9]{12}(?:[0-9]{3})?)$/);
	var isValid = regex.test(creditNumber) ? true : false;
	return isValid;
}

function isValidExpirationDate(element)
{
	var isValid = false;
	var expMonth = element.val().substring(0,2);
	var expYear = element.val().substring(2,4);
	if (expMonth == '' || expYear == '' ) { isValid = false; }
	else { var expDate = new Date('20' + expYear, expMonth); var date = new Date(); isValid = (expDate > date) ? true : false; }
	return isValid;
}

function isValidNumber(element)
{
	var number = element.val();
	return !isNaN(parseFloat(number)) && isFinite(number);
}

function blinkit(classname)
{
	var speed = 200;
	effectFadeIn(classname, speed);
	effectFadeOut(classname, speed);
}

function effectFadeIn(classname, speed) {
	$("." + classname).fadeOut(speed);
}

function effectFadeOut(classname, speed) {
	$("." + classname).fadeIn(speed);
}

function append_message(element)
{
	$('#error_message').val(element.attr('title') + ', ' + $('#error_message').val());
}

function clear_messages()
{
	$('#error_message').val('');
	$('.alert_warning').html('');
	$('.alert_error').html('');
	$('.alert_success').html('');
	$('.alert_info').html('');
	$('.alert_warning').hide();
	$('.alert_error').hide();
	$('.alert_success').hide();
	$('.alert_info').hide();
}
