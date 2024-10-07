CREATE TABLE places (
    id INT AUTO_INCREMENT PRIMARY KEY,
    place_id VARCHAR(255) UNIQUE,
    name VARCHAR(255),
    visits INT DEFAULT 1
);
