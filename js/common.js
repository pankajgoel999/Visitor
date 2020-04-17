$(document).ready(function(){
 var BASEURL = "<?=BASEURL;?>";
 var FILEUPLOADSIZE = "<?=FILEUPLOADSIZE;?>";
  //  alert(BASEURL);
    $('input.datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true,
    //startDate: startdate,
    endDate: '+0d',
    }).click(function(){
        $('.datepicker-days').css('display','block');
    });
});
 
 $(document).on("change", ".personal_country", function() {
 //alert("22");
     $("#userprofile-personal_state").val('');
     $("#userprofile-personal_district").val('');
     $("#userprofile-personal_city").val('');
     $("#userprofile-personal_pin").val('');
     
     var country =  $(this).val();
     if(country == 'India'){  
           $(".pindia1").show();
            $(".pindia2").show();
     }else{
         $(".pindia1").hide();
            $(".pindia2").hide();
     }
 });

$(document).on("change", ".official_country", function() {
 //alert("22");
     $("#userprofile-official_state").val('');
     $("#userprofile-official_district").val('');
     $("#userprofile-official_city").val('');
     $("#userprofile-official_pin").val('');
     
     var countryo =  $(this).val();
     if(countryo == 'India'){  
        $(".oindia1").show();
        $(".oindia2").show();
     }else{
        $(".oindia1").hide();
        $(".oindia2").hide();
     }
 });
 
function regstimg(fileid,preview_pdf,fileobj) {
    Hide_validation();
    $('#update_ProfileButton').css("display","none");
    $("#Image_type").val('');
    $("#Image_Ext").val('');
    var filesize= parseInt(120);
    var valid = validateFileSize(fileid,filesize);
    var error="";
   
    if(valid == '0'){
       
        $('#'+fileid).val('');
        error = error + "<li>Size can not be greater then 120 KB / File Empty.</li>";
        VISITOR_validatation(error);
        
        return false;
    }
    var ext_name = 'jpg,jpeg,png';
    var jpeg = 'data:image/jpeg';
    var jpeg_magic = '0xFFD8FFE0';

    var png="data:image/png";
    var pngmagic ="0x89504E47";

    var slice = fileobj.slice(0,4);
    var reader = new FileReader();
    reader.readAsArrayBuffer(slice);
    
    reader.onload = function(e){
        var buffer = reader.result;
        var view = new DataView(buffer);
        var magic = view.getUint32(0, false);

    if(magic){

        var extall=ext_name;
        var filen = fileobj.name;
        var ext = filen.split('.').pop().toLowerCase();
        if(parseInt(extall.indexOf(ext)) < 0){
            error = error + "<li>File extension not supported !</li>";
            VISITOR_validatation(error);
            return false;
        } else {
        //alert('true part');
        var fname = document.getElementById(fileid).value;

        var oFile = document.getElementById(fileid).files[0];
        var oImage = document.getElementById(preview_pdf);
        var counter=fileid.substr(-1);
        var iserror=false;
        var oReader = new FileReader();
        oReader.onload = function(e){
        //e.target.result contains the DataURL which we will use as a source of the image
        var chktype = e.target.result.split(";")[0];
            
        if((chktype == jpeg && magic==jpeg_magic) || (chktype == png && magic
        == pngmagic))
        {
        $('#removesingleupload').css('display','block');
        $('#removesingleupload').html('<button id="removeimagebutton" type="button" onclick="removesingleupload(\'singleuploadtag\',\'removeimagebutton\',\'imagepreviewsrc\',\''+fileid+'\')" class="btn btn-danger" >Remove</button>');
        $('#imagepreviewsrc').html('');
        $('#singleuploadtag').html('Change Photo');
        $('#singleimageupload').css("right","1%");
        $('#singleimageupload').css("width","98%");
       // $('#singleimageupload').css("height","20%");
        $("#Image_type").val(chktype);
        $("#Image_Ext").val(ext);

        var img_src_url;
        img_src_url = e.target.result;
        var img = '<a target="_blank" href="'+e.target.result+'"><img style="border-radius:50%;height:100px; width:100px;" src="'+img_src_url+'"/></a><input type="hidden" id="pu_candidate_image" name="tblCandidateImage[Image_Content]" value="'+e.target.result+'" />';
        //$('#imagepreviewsrc').css("float","left");
        //$('#singleupload').css("float","left");
        $('#singleupload').css("margin-left","2%");

        $('#imagepreviewsrc').html(img);
        $('#imagepreviewsrc').css("display","block");
        $('#update_ProfileButton').css("display","inline-block");

        }
        else
        {
        document.getElementById(fileid).value='';
        error = error + "<li>File type/content not supported!</li>";
        VISITOR_validatation(error);
        return false;
        }
        }//oReader.onload
        oReader.readAsDataURL(oFile);
        }//else parseInt(extall.indexOf(ext)) < 0
    }
    else{
    $('#file').val('');
    error = error + "<li>File type/content not supported!</li>";
    VISITOR_validatation(error);
    return false;
    }//else magic==magiccode
    }
}

