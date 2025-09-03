# お問い合わせフォーム

## 環境構築
#### Dockerの起動
1. git clone git@github.com:ainyan4645/contact-form__test.git
2. cd contact-form__test
3. docker-compose up -d --build

#### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. exit
4. cd src
5. cp .env.example .env
6. docker-compose exec php bash
7. php artisan key:generate
8. composer require laravel/fortify
9. php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"


- migrationとシーディングは後で。
- 時刻のずれは大丈夫？
 ```
 php artisan tinker
 echo Carbon\Carbon::now();
```

 ※permissionエラーが出る場合は `/contact-form__test` ディレクトリで以下のコマンドを実行してください。
 ```bash
 sudo chmod -R 777 src/*
 ```

## 使用技術(実行環境)
- php 8.2
- Laravel 8.0
- MySQL 8.0
- nginx 1.24

## ER図


## URL
- 開発環境： http://localhost/
- phpMyAdmin： http://localhost:8080/

