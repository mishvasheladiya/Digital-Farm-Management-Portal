CREATE TABLE distributors (
    distributor_id INT AUTO_INCREMENT PRIMARY KEY,

    -- Account Info
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    -- Business Info
    company_name VARCHAR(150) NOT NULL,
    business_id VARCHAR(100),

    -- Location
    country VARCHAR(100) DEFAULT 'India',
    address TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    postal_code VARCHAR(10),

    -- Service Details
    service_area VARCHAR(255),
    products TEXT,
    min_order DECIMAL(10,2),

    -- System
    status ENUM('pending','active','blocked') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
