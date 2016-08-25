# shorturl
짧은 url 생성 테스트,
phpstrom + git 테스트용이기 때문에 모듈화는 차후

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
MIT license

## 연습시 참고사항
github markdown languages.yml
https://github.com/github/linguist/blob/master/lib/linguist/languages.yml