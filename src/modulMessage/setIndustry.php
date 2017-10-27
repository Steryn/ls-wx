<?php
    /****************************************************
    *  设置所属行业
    ****************************************************/
    require_once 'modulApi.php';
    
    $result = json_encode($_POST['setIndustry'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $modul->setIndustry($result);
    echo $returnInfo;