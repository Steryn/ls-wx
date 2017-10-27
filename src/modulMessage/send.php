<?php
    /****************************************************
    *  发送模板消息
    ****************************************************/
    require_once 'modulApi.php';
    
    // $result = json_encode($_POST['send'],JSON_UNESCAPED_UNICODE);
    // $returnInfo = $modul->send($result);
    // echo $returnInfo;

    $result = $_POST['send'];
    $userOpenList = $_POST['touser'];

    foreach ($userOpenList as $item){
        // echo $item;
        $result['touser'] = $item;
        $returnInfo = $modul->send(json_encode($result));
        echo $returnInfo;
    };
