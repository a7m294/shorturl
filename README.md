# shorturl
짧은 url 생성 테스트.

* nginx rewrite

```nginxconf
location / {
    rewrite ^/$ /index.php last;
    rewrite ^(.*)$ /shorturl.php?go=$1 last;
    rewrite ^(.*)\.php$ /shorturl.php?go=$1 last;
}
```
