<?php
    require_once 'cardApi.php';

    // 微信卡券：拉取会员卡概况数据接口
    $result = json_encode($_POST['membercardinfo'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxMembercardinfo($result);
    echo json_encode($returnInfo);
    // yes