var imgpreviewicon = 'images/preview-icon.png';
var xmlCountries = "data/CountriesOfTheWorld.xml"
var xmlDocts = "data/AllianceDoctors.xml"
var selprevinfo = '[-]';
var ajaxsuccess = "Success";

$(document).ready(function () {

    $('.tr-x-field').hide();
    $("#submit-loader").hide();

$('#Inp-Txt-DOB').appendDtpicker({"dateOnly": true,
                    "dateFormat": "YYYY-MM-DD"});

ajaxifyDD("#DD-Ctry-Residence", xmlCountries)
ajaxifyDD("#DD-Ctry-Birth", xmlCountries)
ajaxifyDD("#DD-Docs-Available", xmlDocts)

$('#Inp-Txt-DOA').appendDtpicker();

$('*[name*="Doctors"]').click(function(){

    var _ctarget = $(this).attr('id');

    if(_ctarget == 'Inp-Rad-Pers-Choice'){

        $('.tr-x-field').show();

    }else{

        $('.tr-x-field').hide();

    }

});

$('#upload_file').live('change', function()
    {
      $("#preview").html('');
      $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
      $("#contactForm").ajaxForm(
      {
        target: '#ImgPreview'
      }).submit();
    });

$('#upload_waec').live('change', function()
    {
      $("#preview").html('');
      $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
      $("#contactFormB").ajaxForm(
      {
        target: '#ImgWPreview'
      }).submit();
    });


$('#upload_schid').live('change', function()
    {
      $("#preview").html('');
      $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
      $("#contactFormC").ajaxForm(
      {
        target: '#ImgIDPreview'
      }).submit();
});

$('input[type="file"]').live('change', function () {
    
    var tfm = "#" + $(this).parent('form').attr('id');
    var timgc = "#"  + $(this).attr('lang');

    uploadAction(tfm, timgc)

});

$('#submit-app-form').click(function (e) {

    e.preventDefault();

    var sender = $(this).attr('lang')
    validateInput(sender);
    
    

})


 
});

function uploadAction(f, t){

        $(f).ajaxForm(
    {
        target: t
    }).submit();

}

function validateInput(sender) {

    var requiredFields = 0;

    //Check for uploaded images
    $('.ImgR').each(function () {

        var imgPath = $(this).attr('src');
        
        if (imgPath == imgpreviewicon) {

            requiredFields = requiredFields + 1;
            $(this).parent().css('border', 'solid 1px red')

        } else {

            $(this).parent().css('border', 'solid 1px #fbdc04')

        }

    })

    //check for text fields...
    $('input[class*="data-ReqF"]').each(function () {

        var txtv = $(this).val();

        if (!(txtv)) {
            requiredFields = requiredFields + 1;
            $(this).css('border', 'solid 1px red')
        } else { $(this).css('border', 'solid 1px gray') }

    })

    //check for dropdown fields
    $('select[class*="data-ReqF"]').each(function () {

        var selv = $(this).val();

        if (selv == selprevinfo) {
            requiredFields = requiredFields + 1;
            $(this).css('border', 'solid 1px red')
        } else { $(this).css('border', 'solid 1px gray') }


    })

    $("input[name*='Doctors']:checked").each(function(){

            var dctrId = $(this).attr('id');
            var selDctrs = $("#DD-Docs-Available").val();           

            if(dctrId == "Inp-Rad-Pers-Choice" && selDctrs == "[-]"){

                    requiredFields = requiredFields + 1;
                    $("#DD-Docs-Available").css('border', 'solid 1px red')

            } else {

                    $("#DD-Docs-Available").css('border', 'solid 1px gray')

            }

    });  

    var demailElementId = "#Inp-Txt-PEmail";
    var demail = $(demailElementId).val();

    if (demail) {

        var vemail = ValidateEmailAddress(demail);

        if (!(vemail)) {

            $(demailElementId).css('border', 'solid 1px red');
            $(demailElementId).parent('div').next('span').remove();
            $(demailElementId).parent('div').after(' <span style="color:red;">Email Address contains errors!</span>')
            requiredFields = requiredFields + 1;

        } else {

            $(demailElementId).css('border', 'solid 1px gray');
            $(demailElementId).parent('div').next('span').remove();

        }

    }
    

    if (requiredFields) { alert('The following images and fields highlighted in red are required or are incorrect, please provide or correct them and click submit again!') } else {

        var chkagreement = 1//$(".chkagreement:checked").length;

        if (!(chkagreement)) {

            alert('Please indicate that you have read and understand our Terms and Agreement!')

        } else {

            var imgAvlSum = $('.ImgDocs').length, imgAvlO = imgAvlSum - 1, imgAvl = "";
            var txtAvlSum = $('input[class*="data-ReqF"]').length, txtAvlO = txtAvlSum - 1, txtAvl = "";
            var ddAvlSum = $('select[class*="data-ReqF"]').length, ddAvlO = ddAvlSum - 1, ddAvl = "";
            
            //1.) get all images...
            for (count = 0; count < imgAvlO; count++) {
                imgAvl = $.trim(imgAvl) + $(".ImgDocs:eq(" + count + ")").attr('alt') + "|";
            }

            if (imgAvlSum){
                //at least one document uploaded...
                imgAvl = imgAvl + $(".ImgDocs:eq(" + imgAvlO + ")").attr('alt');
            }

            //2.) get all document paths...
           // for (count = 0; count < imgDAvlO; count++) {
             //   imgDAvl = $.trim(imgDAvl) + $(".ImgDR:eq(" + count + ")").attr('alt') + "|";
            //}

            //3.) get all text fields
            for (count = 0; count < txtAvlO; count++) {
                txtAvl = $.trim(txtAvl) + $('input[class*="data-ReqF"]:eq(' + count + ')').val() + "|";
            }

            //4.) get all dropdown fields
            for (count = 0; count < ddAvlO; count++) {
                ddAvl = $.trim(ddAvl) + $("select[class*='data-ReqF']:eq(" + count + ")").val() + "|";
            }

            
            txtAvl = txtAvl + $('input[class*="data-ReqF"]:eq(' + txtAvlO + ')').val();
            ddAvl = ddAvl + $("select[class*='data-ReqF']:eq(" + ddAvlO + ")").val();

            var selectedDoc = "1";
            var selDctrs = $("#DD-Docs-Available").val();   
            var specReq = $("#Txt-SpecReq").val();

    $("input[name*='Doctors']:checked").each(function(){

            var dctrId = $(this).attr('id');

            if(dctrId == "Inp-Rad-Pers-Choice" && selDctrs != "[-]"){

                selDctrs = $("#DD-Docs-Available").val()

            } else {

                selDctrs = selectedDoc;
            }

    });


            //alert(imgAvl)
            ddAvl = ddAvl + "|" + selDctrs;
            var combineData =  sender + "|" + imgAvl + "|" + txtAvl + "|" + ddAvl + "|" + specReq;

            //alert(combineData)

            //ajaxify the data...
            var ajaxpath = "php/datatranzakt.php";
            ajaxify(ajaxpath, combineData);


        }

    }

}

