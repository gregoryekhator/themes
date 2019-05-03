var ajaxsuccess = "Success";

$(document).ready(function () {
	
	
	$('#btnsndmsg').click(function(e){
	
	    e.preventDefault();

		var sender = $(this).attr('lang')
		validateInput(sender);
	
	})
	
	
})

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
        } else { $(this).css('border', 'solid 1px #CCC') }

    })

	//check for text edit fields...
    $('textarea[class*="data-ReqF"]').each(function () {

        var txtv = $(this).val();

        if (!(txtv)) {
            requiredFields = requiredFields + 1;
            $(this).css('border', 'solid 1px red')
        } else { $(this).css('border', 'solid 1px #CCC') }

    })
	
    //check for dropdown fields
    $('select[class*="data-ReqF"]').each(function () {

        var selv = $(this).val();

        if (selv == selprevinfo) {
            requiredFields = requiredFields + 1;
            $(this).css('border', 'solid 1px red')
        } else { $(this).css('border', 'solid 1px #CCC') }


    })

    
    var demailElementId = "#txt-contact-email";
    var demail = $(demailElementId).val();

    if (demail) {

        var vemail = ValidateEmailAddress(demail);

        if (!(vemail)) {

            $(demailElementId).css('border', 'solid 1px red');
            $(demailElementId).parent('div').next('span').remove();
            $(demailElementId).parent('div').after(' <span style="color:red;">Email Address contains errors!</span>')
            requiredFields = requiredFields + 1;

        } else {

            $(demailElementId).css('border', 'solid 1px #CCC');
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
            var specReq = $("#txt-contact-msg").val();

    
            //alert(imgAvl)
            ddAvl = ddAvl + "|" + selDctrs;
            var combineData =  sender + "|" + txtAvl + "|" + specReq;

            //alert(combineData)

            //ajaxify the data...
            var ajaxpath = "php/datatranzakt.php";
            ajaxify(ajaxpath, combineData);


        }

    }

}

function ajaxify(path, matrix) {

    $("#submit-loader").show();

	//alert(matrix);
	
    $.ajax({
        url: path,
        type: 'post',
        data: { 'action': matrix},
        success: function (data, status) {

            $("#submit-loader").hide();

            if (data == ajaxsuccess) {
                document.location.href = "http://www.alliancehospitalabj.com";
            } else { alert("Message Sent!"); document.location.href = "http://www.alliancehospitalabj.com"; }

        },
        error: function (xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
        }
    }); // end ajax call

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