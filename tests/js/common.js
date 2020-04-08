$(document).ready(function(){
//    $('body').on( 'focus', ':input', function(){
//        $( this ).attr( 'autocomplete', 'off' );
//    });
    
    setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('DD MMMM YYYY') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#date-part').append("&nbsp;&nbsp;"+momentNow.format('hh:mm:ss A '));
    }, 100);
    
});
function regis_captcha(){
    document.getElementById('registrationcaptcha').src = BASEURL+"internals/captcha_image.php?rnd=" + Math.random();
}
$('#registrationrefresh').css('cursor', 'pointer');
    $('img#registrationrefresh').click(function () {
        $('#regd_captcha').val('');
        regis_captcha();
    });