function Hide_validation()
{
    $("#error_main").hide();
    $("#widget_error_main_inner").html("");
    $("#error_main").removeClass("alert-success");
    $("#error_main").addClass("alert-error");
    $("#error_main").html("<ul id='widget_error_main_inner'></ul>");
}

function validatePDFFileSize(id,filesize){
    var file = document.getElementById(id);
    var file_Size =
(file.files[0].size)/1024;//(file[0].size||file[0].fileSize);//file.files[0].size;
     file_Size = (file_Size)/1024
    // alert(file_Size);
    if(file_Size > 1){
        return '0';
    }
    return '1';
}


function validateFileSize(id,filesize){
	var file = document.getElementById(id);
	var file_Size = (file.files[0].size)/1000;//(file[0].size||file[0].fileSize);//file.files[0].size;        
	if(file_Size == 0 || file_Size>filesize){
		return '0';
	}
	return '1';      
}

function removesingleupload(tag,buttonid, divimgprev,fileid){
        Hide_validation();
	$('#'+buttonid).remove();
	$('#'+divimgprev).css('display','none');
	$('#'+divimgprev).html('');
	$('#'+fileid).val('');
	$('#'+tag).html('');
	$('#'+tag).html('Upload Photo');
        $('#'+fileid).css("left","5px");
        $('#'+fileid).css("width","91%");
        $('#'+fileid).css("height","90%");
        $("#Image_type").val('');
        $("#Image_Ext").val('');
        $('#update_ProfileButton').css("display","none");
}
function validemailaddress(email){
    
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (emailReg.test(email)){
        return true;
    }
    return false;
}

$(document).on("change", ".common_getdistbystateP", function() {

       $htmlFaculty="<option value=''>Select District</option>";
        $(".pdist").html($htmlFaculty);
        $csrf = $("#_csrf").val();
        $webtoken = $("#_jsonwebtoken").val();
        $("#pcity").html('<option>Select City</option>');
        $state = $(this).val();
        if($state)
        {

        var url = BASEURL + "registration/getdistsbystateid";
        startLoader();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {state_id:$state,_csrf:$csrf,webtoken:$webtoken},
            //contentType: "application/json; charset=utf-8", 
            success: function(data) {
            stopLoader();
            var status_id = data.STATUS_ID;
            var res = data.STATUS_RESPONSE;
            if(status_id == "000")
                $(".common_getdistreg").html(res);
            else {
             return false;
            }
            }
        });
        }

    });

$(document).on("change", ".common_getdistbystateO", function() {

       $htmlFaculty="<option value=''>Select District</option>";
        $(".odist").html($htmlFaculty);
        $csrf = $("#_csrf").val();
        $webtoken = $("#_jsonwebtoken").val();
        $("#ocity").html('<option>Select City</option>');
        $state = $(this).val();
        if($state)
        {

        var url = BASEURL + "registration/getdistsbystateid";
        startLoader();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {state_id:$state,_csrf:$csrf,webtoken:$webtoken},
            //contentType: "application/json; charset=utf-8", 
            success: function(data) {
            stopLoader();
            var status_id = data.STATUS_ID;
            var res = data.STATUS_RESPONSE;
            if(status_id == "000")
                $(".common_getdistrego").html(res);
            else {
             return false;
            }
            }
        });
        }

    });

