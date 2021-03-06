<?php
/**
 * Created by PhpStorm.
 * User: yyq
 * Date: 2016-07-20
 * Time: 11:49
 */
Class Notlogin extends CI_Controller{
    public function index()
    {
        $this->load->library('session');
        $openid=$this->session->userdata('openid');
        if($openid==null){//openid 为空
            $code =$this->input->get("code");
            if($code==""){
                $authurl= "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx33d5ca90782fb6b7&redirect_uri=http://www.vkaifu.com/points/notlogin/&response_type=code&scope=snsapi_userinfo&state=cashier_register#wechat_redirect";
                header("Location:".$authurl);
            }else{
                $this->load->helper("auth");
                $auth=new Auth();
                $openid= $auth->getopenid($this->config->item('appid'),$this->config->item('appsecret'),$code);
                if($openid==""){
                    show_error("获取openid失败");
                }else{
                    $this->session->set_userdata("openid",$openid);
                }
                $data['openid']=$openid;
            }
        }else{
            $data['openid']=$openid;
        }
        log_message("info",$openid."为这个。");
        if ($openid!=null){
            $this->load->helper("tools");
            $tools=new Tools();
            $url="http://".$this->config->item('serverip')."/notlogin?openid=".$openid;
            log_message("info",$url."url地址为这个。");
            $loginresult=$tools->httpget($url);
            log_message("info",$loginresult."登录结果为这个。");
            header('Location:'.$loginresult);
        }else{
            echo "暂无积分，请联系微开科技管理人员";
        }

    }
}