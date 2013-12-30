$(document).ready(function() {
	$('#save_workflow').bind({
		click: function() {
			validate_from('workflows_form');
		}
	});
});

function validate_from(form_id)
{
    var required = 0;
    $('.error_elem_msg').remove();
    $("#" + form_id).find('[data-validate]').each(function() {
        required += validate_element($(this));
    });
    if (required)
    {
		$('.alert_error').html('cjeck erros');
        $('.alert_error').show();  
        blinkit('alert_error');
    }
    else
    {
        $("#" + form_id).submit();
    }
}

function validate_element(element)
{
    var required = 0;
    if (element.attr('data-type') == 'email')
    {
        if (!isValidEmailAddress(element)) {  add_after(element); required++; }
        else if ($("#" + element.attr('id') + '_confirmation').length > 0 && $("#" + element.attr('id') + '_confirmation').val() != element.val()) 
        { add_after(element); required++; }
    }        
    else if (element.attr('data-type') == 'date')
    {
        if (!isValideDate(element)) {  add_after(element); required++; }
    }
    else if (element.attr('data-type') == 'postalcode')
    {
        if (!isValidPostalCode(element)) {  add_after(element); required++; }
    }
    else if (element.attr('data-type') == 'checkbox')
    {
        if (!element.is(':checked')) {  add_after(element); required++; }
    }
    else if (element.attr('data-type') == 'option')
    {
        if (element.val() == '') {  add_after(element); required++; }
    }
    else if (element.attr('data-type') == 'phone')
    {
        if (!isValidPhone(element)) {  add_after(element); required++; }
    }
    else if (element.attr('data-validate') == 'required') 
    {
        if (element.val() == '')
        {
            if (element.is(":visible"))
            {
                { add_after(element); required++; }
            }
        }
    }
    
    return required;
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

function generate_rid()
{
    var d = new Date();
    var n = d.getTime();
    var rid = Math.floor((Math.random() * n) + 1);
    return rid;
}

function add_after(elem)
{
    var text = $('#required').val();
    if ($(elem).val() == '') text = $('#required').val();
    if (elem.attr('data-validate') == 'validate') text = $('#invalid').val();
    if (elem.attr('data-pos') == '2') elem.parent().siblings("label").append('<span class="error_msg error_elem_msg"> (REQUIS) </span>');
    else 
		 elem.prev("label").append('<span class="error_msg error_elem_msg"> (REQUIS) </span>');
}

function textarea_to_end(ta_element)
{
    return ((ta_element.scrollTop + ta_element.offsetHeight) > ta_element.scrollHeight);
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