$(document).on("change", ".pdist", function() {

       $htmlFaculty="<option value=''>Select City</option>";
        $(".pcity").html($htmlFaculty);
        $csrf = $("#_csrf").val();
        $webtoken = $("#_jsonwebtoken").val();
        $("#pcity").html('<option>Select City</option>');
        $dist = $(this).val();
        if($dist)
        {

        var url = BASEURL + "registration/getcitiesbydistid";
        startLoader();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {dist:$dist,_csrf:$csrf,webtoken:$webtoken},
            //contentType: "application/json; charset=utf-8", 
            success: function(data) {
            stopLoader();
            var status_id = data.STATUS_ID;
            var res = data.STATUS_RESPONSE;
            if(status_id == "000")
                $(".pcity").html(res);
            else {
             return false;
            }
            }
        });
        }

    });

$(document).on("change", ".odist", function() {

       $htmlFaculty="<option value=''>Select City</option>";
        $(".ocity").html($htmlFaculty);
        $csrf = $("#_csrf").val();
        $webtoken = $("#_jsonwebtoken").val();
        $("#ocity").html('<option>Select City</option>');
        $dist = $(this).val();
        if($dist){

        var url = BASEURL + "registration/getcitiesbydistid";
        startLoader();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {dist:$dist,_csrf:$csrf,webtoken:$webtoken},
            success: function(data) {
            stopLoader();
            var status_id = data.STATUS_ID;
            var res = data.STATUS_RESPONSE;
            if(status_id == "000")
                $(".ocity").html(res);
            else {
             return false;
            }
            }
        });
        }

    });

function startLoader(){
       $("#loading").show();
 }
 
 function stopLoader(){
       $("#loading").hide();
 }

