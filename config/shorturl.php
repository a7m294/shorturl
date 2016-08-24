<?php

/**
 * Created by PhpStorm.
 * User: magi
 * Date: 2016-08-23
 */
class shorturl
{
    /**
     * @var PDO mysql connection
     */

    var $dbconn;
    /**
     * @var array 에러결과 내부적으로 저장
     */
    var $error;

    /**
     * @var array 생성시 허용할 프로트콜
     */
    var $arr_allow_protocols = [
        'http', 'https'
    ];
    /**
     * shorturl constructor.
     */
    function __construct()
    {
        try {
            $this->dbconn = new PDO('mysql:host=' . P_MYSQL_HOST . ';dbname=' . P_MYSQL_DB, P_MYSQL_USER, P_MYSQL_PASS);
        } catch (PDOException $e) {
            print_r2($e->getMessage());
            $this->_set_message([
                'code'=>50001,
                'message'=>'[mysql]' . $e->getCode() . ':' . $e->getMessage(),
            ]);
        }
    }
    function __destruct()
    {
        $this->dbconn = null;
    }

    /**
     * short url 만들기
     * url 을 받아서 short url 값을 리턴
     * @param $url
     * @return bool|string
     */
    public function do_make($url) {
        if( isset($this->error['code']) && $this->error['code'] > 0) {
            return false;
        }
        if( empty($url)) {
            $this->_set_message([
                'code'=>40001,
                'message'=>'[error]' . ': url 이 존재하지 않습니다.',
            ]);
            return null;
        }
        $tmp = parse_url($url, PHP_URL_SCHEME);
        if( $tmp === null) {
            $this->_set_message([
                'code'=>40002,
                'message'=>'[error]' . ': 정상적인 url 이 아닙니다.',
            ]);
            return null;
        }
        if( !in_array($tmp, $this->arr_allow_protocols)) {
            $this->_set_message([
                'code'=>40003,
                'message'=>'[error]' . ': http://, https:// 로 시작해야 합니다.',
            ]);
            return null;
        }
        $tmp = filter_var($url, FILTER_VALIDATE_URL);
        if( $tmp === null) {
            $this->_set_message([
                'code'=>40012,
                'message'=>'[error]' . ': 정상적인 url 이 아닙니다.',
            ]);
            return null;
        }

        //idx
        $sql = 'INSERT INTO `ma_short_url` (`url`) VALUES (:URL)';
        $sth = $this->dbconn->prepare($sql);
        $sth->bindParam(':URL', $url, PDO::PARAM_STR);
        $sth->execute();
        $arr = $sth->errorInfo();
        if( isset($arr[1])) {
            $this->_set_message([
                'code'=>5002,
                'message'=>'[mysql]' . $arr[1] . ':' . $arr[2],
            ]);
            return false;
        }
        $lastId = $this->dbconn->lastInsertId();

        //short url
        $hash = $this->base62_encode($lastId);
        $returnurl = P_DOMAIN . '/' . $hash;

        return $returnurl;
    }
    public function do_go($url_hash) {
        if( isset($this->error['code']) && $this->error['code'] > 0) {
            return false;
        }

        $arr = parse_url($url_hash);
        parse_str($arr['path'], $tmp);
        $tmp = substr($arr['path'], 1);
        $idx = $this->base62_decode($tmp);

        $sql = 'SELECT `url` FROM `ma_short_url` WHERE `idx` = :IDX';
        $sth = $this->dbconn->prepare($sql);
        $sth->bindParam(':IDX', $idx, PDO::PARAM_INT);
        $sth->execute();
        $arr = $sth->errorInfo();
        if( isset($arr[1])) {
            $this->_set_message([
                'code'=>5003,
                'message'=>'[mysql]' . $arr[1] . ':' . $arr[2],
            ]);
            return false;
        }
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        return $row['url'];
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
            if( !isset($arr[$str[$i]])) break;
            $val += $arr[$str[$i]] * pow($base, $len-$i-1);
        }
        return $val;
    }
    private function _set_message($arr=[]) {
        $this->error = [
            'code'=>$arr['code'],
            'message'=>$arr['message'],
        ];
    }
    public function error() {
        return $this->error;
    }
}