CREATE TABLE ma_short_url {
  `idx` int(10) unsigned NOT NULL auto_increment,
  `datetime` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`idx`),
  KEY `ik_datetime` (`datetime`)
} ENGINE=InnoDB COMMENT='2016-08-23 짧은 url';