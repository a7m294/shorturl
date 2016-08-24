<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 * 
 * short url 을 생성시키서 사용자에게 보여주는 페이지
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
            $obj = new shorturl();
            $returnurl = $obj->do_make($post['url']);
            $error = $obj->error();
            if( isset($error['code']) && $error['code'] > 0) {
                throw new Exception($error['message'], $error['code']);
            }
            unset($obj);
            $code = 1;
            $message = $returnurl;
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

