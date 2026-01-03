CREATE TABLE product_interests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    distributor_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_interest (product_id, distributor_id),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
