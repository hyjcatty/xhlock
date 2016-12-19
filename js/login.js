
//var request_head= ".request";
//var jump_url = ".jump";
var basic_address = getRelativeURL()+"/";
var request_head= basic_address+"request.php";
var jump_url = basic_address+"jump.php";
var winHeight=800;
var winWidth=800;
var logoHeight=100;
var headHeight=100;
function getsec(str)
{
    var str1=Number(str.substring(1,str.length));
    var str2=str.substring(0,1);
    if (str2=="s")
    {
        return str1*1000;
    }
    else if (str2=="m")
    {
        return str1*60*1000;
    }
    else if (str2=="h")
    {
        return str1*60*60*1000;
    }
    else if (str2=="d")
    {
        return str1*24*60*60*1000;
    }
}
function setCookie(name,value,time)
{
    var strsec = getsec(time);
    var exp = new Date();
    var expires = exp.getTime() + Number(strsec);
    exp.setTime(exp.getTime() + Number(strsec));
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	arr=document.cookie.match(reg);
    if(arr=== true)
        return unescape(arr[2]);
    else
        return null;
}
function jump(str){
    log("try to dump to session "+window.location.host+jump_url+"?session"+str);
    window.location="http://"+window.location.host+jump_url+"?session="+str;
}
$(document).ready(function() {
    get_size();

    var basic_min_height = parseInt(($(".leaderboard").css("padding-top")).replace(/[^0-9]/ig,""));
    if((window.screen.availHeight -600)/2>basic_min_height) basic_min_height = (window.screen.availHeight -600)/2;
    $(".leaderboard").css("padding-top",basic_min_height+"px");
    console.log( $(".leaderboard").css("padding-top"));
    $("#Login_Comfirm").on('click',function(){

        setCookie("Environmental.inspection.usrname",$("#Username_Input").val(),"d30");
        var map={
            action:"login",
            name:$("#Username_Input").val(),
            password:b64_sha1($("#Password_Input").val())
        };
        var callback=function(result){
            if(result.status!="true"){
                $("#UserAlertModalLabel").text = "警告";
                $("#UserAlertModalContent").empty();
                $("#UserAlertModalContent").append("<strong>警告！</strong>"+result.msg);
                modal_middle($('#UserAlarm'));
                $('#UserAlarm').modal('show') ;
            }else{
                setCookie("Environmental.inspection.session",result.ret.key,"m10");
                jump(result.ret.key);
            }
        };
        JQ_get(request_head,map,callback);



        /*
        jQuery.get(request_head, map, function (data) {
            var result=JSON.parse(data);
            if(result.status!="true"){
                $("#UserAlertModalLabel").text = "警告";
                $("#UserAlertModalContent").empty();
                $("#UserAlertModalContent").append("<strong>警告！</strong>"+result.text);
                modal_middle($('#UserAlarm'));
                $('#UserAlarm').modal('show') ;
            }else{
                setCookie("Environmental.inspection.session",result.key,"m10");
                jump(result.key);
            }

        });*/

    });
});

window.onload = function(){
    $("[data-toggle='modal']").click(function(){
        var _target = $(this).attr('data-target');
        t=setTimeout(function () {
            var _modal = $(_target).find(".modal-dialog");
            _modal.animate({'margin-top': parseInt(($(window).height() - _modal.height())/2)}, 300 );
        },200);
    });
    var usrname = getCookie("Environmental.inspection.usrname");
    if(null!==usrname) $("#Username_Input").val(usrname);

    var session = getCookie("Environmental.inspection.session");
    log("check cookie: username["+usrname+"]session["+session+"]");
    if(null!==session&&session.length>0){
        jump(session);

    }
};

function modal_middle(modal){
    setTimeout(function () {
        var _modal = $(modal).find(".modal-dialog");
        _modal.animate({'margin-top': parseInt(($(window).height() - _modal.height())/2)}, 300 );
    },200);
}

function get_size(){
    if (window.innerWidth)
        winWidth = window.innerWidth;
    else if ((document.body) && (document.body.clientWidth))
        winWidth = document.body.clientWidth;
    if (window.innerHeight)
        winHeight = window.innerHeight;
    else if ((document.body) && (document.body.clientHeight))
        winHeight = document.body.clientHeight;
    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
    {
        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;
    }
    console.log("winWidth = "+winWidth);
    console.log("winHeight= "+winHeight);
    var tempheight = winHeight;
    if(winHeight>winWidth) tempheight = winWidth;
    logoHeight=parseInt(tempheight/5);
    headHeight=parseInt(tempheight/5);
    $("#logo").css("height",logoHeight);
    $("#webhead").css("height",logoHeight);
    $("body").css("height",winHeight);
    var module_height = parseInt((winHeight-180)/2)-64;
    $("#kuang").css("margin-top",module_height);
    if(winHeight>winWidth){
        $("#webhead").css("margin-top",logoHeight);
    }

}
function JQ_get(url,request,callback){
    jQuery.get(url, request, function (data) {
        log(data);
        var result=JSON.parse(data);
        callback(result);
    });
}