<?php
    /****************************************************
    *  预览接口【每日调用次数有限制 100次】
    ****************************************************/
    require_once 'massApi.php';
    
    $result = json_encode($_POST['massPreview'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->massPreview($result);
    echo $returnInfo;