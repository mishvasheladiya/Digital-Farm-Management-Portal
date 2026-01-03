CREATE TABLE farmers (
    farmer_id INT AUTO_INCREMENT PRIMARY KEY,

    -- Account Info
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    -- Farm Info
    farm_name VARCHAR(150),
    farming_type ENUM('both', 'livestock', 'crop') DEFAULT 'both',

    -- Location
    country VARCHAR(100) DEFAULT 'India',
    address TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    postal_code VARCHAR(10),

    -- Coordinates
    latitude DECIMAL(10,7),
    longitude DECIMAL(10,7),

    -- Preferences
    main_crops VARCHAR(255),
    irrigation_method ENUM('drip', 'sprinkler', 'flood', 'rainfed'),
    weather_metrics SET('temperature','rainfall','soil_moisture'),

    -- System
    status ENUM('pending','active','blocked') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE farmers 
ADD COLUMN two_fa TINYINT(1) DEFAULT 0,
ADD COLUMN login_alerts TINYINT(1) DEFAULT 0;
ALTER TABLE farmers ADD COLUMN email_notif_enabled TINYINT(1) DEFAULT 1;