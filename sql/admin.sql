CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) DEFAULT 'assets/image/user.jpg',
    two_fa TINYINT(1) DEFAULT 0,
    notify_email TINYINT(1) DEFAULT 1,
    notify_order TINYINT(1) DEFAULT 1,
    notify_system TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
