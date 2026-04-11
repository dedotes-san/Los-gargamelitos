-- ============================================
-- DATABASE: RPG LAUNCHER - CHRONICLES OF THE CODE
-- DESCRIPTION: Core tables for user, games and stats
-- AUTHOR: Your Project
-- ============================================

-- Select database
USE if0_38404221_rpg;

-- ============================================
-- TABLE: USERS
-- Stores user accounts (heroes)
-- ============================================
CREATE TABLE USERS (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(150) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
status VARCHAR(20) DEFAULT 'ACTIVE'
);

-- ============================================
-- TABLE: DEVELOPER
-- Stores game developers
-- ============================================
CREATE TABLE DEVELOPER (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
website VARCHAR(255)
);

-- ============================================
-- TABLE: GENRE
-- Stores game genres
-- ============================================
CREATE TABLE GENRE (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL UNIQUE
);

-- ============================================
-- TABLE: GAME
-- Stores game catalog
-- ============================================
CREATE TABLE GAME (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT,
release_date DATE
);

-- ============================================
-- TABLE: HERO_STAT
-- Stores player progression data
-- ============================================
CREATE TABLE HERO_STAT (
id INT AUTO_INCREMENT PRIMARY KEY,
experience_points INT DEFAULT 0,
current_level INT DEFAULT 1,
gold_balance DECIMAL(10,2) DEFAULT 0.00
);

-- ============================================
-- VERIFY TABLES
-- ============================================
SHOW TABLES;
