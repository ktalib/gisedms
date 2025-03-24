-- Create database
CREATE DATABASE IF NOT EXISTS gisedms;
USE gisedms;

-- Single comprehensive application table
CREATE TABLE mother_applications (
    -- Primary key
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Applicant type
    applicant_type VARCHAR(20) NULL,
    
    -- Individual applicant fields
    applicant_title VARCHAR(20) NULL,
    first_name VARCHAR(100) NULL,
    middle_name VARCHAR(100) NULL,
    surname VARCHAR(100) NULL,
    passport VARCHAR(255) NULL,
    fileno VARCHAR(50) NULL,
 
    -- Corporate applicant fields
    corporate_name VARCHAR(255) NULL,
    rc_number VARCHAR(50) NULL,
    
    -- Multiple owners fields
    multiple_owners_names TEXT NULL, -- Stored as comma-separated values
    multiple_owners_passport TEXT NULL, -- Stored as comma-separated URLs
    
    -- Contact information
    address TEXT NULL,
    phone_number TEXT NULL,
    email VARCHAR(100) NULL,
    
    -- Identification
    identification_type  TEXT  NULL,
    
    -- Plot address
    plot_house_no VARCHAR(50) NULL,
    plot_plot_no VARCHAR(50) NULL,
    plot_street_name VARCHAR(100) NULL,
    plot_district VARCHAR(100) NULL,
    
    -- Owner address
    owner_house_no VARCHAR(50) NULL,
    owner_plot_no VARCHAR(50) NULL,
    owner_street_name VARCHAR(100) NULL,
    owner_district VARCHAR(100) NULL,
    
    -- Additional information
    additional_comments TEXT NULL,
    
    -- Official use fields
    application_fee DECIMAL(10,2) NULL,
    payment_date DATE NULL,
    receipt_number VARCHAR(50) NULL,
    receipt_date DATE NULL,
    revenue_accountant VARCHAR(100) NULL,
    accountant_signature_date DATE NULL,
    scheme_no VARCHAR(50) NULL,
    
    -- Application status
    application_status ENUM('Pending', 'Under Review', 'Approved', 'Rejected') DEFAULT 'Pending' NULL,
    approval_date DATE NULL,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL
);
