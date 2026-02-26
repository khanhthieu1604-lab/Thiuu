# KThiuu Hotel

> **Khách sạn sang trọng với dịch vụ đẳng cấp**

Dự án website đặt phòng khách sạn được xây dựng với Laravel 11, theo phong cách thiết kế Mường Thanh.

## ⭐ Tính năng

- 🏨 **Quản lý phòng** - Nhiều loại phòng (Luxury, Grand, Holiday, Standard)
- 📅 **Đặt phòng trực tuyến** - Kiểm tra tình trạng phòng theo ngày
- 💳 **Thanh toán VNPay** - Tích hợp cổng thanh toán VNPay
- 👤 **Quản lý tài khoản** - Đăng ký, đăng nhập, quản lý đặt phòng
- 🎨 **Giao diện Mường Thanh** - Thiết kế sang trọng với màu xanh lá + vàng
- 📱 **Responsive** - Tối ưu cho mọi thiết bị
- �️ **Admin Panel** - Quản lý khách sạn, phòng, đặt phòng

## � Cài đặt

### Yêu cầu
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL

### Cài đặt local

```bash
# Clone repo
git clone https://github.com/your-username/kthiuu-hotel.git
cd kthiuu-hotel

# Cài đặt PHP dependencies
composer install

# Cài đặt Node modules
npm install

# Copy .env
cp .env.example .env

# Tạo key
php artisan key:generate

# Chạy migrations
php artisan migrate

# Seed dữ liệu mẫu
php artisan db:seed

# Build assets
npm run build

# Chạy server
php artisan serve
```

### Chạy với Docker

```bash
# Build và start containers
docker-compose up -d --build

# Truy cập ứng dụng
# App: http://localhost:8085
# phpMyAdmin: http://localhost:8095
# Mailhog: http://localhost:8030
```

## � Cấu trúc dự án

```
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php      # Trang chủ
│   │   ├── RoomController.php      # Danh sách & chi tiết phòng
│   │   ├── ServiceController.php   # Dịch vụ khách sạn
│   │   ├── BookingController.php   # Đặt phòng
│   │   └── Admin/                  # Admin panel
│   └── Models/
│       ├── User.php
│       ├── Hotel.php
│       ├── Room.php
│       ├── RoomType.php            # Loại phòng
│       ├── Amenity.php             # Tiện nghi
│       ├── Service.php             # Dịch vụ
│       ├── Booking.php
│       └── Payment.php
├── resources/views/
│   ├── layouts/app.blade.php       # Layout chính
│   ├── welcome.blade.php           # Trang chủ
│   ├── rooms/                      # Phòng
│   ├── services/                   # Dịch vụ
│   ├── about.blade.php             # Giới thiệu
│   └── contact.blade.php           # Liên hệ
└── docker/                         # Docker configs
```

## 🎨 Design System

- **Primary Color**: `#1a472a` (Forest Green)
- **Accent Color**: `#d4af37` (Gold)
- **Typography**: Playfair Display (headings), Inter (body)

## 👥 Tài khoản demo

| Role  | Email                    | Password |
|-------|--------------------------|----------|
| Admin | admin@kthiuu-hotel.com   | password |
| User  | test@example.com         | password |

## 📝 License

MIT License
