-- ============================================================================
-- DATABASE: RPG LAUNCHER - CHRONICLES OF THE CODE
-- DESCRIPTION: Core tables for user, games and hero progression
-- ============================================================================

-- ============================================================================
-- CORE ENTITY: USERS
-- DESCRIPTION: Stores the main information of the system users (heroes)
-- ============================================================================
CREATE TABLE USERS (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(150) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
status VARCHAR(20) DEFAULT 'ACTIVE'
);

-- ============================================================================
-- CORE ENTITY: DEVELOPER
-- DESCRIPTION: Stores information about game developers
-- ============================================================================
CREATE TABLE DEVELOPER (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
website VARCHAR(255)
);

-- ============================================================================
-- CORE ENTITY: GENRE
-- DESCRIPTION: Stores game categories
-- ============================================================================
CREATE TABLE GENRE (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL UNIQUE
);

-- ============================================================================
-- CORE ENTITY: GAME
-- DESCRIPTION: Stores the available games in the launcher
-- ============================================================================
CREATE TABLE GAME (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT,
release_date DATE
);

-- ============================================================================
-- CORE ENTITY: HERO_STAT
-- DESCRIPTION: Stores player progression data such as level and resources
-- ============================================================================
CREATE TABLE HERO_STAT (
id INT AUTO_INCREMENT PRIMARY KEY,
experience_points INT DEFAULT 0,
current_level INT DEFAULT 1,
gold_balance DECIMAL(10,2) DEFAULT 0.00
);
