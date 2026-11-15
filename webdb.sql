CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio_db;

DROP TABLE IF EXISTS about;
DROP TABLE IF EXISTS skills;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS contact;

CREATE TABLE about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    title VARCHAR(100),
    bio TEXT,
    photo VARCHAR(100) DEFAULT 'default.svg'
);

CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(100)
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(100),
    description TEXT
);

CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT
);

INSERT INTO about (name, title, bio, photo) VALUES (
    'Abdulaziz Altamimi',
    'Software Engineering Student',
    'Software Engineering student from Hail.
I like coding, web developing, and learning about new technology.',
    'me.jpg'
);

INSERT INTO skills (skill_name) VALUES
('HTML'),
('CSS'),
('JavaScript'),
('Java'),
('Python'),
('MySQL');

INSERT INTO projects (project_name, description) VALUES
('Ziraah Website', 'A website that provides services for farmers.'),
('Rshoosh Website', 'An e-commerce website for Rashoush Restaurant that provides services such as online ordering and table reservations.');