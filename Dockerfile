# 1. Sử dụng Image "thần thánh" đã có sẵn Nginx và PHP-FPM tối ưu cho Laravel
FROM richarvey/nginx-php-fpm:3.1.6

# 2. Copy toàn bộ code của bạn vào trong Image
COPY . .

# 3. Cấu hình biến môi trường cần thiết cho Image này
# WEBROOT: Trỏ vào thư mục public của Laravel
ENV WEBROOT /var/www/html/public
# Hiển thị lỗi ra log của Render
ENV PHP_ERRORS_STDERR 1
# Cho phép Composer chạy dưới quyền root
ENV COMPOSER_ALLOW_SUPERUSER 1
# Tắt chế độ cài đặt tự động của Image (để mình tự chạy lệnh cài bên dưới cho chắc)
ENV SKIP_COMPOSER 0

# 4. Cài đặt các gói thư viện PHP (Vendor)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 5. Cài đặt NodeJs & NPM để build giao diện (Vite)
# (Vì Image này dùng Alpine Linux nên dùng lệnh apk)
RUN apk add --no-cache nodejs npm
RUN npm install && npm run build

# 6. Cấp quyền cho thư mục storage (để Laravel ghi được log và cache)
RUN chmod -R 777 storage bootstrap/cache