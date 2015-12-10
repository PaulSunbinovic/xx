<?php
/*
本文件位置
$redirect_url= "http://israel.duapp.com/weixin/oauth2_openid.php";

URL
https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx08c69e5ad5cc1a5e&redirect_uri=http://192.168.1.103/wxcs/oauth2_openid.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect
*/
$code = $_GET["code"];
$state=$_GET['state'];
$tmp=explode('WXWC', $state);
$appid=$tmp[0];
$appsecret=$tmp[1];
$userinfo = getUserInfo($code,$appid,$appsecret);
session_start();//session开始后 之前的$X都无效了
$arrall=array();

$mo['wxusropid']=$userinfo['openid'];
$mo['wxusrnm']=$userinfo['nickname'];
//if($userinfo['sex']==1){$mo['wxsex']='男';}else{$mo['wxsex']='女';}
//$mo['wxct']=$userinfo['city'];
$mo['wxusrpt']=$userinfo['headimgurl'];
//echo $uinfo['uopenid'];die;
//print_r($uinfo);die;
//session_unset("uinfo");//


$_SESSION["wxusross"]=$mo;//echo 111;die;

//print_r(111);die;
header("location: wap.php");



function getUserInfo($code,$appid,$appsecret)
{
// 	$appid = "wx08c69e5ad5cc1a5e";
// 	$appsecret = "95c2d97c3557a65b5f6f7e962b363256";

    //oauth2的方式获得openid
	$access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
	$access_token_json = https_request($access_token_url);
	$access_token_array = json_decode($access_token_json, true);
	$openid = $access_token_array['openid'];

    //非oauth2的方式获得全局access token
    $new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    $new_access_token_json = https_request($new_access_token_url);
	$new_access_token_array = json_decode($new_access_token_json, true);
	$new_access_token = $new_access_token_array['access_token'];
	
    //全局access token获得用户基本信息
    $userinfo_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$new_access_token&openid=$openid";
	$userinfo_json = https_request($userinfo_url);
	$userinfo_array = json_decode($userinfo_json, true);
	return $userinfo_array;
}

function https_request($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
	curl_close($curl);
	return $data;
}
?>
