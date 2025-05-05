-- لا حاجة لـ CREATE DATABASE في PostgreSQL، لأنه يتم توفير قاعدة البيانات عند الاتصال

-- إنشاء جدول المستخدمين
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- إنشاء جدول المنتجات
CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255)
);

-- إدخال بعض البيانات التجريبية
INSERT INTO products (name, description, price, image_url) VALUES
('iPhone 14 Pro', 'Apple smartphone with 128GB storage and 48MP camera', 999.99, 'images/iphone.png'),
('Samsung Galaxy S23', 'Samsung smartphone with AMOLED display and triple camera', 899.00, 'images/samsung-galaxy-s23-5g.jpg'),
('Sony WH-1000XM5', 'Wireless noise-canceling headphones with high-resolution audio', 379.99, 'images/sony.webp'),
('Dell XPS 13 Laptop', '13-inch ultrabook with Intel i7 processor and 16GB RAM', 1249.99, 'images/dell.png'),
('Apple MacBook Air M2', 'Apple laptop with M2 chip, 8GB RAM, and 256GB SSD', 1099.00, 'images/Anker PowerCore 20000.webp'),
('Logitech MX Master 3S', 'Ergonomic wireless mouse with advanced scroll wheel', 99.99, 'images/s-2500.jpg'),
('Amazon Echo Dot (5th Gen)', 'Smart speaker with Alexa voice assistant', 49.99, 'images/s-1500.jpg'),
('Fitbit Charge 5', 'Fitness tracker with built-in GPS and heart rate monitor', 149.95, 'images/Fitbit Charge 5.webp'),
('Canon EOS R10', 'Mirrorless camera with 24MP sensor and 4K video recording', 979.00, 'images/OIP.jpg'),
('Anker PowerCore 20000', 'Portable charger with 20000mAh capacity and fast charging', 59.99, 'images/app moc.jpg');
