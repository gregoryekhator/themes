$(document).ready(function(){

$("#alliance-popup").css('width','600px')
$("#alliance-popup").css('height','420px')
//$("#alliance-popup").css('background','white')

//var popshown = $.jCookies({ name: "ps", value: p, days: 90 });

if ($.jCookies({ get: "popshown" })) { 

   // $("#alliance-popup").hide();

} else {

    $('#alliance-popup').bPopup({
        follow: [false, false], //x, y
        position: [150, 400] //x, y
    });

    var ddays = daysleft();
    //$.jCookies({ name: "popshown", value: 1, days: ddays });
    
}





})

/*
 * Function to calculate the absolute difference in days, months and years between 2 days taking into account variable month lengths and leap years
 * It ignores any time component (ie hours, minutes and seconds)
 *
 */
function daysleft() {

    var today = new Date();
    var now = today.getDate();
    var year = today.getFullYear();
    var month = today.getMonth();

    var monarr = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    // check for leap year
    if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) monarr[1] = "29";

    return monarr[month] - now;


}