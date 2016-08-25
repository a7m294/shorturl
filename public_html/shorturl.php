<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 * 
 * 생선된 short url 을 찾아서 이동시키는 페이지
 */

include $_SERVER['DOCUMENT_ROOT'] . '/../config/common.php';

$code = 0;
$message = '';
try {
    if( empty($get['go'])) {
        throw new Exception('잘못된 접근입니다.', 404);
    }

    $obj = new shorturl();
    $returnurl = $obj->do_go($get['go']);
    $error = $obj->error();
    if( isset($error['code']) && $error['code'] > 0) {
        throw new Exception($error['message'], $error['code']);
    }
    unset($obj);

    if( empty(($returnurl))) {
        throw new Exception('생성하지 않은 short url 입니다.', 404);
    }
    $code = 1;
    $message = $returnurl;
} catch ( Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $message = $e->getCode() . ': ' . $e->getMessage();
    //header("HTTP/1.1 302 Moved Temporarily");
    header("HTTP/1.1 301 Moved Permanently");
    Header("Location: " . P_DOMAIN);
    exit;
} finally {
    header("HTTP/1.1 302 Moved Temporarily");
    Header("Location: " . $message);
}
