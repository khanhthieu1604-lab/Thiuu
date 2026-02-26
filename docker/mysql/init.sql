CREATE DATABASE IF NOT EXISTS kthiuu_hotel;
CREATE DATABASE IF NOT EXISTS thiuu_car_rental;

-- Grant access to laravel user for all databases
GRANT ALL PRIVILEGES ON kthiuu_hotel.* TO 'laravel'@'%';
GRANT ALL PRIVILEGES ON thiuu_car_rental.* TO 'laravel'@'%';
FLUSH PRIVILEGES;
