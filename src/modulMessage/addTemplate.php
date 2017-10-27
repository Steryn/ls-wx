<?php
    /****************************************************
    *  获得模板ID
    ****************************************************/
    require_once 'modulApi.php';
    
    $result = json_encode($_POST['addTemplate'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $modul->addTemplate($result);
    echo $returnInfo;