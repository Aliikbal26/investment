CREATE DATABASE investment_portfolio;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    type_account VARCHAR(100),
    account_title VARCHAR(50),
    first_name VARCHAR(100)NOT NULL,
    middle_name VARCHAR(100),
    last_name VARCHAR(100)NOT NULL,
    date_of_birth DATE,
    nationality VARCHAR(100) NOT NULL,
    country_residence VARCHAR(100)NOT NULL,
    address_one VARCHAR(255)NOT NULL,
    address_two VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(200),
    zip_code VARCHAR(6)NOT NULL,
    country VARCHAR(100),
    employement_status VARCHAR(100),
    job_title VARCHAR(100),
    phone_work VARCHAR(20),
    phone_mobile VARCHAR(20),
    phone_home VARCHAR(20),
    alternative_email VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE investments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    investment_type ENUM('stocks', 'bonds', 'mutual funds'),
    amount DECIMAL(10, 2),
    investment_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
