<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 🌍 GIS3R1 – Laravel GIS dengan Leaflet

## 🚀 Pendahuluan
Proyek **GIS3R1** adalah aplikasi **Laravel + Leaflet** untuk visualisasi data GIS.  
Dokumentasi ini menjelaskan langkah-langkah menjalankan aplikasi menggunakan **Docker Compose + Nginx**, baik di **local environment** maupun di **AWS EC2 server**.

---

## 📷 Tampilan Aplikasi
![GIS3R1 Screenshot](https://raw.githubusercontent.com/Zakiab0211/GIS3R1/main/public/hama/webgisa.jpg)

---

## ✅ Prasyarat
Sebelum mulai pastikan:
- Akun **AWS EC2** dengan Ubuntu 22.04 (atau terbaru).
- **Docker** & **Docker Compose** terinstal.
- **Git** terinstal (`sudo apt install git -y`).
- Opsional: **Domain + SSL (Let's Encrypt)**.

---

## 🛠️ Setup di Server EC2

1. **Login ke server**
    ```bash
    ssh -i your-key.pem ubuntu@your-ec2-public-ip
    ```

2. **Update & install dependensi**
    ```bash
    sudo apt update -y && sudo apt upgrade -y
    sudo apt install -y git unzip curl docker.io docker-compose
    sudo systemctl enable docker
    sudo systemctl start docker
    ```

3. **Clone repository**
    ```bash
    git clone https://github.com/Zakiab0211/GIS3R1.git
    cd GIS3R1
    ```

4. **Copy file environment**
    ```bash
    cp .env.example .env
    ```

5. **Edit `.env`**
    ```env
    APP_NAME=LaravelGIS
    APP_ENV=production
    APP_KEY=
    APP_DEBUG=false
    APP_URL=http://your-ec2-public-ip

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=gisdb
    DB_USERNAME=gisuser
    DB_PASSWORD=gispwd
    ```

6. **Setup Docker Compose**  
   Buat file `docker-compose.yml`:
    ```yaml
    version: '3.8'

    services:
      app:
        build:
          context: .
          dockerfile: Dockerfile
        container_name: laravel_app
        restart: unless-stopped
        working_dir: /var/www
        volumes:
          - .:/var/www
        networks:
          - laravel

      db:
        image: mysql:8.0
        container_name: laravel_db
        restart: unless-stopped
        environment:
          MYSQL_DATABASE: gisdb
          MYSQL_USER: gisuser
          MYSQL_PASSWORD: gispwd
          MYSQL_ROOT_PASSWORD: rootpwd
        ports:
          - "3306:3306"
        volumes:
          - db_data:/var/lib/mysql
        networks:
          - laravel

      nginx:
        image: nginx:alpine
        container_name: laravel_nginx
        restart: unless-stopped
        ports:
          - "80:80"
        volumes:
          - .:/var/www
          - ./docker-compose/nginx:/etc/nginx/conf.d
        depends_on:
          - app
        networks:
          - laravel

    volumes:
      db_data:

    networks:
      laravel:
        driver: bridge
    ```

7. **Konfigurasi Nginx**  
   File: `docker-compose/nginx/default.conf`
    ```nginx
    server {
        listen 80;
        index index.php index.html;
        server_name _;

        root /var/www/public;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            fastcgi_pass app:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~ /\.ht {
            deny all;
        }
    }
    ```

8. **Buat `Dockerfile` Laravel**
    ```dockerfile
    FROM php:8.2-fpm

    # Install dependencies
    RUN apt-get update && apt-get install -y \
        git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
        && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

    # Install Composer
    COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

    WORKDIR /var/www
    COPY . .

    RUN composer install --no-dev --optimize-autoloader
    RUN php artisan config:clear && php artisan route:clear && php artisan cache:clear

    CMD ["php-fpm"]
    ```

9. **Menjalankan Aplikasi**
    ```bash
    docker-compose up -d --build
    docker ps
    ```

10. **Inisialisasi Laravel**
    ```bash
    docker exec -it laravel_app bash
    php artisan key:generate
    php artisan migrate --seed
    exit
    ```

11. **Uji akses aplikasi**
    - Local: http://localhost  
    - EC2: http://your-ec2-public-ip  
    - Domain: arahkan DNS ke EC2 dan sesuaikan `APP_URL` di `.env`.

12. **(Opsional) Tambah SSL**
    ```bash
    sudo apt install certbot python3-certbot-nginx -y
    sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
    ```

13. **⚙️ Setting Database di Docker**
## ⚙️ Setting Database di Docker
**Jika terjadi error koneksi database (SQLSTATE[HY000] [1044] Access denied), biasanya karena konfigurasi user & database tidak sinkron antara file .env dan docker-compose.yml.**

1. **Pastikan konfigurasi .env sudah benar**
    ```env
    DB_CONNECTION=mysql
    DB_HOST=gis-mysql
    DB_PORT=3306
    DB_DATABASE=giseri
    DB_USERNAME=rootnow
    DB_PASSWORD=rootnow
    ```
    
2. **Cek & beri hak akses user di MySQL container**
    ```bash
    docker exec -it gis-mysql bash
    mysql -u root -p
    ```

    **Lalu di MySQL:**

    **SHOW GRANTS FOR 'rootnow'@'%';**
    **GRANT ALL PRIVILEGES ON giseri.* TO 'rootnow'@'%';**
    **FLUSH PRIVILEGES;**

3. **Import file SQL (jika ada data awal)**
    ```bash
    docker cp /home/ubuntu/GIS3R1/giseri.sql gis-mysql:/giseri.sql
    docker exec -it gis-mysql bash
    mysql -u rootnow -p giseri < /giseri.sql
    ```

4. **Cek status MySQL container**
    ```bash
    docker-compose logs db
    ```

5. **Restart docker-compose setelah perubahan**
    ```bash
    sudo docker-compose down
    sudo docker-compose up -d --build
    ```