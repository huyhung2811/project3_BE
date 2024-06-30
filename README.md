Các bước cài đặt ứng dụng:
1. Cài đặt gói phụ thuộc bằng composer:
composer install

2. Tạo file môi trường(.env)
cp .env.example .env

3. Tạo khóa ứng dụng
php artisan key:generate

4. Thay đổi cấu hình database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Tên database
DB_USERNAME=Tên người dùng
DB_PASSWORD=Mật khẩu người dùng

5. Tạo bảng và seed dữ liệu mẫu:
php artisan migrate --seed

6. Chạy serve:
php artisan serve

