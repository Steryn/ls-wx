<?php
    /****************************************************
    *  此文件为群发信息接口文件
    ****************************************************/
// $custom = new customApi("wx5028eeb568c7544f","fb9f7edf8138dd07b54ae7e3b0a43599");
$custom = new customApi("wxbbd0d3f092cc62cb","2d40bad5eec79db11d2650e7a539f639");

class customApi{
    
    private $APPID;
    private $APPSECRET;

    public function __construct($APPID, $APPSECRET) {
        $this->APPID = $APPID;
        $this->APPSECRET = $APPSECRET;
    }

    /****************************************************
    *  添加客服帐号
    ****************************************************/
    public function kfaccountAdd($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/customservice/kfaccount/add?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  修改客服帐号
    ****************************************************/
    public function kfaccountUpdate($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/customservice/kfaccount/update?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  删除客服帐号
    ****************************************************/
    public function kfaccountDel($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/customservice/kfaccount/del?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获取所有客服账号
    ****************************************************/
    public function getkfList($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }
    
    /****************************************************
    *  客服接口-发消息
    ****************************************************/
    public function customSend($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获取at
    ****************************************************/
    private function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("../access_token.php"));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->APPID&secret=$this->APPSECRET";
            $res = json_decode($this->wxHttpsRequest($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $this->set_php_file("../access_token.php", json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        // echo $access_token;
        return $access_token;
    }
    public function wxHttpsRequest($url,$data = null){
        // echo $data;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }
    private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
}

?>