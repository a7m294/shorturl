<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 * Time: 오후 5:53
 */

include $_SERVER['DOCUMENT_ROOT'] . '/../config/common.php';
$br = "<br>";
$post['url'] = '121312';
$obj = new shorturl();
$message = $obj->base62_encode($post['url']);
echo $message . $br;
$message = P_DOMAIN . '/' . $obj->base62_decode($message);
echo $message . $br;
