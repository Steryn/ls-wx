<?php
    require_once 'cardApi.php';

    // 获取免费券数据接口
    $result = json_encode($_POST['getcardcardinfo'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxGetcardcardinfo($result);
    echo json_encode($returnInfo);
    // yes