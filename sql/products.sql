CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT, -- Links to your farmers table
    name VARCHAR(100),
    email VARCHAR(100),
    mobile VARCHAR(100),
    category VARCHAR(50),
    product_name VARCHAR(100),
    price DECIMAL(10, 2),
    farm_location TEXT,
    harvest_date DATE,
    stock_quantity INT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id)
);


-- Add distributor support to Products table
ALTER TABLE products ADD COLUMN distributor_id INT(11) NULL AFTER farmer_id;

-- Add distributor support to Orders table
ALTER TABLE orders ADD COLUMN distributor_id INT(11) NULL AFTER farmer_id;
