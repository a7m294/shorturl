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
 * INT 4294967295: 4GFfc3
 * BIGINT 18446744073709551615: lYGhA16ahq0
 */
CREATE TABLE IF NOT EXISTS `ma_short_url_log` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `su_idx` int(10) unsigned NOT NULL COMMENT 'ma_short_url.idx fk',
  `su_idx_hash` VARCHAR(6) NOT NULL DEFAULT '' COMMENT 'su_idx 의 해쉬값',
  `ip` VARCHAR(39) NOT NULL DEFAULT '' COMMENT '클릭자 아이피',
  `referer` text COMMENT '유입경로',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록 시간',
  PRIMARY KEY (`idx`),
  KEY `ik_su_idx`(`su_idx`),
  KEY `ik_su_idx_hash`(`su_idx_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2016-08-24 짧은 url 클릭시 로그';

