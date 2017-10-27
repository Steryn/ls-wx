<?php
    $data = array(
        "DLRcode" => "12345",
        "openid" => "AbcdEfgHijklmn",
        "name" => "张三",
        "carModel" => "卡罗拉",
        "tel" => "13212341234",
        "archiveId"=>"archive_1"
    );
    // $data2 = array(
    //     "public_key"=>$public_key,
    //     "secret_key"=>$secret_key,
    //     "visitor"=>$visitor,
    //     "timestamp"=>$timestamp
    // );
    $url = 'http://ftms-wechat.bjscfl.com/index.php?g=Interface&m=Usershare&a=addMsgGw';
    $result = wxHttpsRequest($url,$data);
    print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
    function wxHttpsRequest($url,$data = null){
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
?>