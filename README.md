# php shorturl
짧은 url 생성 테스트,
git 연습용으로 개발

## 서버환경
#### server
CentOS release 6.8 (Final)

#### php
PHP 5.6.24 (cli)

#### mysql
10.1.16-MariaDB
```sql
# mysql.sql 참고
CREATE TABLE IF NOT EXISTS `ma_short_url` (
  ......
);
CREATE TABLE IF NOT EXISTS `ma_short_url_log` (
  ......
);
# select log
select u.*, l.* 
from ma_short_url_log as l
inner join ma_short_url as u on l.su_idx = u.idx
where l.su_idx_hash = '2a';
```

#### nginx rewrite
nginx/1.10.1
```nginxconf
root   /home/[your user]/[project name]/shorturl/public_html;

location / {
    rewrite ^/$ /index.php last;
    rewrite ^(.*)$ /shorturl.php?go=$1 last;
    rewrite ^(.*)\.php$ /shorturl.php?go=$1 last;
}
```

#### demo
http://www.goddess9.com/

## License
[MIT License](https://opensource.org/licenses/MIT).

## 연습시 참고사항
github markdown languages.yml
https://github.com/github/linguist/blob/master/lib/linguist/languages.yml