function upload_pdf_file(fileid,preview_pdf,fileobj){
     var error = '';
    var filesize= '500';
    
    var filesize= parseInt(120);
    var valid = validateFileSize(fileid,filesize);
    var error="";
    if(valid == '0')
    {
    $('#'+fileid).val('');
    error = error + "<li>Size can not be greater then  120 KB / File Empty.</li>";
    VISITOR_validatation(error);
    return false;
    }
    
//    var valid = validatePDFFileSize(fileid,filesize);
//    if(valid == '0'){
//        $('#'+fileid).val('');
//            error = error + "<li>File Size too Large</li>";
//            VISITOR_validatation(error);
//            return false;
//    }
    var ext_name = 'pdf';
    var pdf = "data:application/pdf";
    var pdf1 = "data:binary/octet-stream";
    var pdf2 = "data:application/x-download";
    var pdf_magic = "0x25504446";
    var pdf_magic1 = "626017350";


    var slice = fileobj.slice(0,4);
    var reader = new FileReader();
    reader.readAsArrayBuffer(slice);
    reader.onload = function(e)
    {
        var buffer = reader.result;
        var view = new DataView(buffer);
        var magic = view.getUint32(0, false);
        //alert(magic);
        if( magic == pdf_magic || magic == pdf_magic1){
            var extall=ext_name;
            var filen = fileobj.name;
            var ext = filen.split('.').pop().toLowerCase();

            if(parseInt(extall.indexOf(ext)) < 0){
                 $('#'+fileid).val('');
                 error = error + "<li>File type/content not supported... !</li>";
                 VISITOR_validatation(error);
                 return false;
            }else{
                //alert('true part');
                var fname = document.getElementById(fileid).value;

                    var oFile = document.getElementById(fileid).files[0];
                    var oImage = document.getElementById(preview_pdf);
                     var counter=fileid.substr(-1);
                    var iserror=false;
                    var oReader = new FileReader();
                    oReader.onload = function(e){
                        //e.target.result contains the DataURL which we will use as a source of the image
                        var chktype = e.target.result.split(";")[0];
                        if((chktype == pdf) || (chktype == pdf1) || (chktype == pdf2)){
                            //alert(e.target.result);
                            $('#removepdffile'+fileid).css('display','block');
                            $('#removepdffile'+fileid).css('margin-top','5px');

                            $('#removepdffile'+fileid).html('<button id="removeimagebutton'+fileid+'\" type="button" onclick="removepdffile(\'pdfuploadtag'+fileid+'\',\'removeimagebutton'+fileid+'\',\'pdfpreviewsrc'+fileid+'\',\''+fileid+'\')" class="btn btn-danger" >Remove</button>');

                            $('#pdfpreviewsrc'+fileid).html('');
                            $('#pdfuploadtag'+fileid).html('Change');
                            var imgurl = BASEURL +'images/pdficon.jpg';
                            var img = '<a target="_blank" href="'+e.target.result+'"><img style="height:100px; width:100px;" src="'+imgurl+'"/></a>';
                            $('#pdfpreviewsrc'+fileid).css("float","left");
                            $('#pdfupload'+fileid).css("margin-top","10px");

                            $('#pdfpreviewsrc'+fileid).css("margin-right","20px");
                            $('#pdfpreviewsrc'+fileid).html(img);
                            $('#pdfpreviewsrc'+fileid).css("display","block");
                            $('#chk'+fileid).val("1");
                        }else{
                            document.getElementById(fileid).value='';
                              $('#'+fileid).val('');
                             error = error + "<li>File type/content not supported... !</li>";
                             VISITOR_validatation(error);
                             return false;
                        }
                    }//oReader.onload
                    oReader.readAsDataURL(oFile);
            }//else parseInt(extall.indexOf(ext)) < 0
        }else{
              $('#'+fileid).val('');
             error = error + "<li>File type/content not supported... !</li>";
             VISITOR_validatation(error);
             return false;
        }
    }
}
//Remove PDF file size
function removepdffile(tag,buttonid, divimgprev,fileid){
    
    $('#'+buttonid).remove();
   // alert(divimgprev);
    $('#removepdffile'+fileid).css('display','none');
    $('#'+divimgprev).css('display','none');
    $('#'+divimgprev).html('');
    $('#'+fileid).val('');
    $('#'+tag).html('');
    $('#'+tag).html('Upload');
    $('#chk'+fileid).val("");
}
function VISITOR_validatation(error)
{
    $("#widget_error_main_inner").html("");
    $("#error_main").show();
    $("#widget_error_main_inner").html(error);
    $('html, body').animate({scrollTop: 0}, 'slow');
}
function VISITOR_hide_validation()
{
    $("#error_main").hide();
    $("#widget_error_main_inner").html("");
    $("#error_main").removeClass("alert-success");
    $("#error_main").addClass("alert-error");
    $("#error_main").html("<ul id='widget_error_main_inner'></ul>");
}
var secret="#_ZII_#";
//$('#regbtn').click(function(e){
$('#regbtn').click(function(){
  
    var error = '';
    // alert("123");
 
    var disclaimer = $("input[id='disclaimer']:checked").val();
    if (!disclaimer)
    {
            error = error + "<li>Check Disclaimer </li>";
            VISITOR_validatation(error);
            return false;
    }
    
    /********* First Name **********/      
    var fname = $.trim($("#userprofile-fname").val());
    $("#userprofile-fname").val(fname);
    if (!fname){
            error = error + "<li>First Name Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-fname").focus();
            return false;
    }
    
    /********* Last Name **********/      
    var lname = $.trim($("#userprofile-lname").val());
    $("#userprofile-lname").val(lname);
    if (!lname){
            error = error + "<li>Last Name Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-lname").focus();
            return false;
    }
    
    /********* Mobile **********/      
    var mobile = $.trim($("#userprofile-mobile").val());
    $("#userprofile-mobile").val(mobile);
    if (!mobile){
            error = error + "<li>Mobile Number Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-mobile").focus();
            return false;
    }
    
     /********* Date of Birth **********/      
    var dob = $.trim($("#userprofile-dob").val());
    $("#userprofile-dob").val(dob);
    if (!dob){
            error = error + "<li>Date of Birth Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-dob").focus();
            return false;
    }
    
     /********* Gender **********/      
    var gender = $.trim($("#userprofile-gender").val());
    $("#userprofile-gender").val(gender);
    if (!gender){
            error = error + "<li>Gender Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-gender").focus();
            return false;
    }
    /******* Photo ***************/ 
    var Image_type = $.trim($("#Image_type").val());
    var Image_Ext = $.trim($("#Image_Ext").val());
     
    if (Image_type == "" && Image_Ext == ""){
            error = error + "<li>Upload your Photo</li>";
            VISITOR_validatation(error);
            return false;
    }
       
    /******* Email ID ***************/ 
     var email = $.trim($("#userprofile-email").val());
    $("#userprofile-email").val(email);
    if (email)
    {
        if (!validemailaddress(email))
        {
            error = error + "<li>Valid Email ID Required </li>";
            VISITOR_validatation(error);
            $("#userprofile-email").focus();
            return false;
        }
    }else{
            error = error + "<li>Email ID Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-email").focus();
            return false;
    }
    
      /********* Password **********/      
