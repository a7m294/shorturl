<?php

/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 */
class shorturl
{
    public function do_make() {

    }
    public function do_go() {

    }
    /**
     * http://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=tipntech&wr_id=79695
     * @param $val
     * @param int $base
     * @param string $chars
     * @return string
     */
    public function base62_encode($val, $base=62, $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        // can't handle numbers larger than 2^31-1 = 2147483647
        $str = '';
        do {
            $i = $val % $base;
            $str = $chars[$i] . $str;
            $val = ($val - $i) / $base;
        } while($val > 0);
        return $str;
    }
    /**
     * http://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=tipntech&wr_id=79695
     * @param $str
     * @param int $base
     * @param string $chars
     * @return int
     */
    public function base62_decode($str, $base=62, $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $len = strlen($str);
        $val = 0;
        $arr = array_flip(str_split($chars));
        for($i = 0; $i < $len; ++$i) {
            $val += $arr[$str[$i]] * pow($base, $len-$i-1);
        }
        return $val;
    }
}