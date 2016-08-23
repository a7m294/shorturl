# shorturl
짧은 url 생성 테스트.


* mysql(maridb 10.1)

* nginx rewrite

```
location / {
    rewrite ^/$ /index.php last;
    rewrite ^(.*)$ /shorturl.php?go=$1 last;
    rewrite ^(.*)\.php$ /shorturl.php?go=$1 last;
}
```