//    var dpassword = $.trim($("#userprofile-dpassword").val());
//    $("#userprofile-dpassword").val(dpassword);
//    if (!dpassword){
//            error = error + "<li>Password Required</li>";
//            VISITOR_validatation(error);
//            $("#userprofile-dpassword").focus();
//            return false;
//    }
//    
//      /********* Confirm Password **********/      
//    var cpassword = $.trim($("#userprofile-cpassword").val());
//    $("#userprofile-cpassword").val(cpassword);
//    if (!cpassword){
//            error = error + "<li>Confirm Password Required</li>";
//            VISITOR_validatation(error);
//            $("#userprofile-cpassword").focus();
//            return false;
//    }
//    if (dpassword != cpassword){
//            error = error + "<li>Mis-match in Password and Confirm Password</li>";
//            VISITOR_validatation(error);
//            $("#userprofile-cpassword").focus();
//            return false;
//    }
   
    /********* Personal Address **********/      
    var personal_address = $.trim($("#userprofile-personal_address").val());
    $("#userprofile-personal_address").val(personal_address);
    if (!personal_address){
            error = error + "<li>Personal Address Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-personal_address").focus();
            return false;
    }
    
    /********* Personal Country **********/      
    var personal_country = $.trim($("#userprofile-personal_country").val());
    $("#userprofile-personal_country").val(personal_country);
    if (!personal_country){
            error = error + "<li>Personal Country Required</li>";
            VISITOR_validatation(error);
            $("#userprofile-personal_country").focus();
            return false;
    }
    
    if(personal_country == 'India'){
        
        /********* Personal State **********/      
        var personal_state = $.trim($("#userprofile-personal_state").val());
        $("#userprofile-personal_state").val(personal_state);
        if (!personal_state){
                error = error + "<li>Personal State in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-personal_state").focus();
                return false;
        }
        
        /********* Personal District **********/      
        var personal_district = $.trim($("#userprofile-personal_district").val());
        $("#userprofile-personal_district").val(personal_district);
        if (!personal_district){
                error = error + "<li>Personal District in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-personal_district").focus();
                return false;
        } 
        
         /********* Personal City **********/      
        var personal_city = $.trim($("#userprofile-personal_city").val());
        $("#userprofile-personal_city").val(personal_city);
        if (!personal_city){
                error = error + "<li>Personal City in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-personal_city").focus();
                return false;
        } 
        
         /********* Personal PIN **********/      
        var personal_pin = $.trim($("#userprofile-personal_pin").val());
        $("#userprofile-personal_pin").val(personal_pin);
        if (!personal_pin){
                error = error + "<li>Personal PIN in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-personal_pin").focus();
                return false;
        } 
    }
    
     var official_country = $.trim($("#userprofile-official_country").val());
    if(official_country == 'India'){
        
        /********* Official State **********/      
        var official_state = $.trim($("#userprofile-official_state").val());
        $("#userprofile-official_state").val(official_state);
        if (!official_state){
                error = error + "<li>Official State in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-official_state").focus();
                return false;
        }
        
        /********* Official District **********/      
        var official_district = $.trim($("#userprofile-official_district").val());
        $("#userprofile-official_district").val(official_district);
        if (!official_district){
                error = error + "<li>Official District in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-official_district").focus();
                return false;
        } 
        
         /********* Official City **********/      
        var official_city = $.trim($("#userprofile-official_city").val());
        $("#userprofile-official_city").val(official_city);
        if (!official_city){
                error = error + "<li>Official City in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-official_city").focus();
                return false;
        } 
        
         /********* Official PIN **********/      
        var official_pin = $.trim($("#userprofile-official_pin").val());
        $("#userprofile-official_pin").val(official_pin);
        if (!official_pin){
                error = error + "<li>Official PIN in Address Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-official_pin").focus();
                return false;
        } 
    }    
    
    /*********** Identification Type ***********/
     var id_type = $.trim($("#userprofile-id_type").val());
        $("#userprofile-id_type").val(id_type);
        if (!id_type){
                error = error + "<li>Identification Type Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-id_type").focus();
                return false;
        } 
    
    /*********** Identification Number ***********/
     var id_number = $.trim($("#userprofile-id_number").val());
        $("#userprofile-id_number").val(id_number);
        if (!id_number){
                error = error + "<li>Identification Number Required</li>";
                VISITOR_validatation(error);
                $("#userprofile-id_number").focus();
                return false;
        } 
    /*********** Identification Number ***********/
     var chkid_file = $.trim($("#chkid_file").val());
        $("#chkid_file").val(chkid_file);
        if (!chkid_file){
                error = error + "<li>Upload Identification Proof</li>";
                VISITOR_validatation(error);
                return false;
        } 
      
    var regd_captcha = $.trim($("#regd_captcha").val());
        $("#regd_captcha").val(regd_captcha);
        if (!regd_captcha){
                error = error + "<li>Captcha Required</li>";
                VISITOR_validatation(error);
                 $("#regd_captcha").focus();
                return false;
        } 
    
    
    
    var pwd = $("#userprofile-dpassword").val();
                  
				
    if(pwd != ''){
        ob('userprofile-dpassword');
        $("#password").val($("#userprofile-dpassword").val());
       // $(":password").remove(); 
    }    

     $('#visitor_reg').submit();
    
    
 //   e.preventDefault();
