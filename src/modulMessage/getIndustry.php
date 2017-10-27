<?php
    /****************************************************
    *  获取所属行业
    ****************************************************/
    require_once 'modulApi.php';
    
    $result = json_encode($_POST['getIndustry'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $modul->getIndustry($result);
    echo $returnInfo;