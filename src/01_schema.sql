CREATE DATABASE rpg_launcher;

USE rpg_launcher;

CREATE TABLE users (
user_id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50),
email VARCHAR(100),
password VARCHAR(100)
);

CREATE TABLE developers (
developer_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100)
);

CREATE TABLE genres (
genre_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50)
);

CREATE TABLE games (
game_id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100),
developer_id INT,
genre_id INT,
FOREIGN KEY (developer_id) REFERENCES developers(developer_id),
FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

CREATE TABLE library (
library_id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
game_id INT,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (game_id) REFERENCES games(game_id)
);