//        $.ajax({
//            type: 'POST',
//            url: 'submit.php',
//            data: new FormData(this),
//            dataType: 'json',
//            contentType: false,
//            cache: false,
//            processData:false,
//            beforeSend: function(){
//                $('.submitBtn').attr("disabled","disabled");
//                $('#fupForm').css("opacity",".5");
//            },
//            success: function(response){ //console.log(response);
//                $('.statusMsg').html('');
//                if(response.status == 1){
//                    $('#fupForm')[0].reset();
//                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
//                }else{
//                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
//                }
//                $('#fupForm').css("opacity","");
//                $(".submitBtn").removeAttr("disabled");
//            }
//        });
    
    
    
    
//     var csrf = $("#_csrf").val();
//       var url = BASEURL + "registration/new";
//        startLoader();
//     var formdata = $('#visitor_reg :input').serialize();
//    alert(formdata);
//    alert(csrf);
//    alert(url);
//        $.ajax({
//            type: "POST",
//            dataType: "json",
//            url: url,
//            data:
//        {
//        formdata: formdata,
//        _csrf: csrf
//        },
//            contentType: false,
//            cache: false,
//            processData:false,
//            success: function(data) {
//            stopLoader();
//           alert("ok");
//            }
//        });
    
});

function $$$(i){
    return document.getElementById(i);
}
    
function ob(i){
    var val=$$$(i).value;
    var encrypted = CryptoJS.AES.encrypt(JSON.stringify(val), secret, {format: CryptoJSAesJson}).toString();
    $$$(i).value=encrypted;  
} 
$(function() {
  $('.row').on('keydown', '.ph', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
});
 $(function () {
      $('.charr').keydown(function (e) {
          if (e.shiftKey || e.ctrlKey || e.altKey) {
              e.preventDefault();
          } else {
              var key = e.keyCode;
              if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                  e.preventDefault();
              }
          }
      });
  });