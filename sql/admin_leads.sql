CREATE TABLE admin_leads (
    lead_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    product_id INT,
    status VARCHAR(50) DEFAULT 'New',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);