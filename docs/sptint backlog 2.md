# 🚀 Sprint 2 Backlog & Project Closure

This document contains the technical tasks, user stories, planned functionalities, acceptance criteria, validations, and project documentation for **Sprint 2** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
March 12, 2026 — April 9, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Develop the RPG chat system and game library management features, including real-time messaging, private communication, game browsing, favorites management, and custom game creation.

### Sprint Velocity:
12 Tasks Planned / 12 Expected

---

# 👥 Sprint Team Roles

| Member | Assigned Role | Responsibilities |
| :--- | :--- | :--- |
| A. Irvin | Analyst and Designer | Interface design and project documentation |
| B. Dorian | SQL Developer | Database implementation and SQL scripts |
| C. Dereck | Database Administrator (DBA) | Database maintenance and technical support |
| D. Manuel | Query Specialist | Query development and data validation |
| E. Carlos | SQL Tester | Testing, validation, and quality assurance |

---

# 🛠️ Infrastructure & Database

## #INFRA-03 – Configure Chat System Database

**Type:** Technical Task  
**Status:** In Progress  
**Responsible:** B. Dorian, C. Dereck

### Description

Design and configure the database structure required for the RPG chat system and private messaging features.

The objective of this task is to provide secure communication between users through stored and real-time messages.

The following technical tasks will be performed:

- Create the `messages` table
- Configure primary key for messages
- Create foreign keys linking sender and receiver users
- Configure message storage structure
- Create SQL queries for message insertion
- Create SQL queries for message retrieval
- Validate relationships between users and messages
- Test message storage operations
- Validate database performance during message exchange
- Upload SQL scripts to GitHub repository

### Expected Closure Documentation

- Messages table created successfully
- Foreign keys validated successfully
- Message insertion queries tested
- Message retrieval queries functioning correctly
- Local database tests completed
- Documentation uploaded to GitHub

---

## #INFRA-04 – Configure Game Library Database

**Type:** Technical Task  
**Status:** In Progress  
**Responsible:** B. Dorian, D. Manuel

### Description

Design and configure the database structure required for game management and favorite game functionality.

The objective of this task is to allow users to browse RPG games, save favorites, and create custom game entries.

The following technical tasks will be performed:

- Configure the `games` table structure
- Configure the `favorites` table
- Create foreign key relationships
- Create SQL queries for game retrieval
- Create SQL queries for favorite insertion
- Validate favorite game relationships
- Insert test game records
- Test game management operations
- Validate data integrity
- Upload SQL scripts to GitHub repository

### Expected Closure Documentation

- Games table configured successfully
- Favorites table configured successfully
- Database relationships validated
- Test records inserted successfully
- CRUD operations tested successfully
- Documentation uploaded to GitHub

---

# 👤 User Stories

## #US-08 – Real-Time RPG Chat

**Type:** User Story  
**Status:** In Progress  
**Responsible:** A. Irvin, E. Carlos

> **As a** player,  
> **I want** to communicate in real time through the RPG chat,  
> **so that** I can interact instantly with friends.

### Acceptance Criteria

#### Scenario: Real-time communication
**Given** two users are online  
**When** a message is sent  
**Then** the message appears instantly using Pusher JS

### Expected Closure Documentation

- Pusher JS integrated successfully
- Real-time events configured
- Messages displayed instantly
- Communication tested successfully

---

## #US-09 – Send Messages

**Type:** User Story  
**Status:** In Progress  
**Responsible:** D. Manuel

> **As a** player,  
> **I want** to send messages to friends,  
> **so that** I can communicate privately.

### Acceptance Criteria

#### Scenario: Send private message
**Given** two users are friends  
**When** one user sends a message  
**Then** the system stores the message in the `messages` table

### Expected Closure Documentation

- Private messaging interface implemented
- Messages stored successfully
- Chat history displayed correctly
- Message validation tested

---

## #US-10 – Browse RPG Library

**Type:** User Story  
**Status:** In Progress  
**Responsible:** A. Irvin, D. Manuel

> **As a** player,  
> **I want** to browse the game catalog,  
> **so that** I can discover RPG titles.

### Acceptance Criteria

#### Scenario: Display RPG games
**Given** the user enters the library section  
**When** the page loads  
**Then** the system displays all records from the `games` table

### Expected Closure Documentation

- Game catalog interface implemented
- Games retrieved successfully from database
- Search functionality configured
- Library tested successfully

---

## #US-11 – Add Games to Favorites

**Type:** User Story  
**Status:** In Progress  
**Responsible:** D. Manuel

> **As a** player,  
> **I want** to save favorite games,  
> **so that** I can access them quickly later.

### Acceptance Criteria

#### Scenario: Add favorite game
**Given** the user selects a game  
**When** the favorite button is pressed  
**Then** the system inserts a record into the `favorites` table

### Expected Closure Documentation

- Favorite button implemented
- Favorites stored successfully
- Favorite list displayed correctly
- Duplicate favorites prevented

---

## #US-12 – Create Custom Games

**Type:** User Story  
**Status:** In Progress  
**Responsible:** A. Irvin, B. Dorian

> **As a** player,  
> **I want** to create custom RPG entries,  
> **so that** I can personalize my library.

### Acceptance Criteria

#### Scenario: Create custom RPG
**Given** the user fills the custom game form  
**When** the form is submitted  
**Then** the system stores the game in the `games` table

### Expected Closure Documentation

- Custom game form implemented
- Data validation completed
- Custom games stored successfully
- Games displayed in library correctly

---

# ✅ Sprint Checklist

- [x] Create `messages` table
- [x] Configure foreign keys for chat system
- [x] Integrate Pusher JS
- [x] Create real-time message events
- [x] Store private messages in MySQL
- [x] Display chat history
- [x] Configure `games` table
- [x] Configure `favorites` table
- [x] Create game catalog interface
- [x] Implement favorite games system
- [x] Create custom game form
- [x] Validate custom game data
- [x] Test messaging system
- [x] Test game library functionality
- [x] Upload Sprint 2 documentation to GitHub

---

# 📊 Sprint Summary

| Category | Total |
| :--- | :--- |
| User Stories Planned | 5 |
| Technical Tasks Planned | 2 |
| Planned Tests | 8 |
| Expected Critical Errors | 0 |
| Expected Sprint Velocity | 100% |

---

# ✅ Definition of Done

- Real-time chat system will function correctly
- Private messages will be stored in MySQL
- Pusher JS integration will work successfully
- Game library will display RPG titles correctly
- Favorite games system will operate correctly
- Custom games will be created successfully
- Database relationships will be validated
- All functionalities will be tested successfully
- GitHub repository will be updated
- Sprint documentation will be completed

---

# 🚀 Final Sprint Result

Sprint 2 will be completed successfully.

All planned tasks will be delivered, tested, and integrated into the MythCore RPG Launcher repository without critical issues.