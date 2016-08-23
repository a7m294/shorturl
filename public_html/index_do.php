<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 */

include $_SERVER['DOCUMENT_ROOT'] . '/../config/common.php';

$arr_respone = array();
$code = 0;
$message = '';
try {
    if( empty($post)) {
        throw new Exception('잘못된 접근입니다.', 404);
    }
    switch ($post['do']) {
        case 'make':
            $code = 1;
            $message = P_DOMAIN . '/' . base62_encode($post['url']);
            break;
        default:
            $message = '잘못된 방법입니다.';
            break;
    }
} catch ( Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $message = $e->getCode() . ': ' . $e->getMessage();
} finally {
    $arr_respone = array(
        'code'=>$code,
        'message'=>$message,
    );
    $arr_json = json_encode($arr_respone);
    echo $arr_json;
}

