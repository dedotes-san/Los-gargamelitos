-- ==========================================
-- DATABASE: MythCore RPG Launcher
-- SCHEMA CREATION
-- ==========================================

CREATE DATABASE IF NOT EXISTS mythcore_rpg;
USE mythcore_rpg;

-- ==========================================
-- TABLE: categories
-- ==========================================

CREATE TABLE categories (

id_category INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: users
-- ==========================================

CREATE TABLE users (

id INT AUTO_INCREMENT PRIMARY KEY,

username VARCHAR(50) NOT NULL,
email VARCHAR(150) NOT NULL,
password VARCHAR(255) NOT NULL,

avatar VARCHAR(255),
profile_pic VARCHAR(255),

level INT DEFAULT 1,
xp INT DEFAULT 0,

blocked BOOLEAN DEFAULT FALSE,

created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

last_active DATETIME,
last_seen DATETIME

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: games
-- ==========================================

CREATE TABLE games (

id INT AUTO_INCREMENT PRIMARY KEY,

name VARCHAR(100) NOT NULL,
genre VARCHAR(50),
description TEXT,

image VARCHAR(255),

is_real BOOLEAN DEFAULT TRUE,

url VARCHAR(255),

created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

id_category INT,

FOREIGN KEY (id_category)
REFERENCES categories(id_category)
ON DELETE SET NULL
ON UPDATE CASCADE

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: favorites
-- ==========================================

CREATE TABLE favorites (

id INT AUTO_INCREMENT PRIMARY KEY,

user_id INT,
game_id INT,

FOREIGN KEY (user_id)
REFERENCES users(id)
ON DELETE CASCADE,

FOREIGN KEY (game_id)
REFERENCES games(id)
ON DELETE CASCADE

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: friends
-- ==========================================

CREATE TABLE friends (

id INT AUTO_INCREMENT PRIMARY KEY,

sender_id INT,
receiver_id INT,

status VARCHAR(20),

blocker_id INT,

FOREIGN KEY (sender_id)
REFERENCES users(id)
ON DELETE CASCADE,

FOREIGN KEY (receiver_id)
REFERENCES users(id)
ON DELETE CASCADE

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: friend_requests
-- ==========================================

CREATE TABLE friend_requests (

id INT AUTO_INCREMENT PRIMARY KEY,

sender_id INT,
receiver_id INT,

status VARCHAR(20),

FOREIGN KEY (sender_id)
REFERENCES users(id)
ON DELETE CASCADE,

FOREIGN KEY (receiver_id)
REFERENCES users(id)
ON DELETE CASCADE

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: blocked_users
-- ==========================================

CREATE TABLE blocked_users (

id INT AUTO_INCREMENT PRIMARY KEY,

blocker_id INT,
blocked_id INT,

created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (blocker_id)
REFERENCES users(id)
ON DELETE CASCADE,

FOREIGN KEY (blocked_id)
REFERENCES users(id)
ON DELETE CASCADE

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: messages
-- ==========================================

CREATE TABLE messages (

id INT AUTO_INCREMENT PRIMARY KEY,

sender_id INT,
receiver_id INT,

message TEXT,

sent_at DATETIME,

status VARCHAR(20),

created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (sender_id)
REFERENCES users(id)
ON DELETE CASCADE,

FOREIGN KEY (receiver_id)
REFERENCES users(id)
ON DELETE CASCADE

) ENGINE=InnoDB;


-- ==========================================
-- TABLE: reports
-- ==========================================

CREATE TABLE reports (

id INT AUTO_INCREMENT PRIMARY KEY,

reported_id INT,

reason TEXT,

FOREIGN KEY (reported_id)
REFERENCES users(id)
ON DELETE CASCADE

) ENGINE=InnoDB;
