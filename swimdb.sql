USE ticket_system;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    username VARCHAR(50) NOT NULL,     
    password VARCHAR(255) NOT NULL       
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    username VARCHAR(50) NOT NULL,     
    password VARCHAR(255) NOT NULL      
);

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,   
    username VARCHAR(50) NOT NULL,      
    email VARCHAR(100) NOT NULL,       
    count INT DEFAULT 0                
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    user VARCHAR(50) NOT NULL,          
    comment TEXT NOT NULL,              
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    approved BOOLEAN DEFAULT 0           
);
CREATE TABLE timings (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    type VARCHAR(50) NOT NULL, 
    content TEXT NOT NULL,
    timee TEXT NOT NULL 
);

CREATE TABLE posttext (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(255) NOT NULL, 
    content TEXT NOT NULL 
);

CREATE TABLE coaches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
