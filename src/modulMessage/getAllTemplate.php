<?php
    /****************************************************
    *  获取模板列表
    ****************************************************/
    require_once 'modulApi.php';
    
    // $result = json_encode($_POST['getAllTemplate'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $modul->getAllTemplate();
    echo $returnInfo;