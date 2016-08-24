/**
 * short url 생성
 */
CREATE TABLE IF NOT EXISTS `ma_short_url` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` text COMMENT 'url 원본',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록 시간',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2016-08-23 짧은 url';

/**
 * short url 클릭위치, 간단한 기록
 */
CREATE TABLE IF NOT EXISTS `ma_short_url_log` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `su_idx` int(10) unsigned NOT NULL COMMENT 'ma_short_url.idx',
  `ip` VARCHAR(39) NOT NULL DEFAULT '' COMMENT '클릭자 아이피',
  `referer` text COMMENT '유입경로',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록 시간',
  PRIMARY KEY (`idx`),
  KEY (`su_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2016-08-24 짧은 url 클릭시 로그';
