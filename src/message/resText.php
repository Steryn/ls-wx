<?php
    require_once 'test.php';

    // $result = json_encode($_POST['reply'],JSON_UNESCAPED_UNICODE);
    $result = $_POST['reply'];
    $returnInfo = $response->resText($result);
    echo json_encode($returnInfo);
?>