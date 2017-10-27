<?php
    /****************************************************
    *  删除模板
    ****************************************************/
    require_once 'modulApi.php';
    
    $result = json_encode($_POST['delTemplate'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $modul->delTemplate($result);
    echo $returnInfo;