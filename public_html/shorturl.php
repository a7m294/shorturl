<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 */

include $_SERVER['DOCUMENT_ROOT'] . '/../config/common.php';

try {
    if( empty($get['go'])) {
        throw new Exception('잘못된 접근입니다.', 404);
    }

    $request = base62_decode($get['go']);
    echo $request;
} catch ( Exception $e) {

} finally {

}





