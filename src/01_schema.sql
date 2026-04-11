-- ============================================================================
-- DATABASE: RPG LAUNCHER - CHRONICLES OF THE CODE
-- DESCRIPTION: Core tables with relationships (ER Diagram Ready)
-- ============================================================================

USE if0_38404221_rpg;

-- Drop tables (for clean execution)
DROP TABLE IF EXISTS HERO_STAT;
DROP TABLE IF EXISTS GAME;
DROP TABLE IF EXISTS GENRE;
DROP TABLE IF EXISTS DEVELOPER;
DROP TABLE IF EXISTS USERS;

-- ============================================================================
-- TABLE: USERS
-- ============================================================================
CREATE TABLE USERS (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(150) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
status VARCHAR(20) DEFAULT 'ACTIVE'
) ENGINE=InnoDB;

-- ============================================================================
-- TABLE: DEVELOPER
-- ============================================================================
CREATE TABLE DEVELOPER (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
website VARCHAR(255)
) ENGINE=InnoDB;

-- ============================================================================
-- TABLE: GENRE
-- ============================================================================
CREATE TABLE GENRE (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- ============================================================================
-- TABLE: GAME
-- ============================================================================
CREATE TABLE GAME (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT,
release_date DATE,
developer_id INT,
genre_id INT,

```
FOREIGN KEY (developer_id) REFERENCES DEVELOPER(id),
FOREIGN KEY (genre_id) REFERENCES GENRE(id)
```

) ENGINE=InnoDB;

-- ============================================================================
-- TABLE: HERO_STAT
-- ============================================================================
CREATE TABLE HERO_STAT (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
experience_points INT DEFAULT 0,
current_level INT DEFAULT 1,
gold_balance DECIMAL(10,2) DEFAULT 0.00,

```
FOREIGN KEY (user_id) REFERENCES USERS(id)
```

) ENGINE=InnoDB;

-- ============================================================================
-- VERIFY
-- ============================================================================
SHOW TABLES;
