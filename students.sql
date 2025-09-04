CREATE DATABASE student_manager;
USE student_manager;

CREATE TABLE students (
    id INT(3),
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    age INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);