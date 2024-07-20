-- استفاده از پایگاه داده ticket_system
USE ticket_system;

-- ایجاد جدول admins برای ذخیره اطلاعات مدیران
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- شناسه منحصر به فرد و افزایش خودکار
    username VARCHAR(50) NOT NULL,       -- نام کاربری مدیر
    password VARCHAR(255) NOT NULL       -- رمز عبور مدیر (هش شده)
);

-- ایجاد جدول users برای ذخیره اطلاعات کاربران
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- شناسه منحصر به فرد و افزایش خودکار
    username VARCHAR(50) NOT NULL,       -- نام کاربری کاربر
    password VARCHAR(255) NOT NULL       -- رمز عبور کاربر (هش شده)
);

-- ایجاد جدول tickets برای ذخیره اطلاعات بلیت‌ها
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- شناسه منحصر به فرد و افزایش خودکار
    username VARCHAR(50) NOT NULL,       -- نام کاربری خریدار بلیت
    email VARCHAR(100) NOT NULL,         -- ایمیل خریدار بلیت
    count INT DEFAULT 0                  -- تعداد بلیت‌های خریداری شده (پیش‌فرض صفر)
);

-- ایجاد جدول comments برای ذخیره نظرات کاربران
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- شناسه منحصر به فرد و افزایش خودکار
    user VARCHAR(50) NOT NULL,           -- نام کاربری نظر دهنده
    comment TEXT NOT NULL,               -- متن نظر
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- تاریخ و زمان ایجاد نظر (پیش‌فرض زمان فعلی)
    approved BOOLEAN DEFAULT 0           -- وضعیت تایید نظر (پیش‌فرض تایید نشده)
);
-- جدول timings: برای ذخیره زمانبندی اطلاعات مختلف
CREATE TABLE timings (
    id INT AUTO_INCREMENT PRIMARY KEY, -- شناسه یکتا با افزایش خودکار
    type VARCHAR(50) NOT NULL, -- نوع زمانبندی، نباید خالی باشد و حداکثر 50 کاراکتر
    content TEXT NOT NULL, -- محتوای زمانبندی، نباید خالی باشد (متن بلند)
    timee TEXT NOT NULL -- زمان که داده‌ها باید آپلود شود نباید خالی باشد
);

-- جدول posttext: برای ذخیره مطالب و محتوای پست
CREATE TABLE posttext (
    id INT AUTO_INCREMENT PRIMARY KEY, -- شناسه یکتا با افزایش خودکار
    title VARCHAR(255) NOT NULL, -- عنوان پست، نباید خالی باشد و حداکثر 255 کاراکتر
    content TEXT NOT NULL -- محتوای پست، نباید خالی باشد (متن بلند)
);

-- جدول coaches: برای ذخیره اطلاعات مربیان
CREATE TABLE coaches (
    id INT AUTO_INCREMENT PRIMARY KEY, -- شناسه یکتا با افزایش خودکار
    name VARCHAR(100) NOT NULL -- نام مربی، نباید خالی باشد و حداکثر 100 کاراکتر
);