function getContactImg(){
	var n = $.jCookies({ get : 'contPixPath' });//$.cookie.read('contPixPath');	
	return n;
}

function setContactImg(e){
	$.jCookies({ name : 'contPixPath', value : e, minutes : 60 });
	//$.cookie.write('contPixPath', e, 24 * 60 * 60);	
	//$.jCookies({ name : 'contPixPath', value : e, minutes : 60 });
	var msg = getContactImg();//$.jCookies({ get : 'contPixPath' });//$.cookie.read('contPixPath');
	alert(msg)
	$("#contactImage").attr("src", e);
 	$('#upload_file').val('');
 	$('#submit_image').hide();
}

function destroyContactImg(){
	//$.cookie.destroy('contPixPath');	
	$.jCookies({ erase : 'contPixPath' });
}

function getContactWaec(){
	$.cookie.read('contWPixPath');	
}

function setContactWaec(e){
	$.cookie.write('contWPixPath', e, 24 * 60 * 60);	
	$("#contactWAEC-Result").attr("src", e);
 	$('#upload_waec').val('');
 	$('#submit_waec').hide();
}

function destroyContactWaec(){
	$.cookie.destroy('contWPixPath');	
}

function getContactSchID(){
	$.cookie.read('contSIDPixPath');	
}

function setContactSchID(e){
	$.cookie.write('contSIDPixPath', e, 24 * 60 * 60);	
	$("#contactSchoolID").attr("src", e);
 	$('#upload_schid').val('');
 	$('#submit_schid').hide();
}

function destroyContactSchID(e){
	$.cookie.destroy('contSIDPixPath');	
}

function checkOrSetImg(){

	var contPixPathReady = getContactImg();
	var contWPixPathReady = getContactWaec();
	var contSIDPathReady = getContactSchID();

//alert(contPixPathReady);

	if (contPixPathReady){
		setContactImg();
	}else{
		alert(contPixPathReady)
	}

	if (contWPixPathReady){
		setContactWaec();
	}

	if (contSIDPathReady){
		setContactSchID();
	}

}

function ajaxify(path, matrix) {

    $("#submit-loader").show();

    $.ajax({
        url: path,
        type: 'post',
        data: { 'action': matrix},
        success: function (data, status) {

            $("#submit-loader").hide();

            if (data == ajaxsuccess) {
                				
				clearControls()
				document.location.href = "finish";
				
            } else { alert(data); }

        },
        error: function (xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
        }
    }); // end ajax call

}

function ajaxifyDD(dd, xmlPath) {

    $.ajax({
        type: "GET",
        url: xmlPath,
        dataType: "xml",
        success: function (xml) {
            $(xml).find('Item').each(function () {
                $(dd).append($('<option></option>').val
    ($(this).attr('value')).html($(this).attr('Text')));
            });
        }
    });

}

function ValidateEmailAddress(email) {

    if ($.trim(email)) {

        if (checkRegexp($.trim(email), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i) == false) {

            return false;

        } else {

            return true;

        };

    } else {

        return false;

    }
}


function checkRegexp(o, regexp, n) {
    if (!(regexp.test(o))) {
        return false;
    } else {
        return true;
    }
}

function clearControls(){
	
	$('input[type="text"]').val('');
	$('select').val('[-]');
	$('textarea').empty();
	$(".ImgDocs").src('http://www.alliancehospitalabj.com/images/empty-image.png')
	
}