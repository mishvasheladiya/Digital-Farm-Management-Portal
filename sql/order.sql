CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    farmer_id INT NOT NULL,
    distributor_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,         -- price per unit
    total_price DECIMAL(10,2) NOT NULL,   -- price * quantity
    status ENUM('Confirmed','Completed','Cancelled') DEFAULT 'Confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (farmer_id) REFERENCES farmers(farmer_id),
    FOREIGN KEY (distributor_id) REFERENCES distributors(distributor_id)
);
