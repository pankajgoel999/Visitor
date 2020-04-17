$(document).ready(function()
{   
	$( ".boaction" ).change(function() 
	{
		var actionval=$(this).val();
		if(actionval=="RE")
		{
		}
	});
	$("#dcontactno,#nodalno").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        swal({
            text: "Only Numbers are allowed",
            icon: "error",
           // button: "Close",
        });
        return false;
    }
    });
	$("#dname,#address,#nodalname,#rolename").keypress(function(event)
	{
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) 
		{ 
            swal({
            text: "Only Alphabets are allowed",
            icon: "error",
           // button: "Close",
        });
        return false;
        }
    });
	$("#is_active_yes").click(function(){
        $('#is_active_roles').val('Y');
        $('#is_active_yes').removeClass('btn-primary');
        $('#is_active_yes').addClass('btn-success');
        $('#is_active_no').removeClass('btn-primary btn-success');
        $('#is_active_no').addClass('btn-primary');
    });
    $("#is_active_no").click(function(){
        $('#is_active_roles').val('N');
        $('#is_active_no').removeClass('btn-primary');
        $('#is_active_no').addClass('btn-success');
        $('#is_active_yes').removeClass('btn-primary btn-success');
        $('#is_active_yes').addClass('btn-primary');
    });
});
function showChkState()
{
alert("asd");
}
function IsEmail(email) 
{
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
function departmentRoles()
{
var rolename=$("#rolename").val();
var is_active_roles=$("#is_active_roles").val();

if(!rolename)
{
	swal("Please enter Department Role!", "", "error");
	return false;
}
if(!is_active_roles)
{
	swal("Please Select is active field!", "", "error");
	return false;
}

$("#deptroles").submit();
}
function departmentReg()
{
var deptname=$("#dname").val();
var demail=$("#demail").val();
var dcontactno=$("#dcontactno").val();
var address=$("#address").val();
var nodalname=$("#nodalname").val();
var nodalemail=$("#nodalemail").val();
var nodalno=$("#nodalno").val();
var roles=$("#roles").val();
var pass=$("#password").val();
if(!deptname)
{
	swal("Please enter Department Name!", "", "error");
	return false;
}
if(!demail)
{
	swal("Please enter Department Email!", "", "error");
	return false;
}
if(IsEmail(demail)==false)
{
	swal("Please enter valid Email!", "", "error");
	return false;
}
if(!dcontactno)
{
	swal("Please enter Department Contact Number", "", "error");
	return false;
}
if(!address)
{
	swal("Please enter Department Address", "", "error");
	return false;
}
if(!nodalname)
{
	swal("Please enter Officer Name", "", "error");
	return false;
}
if(!nodalemail)
{
	swal("Please enter Department Email!", "", "error");
	return false;
}
if(IsEmail(nodalemail)==false)
{
	swal("Please enter valid Email!", "", "error");
	return false;
}
if(!nodalno)
{
	swal("Please enter Officer Contact Number", "", "error");
	return false;
}
if(!roles)
{
	swal("Please Select Department for which you want to create user", "", "error");
	return false;
}	
if(!pass)
{
	swal("Please enter Password", "", "error");
	return false;
}
$("#deptreg").submit();
}