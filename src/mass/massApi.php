<?php
    /****************************************************
    *  此文件为群发信息接口文件
    ****************************************************/
    //测试号
$mass = new massApi("wx5028eeb568c7544f","fb9f7edf8138dd07b54ae7e3b0a43599");
    //订阅号
// $mass = new massApi("wx041a6b53a3441187","43a10506b0c1f32023e448a59c715ad0");
    // 公司账号
// $mass = new massApi("wxbbd0d3f092cc62cb","2d40bad5eec79db11d2650e7a539f639");

class massApi{
    
    private $APPID;
    private $APPSECRET;

    public function __construct($APPID, $APPSECRET) {
        $this->APPID = $APPID;
        $this->APPSECRET = $APPSECRET;
    }

    /****************************************************
    *  上传图片接口
    ****************************************************/
    public function upload($data,$type){
        $filedata = array("media" =>"@".dirname(dirname(__FILE__)).$data);
        $AccessToken = $this->getAccessToken();
        $url="http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$AccessToken."&type=".$type;
        $info = self::wxHttpsRequest($url,$filedata);
        return $info;
    }

    /****************************************************
    *  上传图文消息素材【订阅号与服务号认证后均可用】
    *  1.Articles thumb_media_id title content
    *  2.author  content_source_url  digest  show_cover_pic
    ****************************************************/
    public function uploadnews($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".$AccessToken;
        // https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获取素材总数
    ****************************************************/
    public function getMaterialCount($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  获取素材总数
    *  1.type  offset  count
    ****************************************************/
    public function batchgetMaterial($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  创建分组【订阅号与服务号认证后均可用】
    *  1.name  	分组名字（30个字符以内）
    ****************************************************/
    public function groupCreat($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/create?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  查询所有分组
    *  1.access_token
    ****************************************************/
    public function groupGet($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/get?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  修改分组名
    *  1.access_token id name 分组名字（30个字符以内）
    ****************************************************/
    public function groupUpdata($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/update?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  查询用户所在分组
    *  1.access_token openid
    ****************************************************/
    public function groupGetId($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  移动用户分组
    *  1.access_token openid to_groupid  分组id
    ****************************************************/
    public function groupMember($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  批量移动用户分组接口
    *  1.access_token openid to_groupid  分组id
    ****************************************************/
    public function groupBatchupdate($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  删除分组接口
    *  1.access_token openid to_groupid  分组id
    ****************************************************/
    public function groupDelete($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/groups/delete?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  根据分组进行群发【订阅号与服务号认证后均可用】
    *  1.filter  mpnew s media_id  msgtype  thumb_media_id
    *  2.is_to_all  group_id  title  description
    ****************************************************/
    public function groupMass($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  根据OpenID列表群发【订阅号不可用，服务号认证后可用】
    *  1.touser  mpnews  media_id  msgtype  thumb_media_id
    *  2.title  description
    ****************************************************/
    public function groupMassOpenId($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  删除群发【群发只有在刚发出的半小时内可以删除】
    *  1.touser  mpnews  media_id  msgtype  thumb_media_id
    *  2.title  description
    ****************************************************/
    public function deleteMass($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com//cgi-bin/message/mass/delete?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }

    /****************************************************
    *  预览接口【每日调用次数有限制 100次】
    *  1.touser  media_id  msgtype content
    ****************************************************/
    public function massPreview($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=".$AccessToken;
        $info = self::wxHttpsRequest($url,$data);
        return $info;
    }
    
    /****************************************************
    *  查询群发消息发送状态【订阅号与服务号认证后均可用】
    *  1.msg_id
    ****************************************************/
    public function massGet($data){
        $AccessToken=$this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=".$AccessToken;
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