<?php
    /****************************************************
    *  此文件为模板接口文件
    *  文档地址
    *  https://mp.weixin.qq.com/wiki/17/304c1885ea66dbedf7dc170d84999a9d.html
    ****************************************************/
    //测试号
$modul = new modulApi("wx5028eeb568c7544f","fb9f7edf8138dd07b54ae7e3b0a43599");
    //订阅号
// $modul = new modulApi("wx041a6b53a3441187","43a10506b0c1f32023e448a59c715ad0");
    // 公司账号
// $modul = new modulApi("wxbbd0d3f092cc62cb","2d40bad5eec79db11d2650e7a539f639");

class modulApi{
    private $APPID;
    private $APPSECRET;

    public function __construct($APPID, $APPSECRET) {
        $this->APPID = $APPID;
        $this->APPSECRET = $APPSECRET;
    }

    /****************************************************
    *  设置所属行业
    *  1.industry_id1 2.industry_id2
    ****************************************************/
    public function setIndustry($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获取设置的行业信息
    *  1.primary_industry 2.secondary_industry
    ****************************************************/
    public function getIndustry($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获得模板ID
    *  1.template_id_short
    ****************************************************/
    public function addTemplate($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获取模板列表
    *  1.template_id_short
    ****************************************************/
    public function getAllTemplate($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  删除模板
    *  1.template_id
    ****************************************************/
    public function delTemplate($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  发送模板消息
    *  1.industry_id1 2.industry_id2
    ****************************************************/
    public function send($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$AccessToken;
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
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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