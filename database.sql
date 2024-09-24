CREATE DATABASE test_tracketeer_php;

USE test_tracketeer_php;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(255) NULL,
    address1 VARCHAR(255) NULL,
    address2 VARCHAR(255) NULL,
    state VARCHAR(255) NULL,
    city VARCHAR(255) NULL,
    postal_code VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (username),
    UNIQUE (email)
);