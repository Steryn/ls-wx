<?php
    require_once 'cardApi.php';
    
    // 返回二维码url
    $result = json_encode($_POST['qr'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxQrCodeTicket($result);
    echo $returnInfo;
    // yes