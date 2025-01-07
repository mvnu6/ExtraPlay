DROP DATABASE IF EXISTS ExtraGame;
CREATE DATABASE ExtraGame;
USE ExtraGame;

DROP TABLE IF EXISTS Users;
CREATE TABLE IF NOT EXISTS Users (
    id_users INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
);

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name_category VARCHAR(50) NOT NULL,
);


DROP TABLE IF EXISTS Games;
CREATE TABLE IF NOT EXISTS Games (
    id_games INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    id_category INT,
    FOREIGN KEY (id_category) REFERENCES category(id_category),
);

DROP TABLE IF EXISTS avis;
CREATE TABLE IF NOT EXISTS avis (
    id_avis INT AUTO_INCREMENT PRIMARY KEY,
    id_users INT,
    id_games INT,
    note INT  CHECK (note BETWEEN 1 AND 5),
    comment TEXT,
    FOREIGN KEY (id_users) REFERENCES Users(id_users),
    FOREIGN KEY (id_games) REFERENCES Games(id_games),
);

DROP TABLE IF EXISTS subscription;
CREATE TABLE IF NOT EXISTS subscription (
    id_subscription INT AUTO_INCREMENT PRIMARY KEY,
    name_sub VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,   
    time INT NOT  NULL, -- in days
    id_games INT,
    FOREIGN KEY (id_games) REFERENCES Games(id_games),
);


