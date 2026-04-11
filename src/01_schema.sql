-- ============================================================================
-- RPG Project: Chronicles of the Code
-- FILE: 01_schema_tables.sql
-- DESCRIPTION: Core entity definitions for the RPG Launcher system.
-- ============================================================================

-- ============================================================================
-- Core Entity: USER
-- Description: Stores the hero's credentials, email, and account status.
-- ============================================================================
CREATE TABLE USER (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status VARCHAR(20) DEFAULT 'ACTIVE'
);

-- ============================================================================
-- Core Entity: DEVELOPER
-- Description: Stores information about the studios that forge the games.
-- ============================================================================
CREATE TABLE DEVELOPER (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    website VARCHAR(255)
);

-- ============================================================================
-- Core Entity: GENRE
-- Description: Categorizes games by their RPG style (Action, Turn-based, etc.).
-- ============================================================================
CREATE TABLE GENRE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- ============================================================================
-- Core Entity: GAME
-- Description: Contains the main data for each title available in the launcher.
-- ============================================================================
CREATE TABLE GAME (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    release_date DATE,
    version VARCHAR(20)
);

-- ============================================================================
-- Core Entity: HERO_STAT
-- Description: Stores progression data like experience, level, and gold.
-- ============================================================================
CREATE TABLE HERO_STAT (
    id INT AUTO_INCREMENT PRIMARY KEY,
    experience_points INT DEFAULT 0,
    current_level INT DEFAULT 1,
    gold_balance DECIMAL(10,2) DEFAULT 0.00
);
