<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 * 공통호출파일
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('scream.enabled', true);

//공통설정
defined('P_DOMAIN') or define('P_DOMAIN', 'http://' . $_SERVER['HTTP_HOST']);
defined('P_DOCUMENT_ROOT') or define('P_DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/..');
defined('P_MYSQL_USER') or define('P_MYSQL_USER', 'magi_user');
defined('P_MYSQL_PASS') or define('P_MYSQL_PASS', 'dhsmfehantkgl^^');
defined('P_MYSQL_DB') or define('P_MYSQL_DB', 'magi_db_test');
defined('P_MYSQL_HOST') or define('P_MYSQL_HOST', 'localhost');

//공통호출
include P_DOCUMENT_ROOT . '/config/shorturl.php';

//공통변수
$get = array();
if( !empty($_GET)) {
    $get = array_trim($_GET);
}
$post = array();
if( !empty($_POST)) {
    $post = array_trim($_POST);
}

//공통함수
/**
 * 배열의 모든 vales 를 trim 처리
 * @param array $arr
 * @return array|null|string
 */
function array_trim($arr=array())
{
    $return = $arr;
    if( empty($arr)) return null;
    if( !is_array($arr)) return trim($return);
    foreach($arr as $k=> $v) {
        if( is_array($v)) {
            $return[$k] = array_trim($v);
            continue;
        }
        $return[$k] = trim($v);
    }
    return $return;
}

function print_r2($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}