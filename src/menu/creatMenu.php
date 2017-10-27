<?php
    require_once 'backmessage.php';
    
    $result = json_encode($_POST['creatMenu'],JSON_UNESCAPED_UNICODE);
    // echo $result;
    $returnInfo = $weixin->creatMenu($result);
    echo $returnInfo;