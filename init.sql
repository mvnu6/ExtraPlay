DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE IF NOT EXISTS users (
    id_user SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS category CASCADE;
CREATE TABLE IF NOT EXISTS category (
    id_category SERIAL PRIMARY KEY,
    name_category VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS Games CASCADE;
CREATE TABLE IF NOT EXISTS Games (
    id_game SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    id_category INT,
    FOREIGN KEY (id_category) REFERENCES category(id_category) ON DELETE CASCADE
);

DROP TABLE IF EXISTS review CASCADE;
CREATE TABLE IF NOT EXISTS review (
    id_review SERIAL PRIMARY KEY,
    id_user INT,
    id_game INT,
    note INT CHECK (note BETWEEN 1 AND 5),
    comment TEXT,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_game) REFERENCES Games(id_game) ON DELETE CASCADE
);

DROP TABLE IF EXISTS subscription CASCADE;
CREATE TABLE IF NOT EXISTS subscription (
    id_subscription SERIAL PRIMARY KEY,
    name_sub VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,   
    time INT NOT NULL, -- in days
    id_game INT,
    FOREIGN KEY (id_game) REFERENCES Games(id_game) ON DELETE CASCADE
);
