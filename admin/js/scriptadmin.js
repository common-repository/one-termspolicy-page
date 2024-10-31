jQuery(document).ready(function ($) {
    /*For oneTermsPolicy option Page*/
    $('#frm_option_page').validate({
        rules: {
            opSiteName: {
                required: true,
            },
            opSiteUrl: {
                required: true,
                url: true
            },
            opComponyName: {
                required: true,
            }
        },
        messages: {
            opSiteName: {
                required: "پر کردن این فیلد الزامی است",
            },
            opSiteUrl: {
                required: "پر کردن این فیلد الزامی است",
                url: "خطا : آدرس باید با فرمت url باشد مثال http://vindad.com ",
            },
            opComponyName: {
                required: "پر کردن این فیلد الزامی است",
            },
        },
        submitHandler: function (form) {
            $('#frm_option_page .responseAjax').html('');
            $('#frm_option_page .responseAjax').css('display', 'block');
            $('#one-loading').show();
            $('#frm_option_page input:submit').attr('disabled', true);
            var data = {
                action: 'one-TermsPolicy_option_page',
                nonce_js: oneTermsPolicy_obj.optin_page,
                form_js: $(form).serialize()
            }
            $.post(ajaxurl, data, function (response) {
                var responseback = $.parseJSON(response);
                $('#frm_option_page .responseAjax').html(responseback.text);
                if (responseback.status) {
                    $('#frm_option_page .responseAjax').removeClass('responseError');
                    $('#frm_option_page .responseAjax').addClass('responseSuccess');
                } else {
                    $('#frm_option_page .responseAjax').removeClass('responseSuccess');
                    $('#frm_option_page .responseAjax').addClass('responseError');
                }
                $('#one-loading').hide();
                $('#frm_option_page input:submit').attr('disabled', false);
                $('#frm_option_page .responseAjax').delay(3000).fadeOut('slow');
            })
        }
    });
    /*For oneTermsPolicy Question Page*/
    $('#frmQuestion').validate({
        rules: {
            'StoreQuestion[field][field1]': {
                required: true,
            },
            'StoreQuestion[field][field2]': {
                required: true,
            },
            'StoreQuestion[field][field3]': {
                required: true,
                url: true
            },
            'PersonalQuestion[field][field1]': {
                required: true,
            },
            'PersonalQuestion[field][field2]': {
                required: true,
            },
            'PersonalQuestion[field][field3]': {
                required: true,
                url: true
            },
            'CompanyQuestion[field][field1]':{
                required: true,
            },
            'CompanyQuestion[field][field2]':{
                required: true,
            }
        },
        messages: {
            'StoreQuestion[field][field1]': {
                required: "پر کردن این فیلد الزامی است",
                color: 'red'
            },
            'StoreQuestion[field][field2]': {
                required: "پر کردن این فیلد الزامی است",
            },
            'StoreQuestion[field][field3]': {
                required: "پر کردن این فیلد الزامی است",
                url: "خطا : آدرس باید با فرمت url باشد مثال http://vindad.com "
            },
            'PersonalQuestion[field][field1]': {
                required: "پر کردن این فیلد الزامی است",
                color: 'red'
            },
            'PersonalQuestion[field][field2]': {
                required: "پر کردن این فیلد الزامی است",
            },
            'PersonalQuestion[field][field3]': {
                required: "پر کردن این فیلد الزامی است",
                url: "خطا : آدرس باید با فرمت url باشد مثال http://vindad.com "
            },
            'CompanyQuestion[field][field1]':{
                required: "پر کردن این فیلد الزامی است",
            },
            'CompanyQuestion[field][field2]':{
                required: "پر کردن این فیلد الزامی است",
            }
        },
        submitHandler: function (form) {
            $('#frmQuestion .responseAjax').html('');
            $('#frmQuestion .responseAjax').css('display', 'block');
            $('.wrap').css({'cursor': 'wait'});
            $('#one-loading').show();
            $('#frmQuestion input:submit').attr('disabled', true);
            var data = {
                action: 'one-TermsPolicy_question_page',
                nonce_js: oneTermsPolicy_obj.optin_page,
                form_js: $(form).serialize()
            }
            $.post(ajaxurl, data, function (response) {
                var responseback = $.parseJSON(response);
                $('#frmQuestion .responseAjax').html(responseback.text);
                if (responseback.status) {
                    $('#frmQuestion .responseAjax').removeClass('responseError');
                    $('#frmQuestion .responseAjax').addClass('responseSuccess');
                } else {
                    $('#frmQuestion .responseAjax').removeClass('responseSuccess');
                    $('#frmQuestion .responseAjax').addClass('responseError');
                }
                /*/!*Temp*!/
                 $('#one-loading').hide();
                 $('#frmQuestion input:submit').attr('disabled',false);
                /!*Temp*!/*/
                var responseTrim = responseback.url.replace(/&amp;/g, '&');
                window.location.href = responseTrim;

                //$('#frmQuestion .responseAjax').delay(3000).fadeOut('slow');
            })
        }
    });
    /*Validate Page Option*/
    $('#frmValidateOption').validate({

        submitHandler: function (form) {
            $('#frmValidateOption .responseAjax').html('');
            $('#frmValidateOption .responseAjax').css('display', 'block');
            $('#one-loading').show();
            $('#frmValidateOption input:submit').attr('disabled', true);
            var data = {
                action: 'one-TermsPolicy_validate_option_page',
                nonce_js: oneTermsPolicy_obj.optin_page,
                form_js: $(form).serialize()
            }
            $.post(ajaxurl, data, function (response) {
                var responseback = $.parseJSON(response);
                $('#frmValidateOption .responseAjax').html(responseback.text);
                if (responseback.status) {
                    $('#frmValidateOption .responseAjax').removeClass('responseError');
                    $('#frmValidateOption .responseAjax').addClass('responseSuccess');
                } else {
                    $('#frmValidateOption .responseAjax').removeClass('responseSuccess');
                    $('#frmValidateOption .responseAjax').addClass('responseError');
                }
                $('#one-loading').hide();
                $('#frmValidateOption input:submit').attr('disabled', false);
                $('#frmValidateOption .responseAjax').delay(3000).fadeOut('slow');
            })
        }
    });
    $('#showSignUp').click(function () {
        $('#rowSignUpSelectPrivacy').toggle();
    });
    $('#showSignIn').click(function () {
        $('#rowSignInSelectPrivacy').toggle();
    });
});