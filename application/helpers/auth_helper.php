<?php
require_once "requests_helper.php";
/**
 * Created by IntelliJ IDEA.
 * User: hanor
 * Date: 2016/3/26
 * Time: 19:57
 */
class  Auth{
   public   function getopenid($appid,$appsecret,$code){

        Requests::register_autoloader();
        $url= "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";



        $response = Requests::get($url);

        $paramarray=json_decode($response->body);
//       echo $response->body;



       return $paramarray->openid;
     }
}
