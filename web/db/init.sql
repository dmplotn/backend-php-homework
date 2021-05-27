USE test;

DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS positions;
DROP TABLE IF EXISTS departments;
DROP TABLE IF EXISTS users;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    position_id INT,
    department_id INT,
    FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE RESTRICT,
    FOREIGN KEY (position_id) REFERENCES positions (id) ON DELETE SET NULL,
    FOREIGN KEY (department_id) REFERENCES departments (id) ON DELETE SET NULL
);

INSERT INTO roles (name) VALUES ('admin'), ('user');
INSERT INTO positions (name) VALUES ('Position 1'), ('Position 2'), ('Position 3');
INSERT INTO departments (name) VALUES ('Department 1'), ('Department 2'), ('Department 3');
