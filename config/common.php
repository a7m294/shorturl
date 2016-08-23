<?php
/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('scream.enabled', true);

defined('P_DOMAIN') or define('P_DOMAIN', 'http://www.goddess9.com');
defined('MYSQL_USER') or define('MYSQL_USER', 'magi_user');
defined('MYSQL_PASS') or define('MYSQL_PASS', 'dhsmfehantkgl^^');
defined('MYSQL_DB') or define('MYSQL_DB', 'magi_db_test');
defined('MYSQL_HOST') or define('MYSQL_HOST', 'localhost');

$get = array();
if( !empty($_GET)) {
    $get = array_trim($_GET);
}
$post = array();
if( !empty($_POST)) {
    $post = array_trim($_POST);
}


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

