<?php
    /****************************************************
    *  上传图片接口
    ****************************************************/
    require_once 'massApi.php';

    $data = $_POST['data'];
    $type = $_POST['type'];
    $returnInfo = $mass->upload($data,$type);
    echo $returnInfo;