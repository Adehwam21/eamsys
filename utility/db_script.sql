CREATE DATABASE ams_db;

USE ams_db

CREATE TABLE tbl_add_member_type (
    member_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each user
    branch_id INT NOT NULL,                    -- Branch ID associated with the user
    username VARCHAR(255) NOT NULL UNIQUE,     -- Username for login
    password VARCHAR(255) NOT NULL,            -- Hashed password for security
    role ENUM('admin', 'user') NOT NULL,       -- Role: admin or regular user
    status ENUM('active', 'inactive') DEFAULT 'active',  -- Account status
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Account creation date
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Last updated date
);

CREATE TABLE tbl_add_employee (
    eid INT AUTO_INCREMENT PRIMARY KEY,
    e_name VARCHAR(100),
    e_email VARCHAR(100),
    e_contact VARCHAR(15),
    e_pre_address TEXT,
    e_per_address TEXT,
    e_nid VARCHAR(50),
    e_designation INT,
    e_date DATE,
    ending_date DATE,
    e_password VARCHAR(255),
    e_status INT,
    image VARCHAR(255),
    branch_id INT
);

