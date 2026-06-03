# 🚀 Sprint 3 Backlog & Project Closure

This document contains the technical tasks, user stories, planned functionalities, acceptance criteria, validations, and project documentation for **Sprint 3** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
April 10, 2026 — May 8, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Develop the ranking system, XP and achievements system, moderation tools, user reporting features, and administration panel functionalities.

### Sprint Velocity:
15 Tasks Planned / 15 Expected

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

## #INFRA-05 – Configure Ranking & XP System

**Type:** Technical Task  
**Status:** In Progress  
**Responsible:** B. Dorian, D. Manuel

### Description

Design and configure the database structure required for player rankings, XP progression, and achievements.

The objective of this task is to allow players to earn experience points, unlock achievements, and appear in ranking boards according to their progress.

The following technical tasks will be performed:

- Add XP fields to the `users` table
- Create achievement storage structure
- Configure XP update queries
- Create ranking calculation queries
- Create player sorting queries based on XP
- Configure achievement registration system
- Validate XP progression logic
- Insert test data for rankings
- Test ranking calculations
- Upload SQL scripts to GitHub repository

### Expected Closure Documentation

- XP system configured successfully
- Ranking calculations validated
- Achievement storage configured
- Test data inserted successfully
- Database tests completed
- Documentation uploaded to GitHub

---

## #INFRA-06 – Configure Moderation & Administration System

**Type:** Technical Task  
**Status:** In Progress  
**Responsible:** B. Dorian, C. Dereck

### Description

Design and configure the database structure required for user reports, moderation actions, and administration panel features.

The objective of this task is to provide moderation tools that allow administrators to review reports, manage users, manage games, and maintain a safe community environment.

The following technical tasks will be performed:

- Configure `reports` table relationships
- Create report management queries
- Create report status update queries
- Configure moderation action records
- Create user management queries
- Create game management queries
- Create category management queries
- Validate administration permissions
- Test report workflow functionality
- Upload SQL scripts to GitHub repository

### Expected Closure Documentation

- Report management system configured successfully
- Administration queries validated
- Database relationships tested successfully
- Report workflow tested successfully
- Documentation uploaded to GitHub

---

# 👤 User Stories

## #US-13 – View Rankings

**Type:** User Story  
**Status:** In Progress  
**Responsible:** A. Irvin, E. Carlos

> **As a** player,  
> **I want** to see rankings,  
> **so that** I can compare my progress with other players.

### Acceptance Criteria

#### Scenario: Display ranking board
**Given** the user opens the ranking section  
**When** the page loads  
**Then** the system displays players ordered by XP

### Expected Closure Documentation

- Ranking interface implemented
- XP ordering configured correctly
- Ranking board tested successfully

---

## #US-14 – Gain XP and Achievements

**Type:** User Story  
**Status:** In Progress  
**Responsible:** D. Manuel

> **As a** player,  
> **I want** to earn XP and achievements,  
> **so that** I can track my progression.

### Acceptance Criteria

#### Scenario: Gain XP
**Given** the user completes activities in the launcher  
**When** XP conditions are met  
**Then** the system updates the player's XP and achievements

### Expected Closure Documentation

- XP reward system implemented
- Achievement notifications configured
- XP updates validated successfully

---

## #US-15 – Report Users

**Type:** User Story  
**Status:** In Progress  
**Responsible:** E. Carlos

> **As a** player,  
> **I want** to report inappropriate behavior,  
> **so that** moderators can review incidents.

### Acceptance Criteria

#### Scenario: Successful report
**Given** the user selects another player  
**When** the report form is submitted  
**Then** the system inserts a record into the `reports` table

### Expected Closure Documentation

- Report form implemented
- Reports stored successfully
- Report validation tested

---

## #US-16 – View User Reports

**Type:** User Story  
**Status:** In Progress  
**Responsible:** D. Manuel, E. Carlos

> **As a** moderator or administrator,  
> **I want** to review reports,  
> **so that** I can take moderation actions.

### Acceptance Criteria

#### Scenario: View reports
**Given** the moderator accesses the reports section  
**When** the page loads  
**Then** the system displays all records from the `reports` table

### Expected Closure Documentation

- Report management panel implemented
- Reports displayed successfully
- Filtering system configured

---

## #US-17 – Manage Users

**Type:** User Story  
**Status:** In Progress  
**Responsible:** A. Irvin, C. Dereck

> **As an** administrator,  
> **I want** to manage users,  
> **so that** I can maintain platform integrity.

### Acceptance Criteria

#### Scenario: Manage users
**Given** the administrator accesses the administration panel  
**When** user management options are selected  
**Then** the system allows user administration actions

### Expected Closure Documentation

- User management panel implemented
- User search functionality configured
- Administration actions tested

---

## #US-18 – Manage Games

**Type:** User Story  
**Status:** In Progress  
**Responsible:** B. Dorian

> **As an** administrator,  
> **I want** to manage games,  
> **so that** the game library remains updated.

### Acceptance Criteria

#### Scenario: Manage games
**Given** the administrator accesses the games section  
**When** a game is created, edited, or deleted  
**Then** the system updates the `games` table

### Expected Closure Documentation

- Game administration panel implemented
- CRUD operations validated
- Database updates tested

---

## #US-19 – Manage Categories

**Type:** User Story  
**Status:** In Progress  
**Responsible:** B. Dorian

> **As an** administrator,  
> **I want** to organize RPG categories,  
> **so that** games are classified correctly.

### Acceptance Criteria

#### Scenario: Manage categories
**Given** the administrator accesses the categories section  
**When** categories are modified  
**Then** the system updates category records correctly

### Expected Closure Documentation

- Category management panel implemented
- Category CRUD operations tested
- Data integrity validated

---

## #US-20 – Manage Reports

**Type:** User Story  
**Status:** In Progress  
**Responsible:** C. Dereck, E. Carlos

> **As an** administrator,  
> **I want** to resolve reports and moderate users,  
> **so that** the community remains safe.

### Acceptance Criteria

#### Scenario: Resolve report
**Given** the administrator reviews a report  
**When** an action is selected  
**Then** the report status is updated and moderation action is applied

### Expected Closure Documentation

- Report resolution workflow implemented
- Report status updates functioning correctly
- Moderation actions tested successfully

---

# ✅ Sprint Checklist

- [x] Configure XP fields in users table
- [x] Create achievement tracking system
- [x] Create ranking calculation queries
- [x] Create ranking interface
- [x] Implement XP reward system
- [x] Configure achievement notifications
- [x] Create report submission form
- [x] Store reports in database
- [x] Create moderator report panel
- [x] Configure report filtering system
- [x] Create user administration panel
- [x] Create game administration panel
- [x] Create category administration panel
- [x] Implement report resolution workflow
- [x] Validate moderation actions
- [x] Test ranking calculations
- [x] Test XP progression system
- [x] Validate administration permissions
- [x] Upload Sprint 3 documentation to GitHub
- [x] Complete Sprint 3 documentation

---

# 📊 Sprint Summary

| Category | Total |
| :--- | :--- |
| User Stories Planned | 8 |
| Technical Tasks Planned | 2 |
| Planned Tests | 10 |
| Expected Critical Errors | 0 |
| Expected Sprint Velocity | 100% |

---

# ✅ Definition of Done

- Ranking system will function correctly
- XP progression system will update successfully
- Achievement system will operate correctly
- User reports will be stored successfully
- Moderation panel will function correctly
- User administration features will operate successfully
- Game administration features will function correctly
- Category management will operate correctly
- Report resolution workflow will function successfully
- All functionalities will be tested and documented
- GitHub repository will be updated successfully

---

# 🚀 Final Sprint Result

Sprint 3 will be completed successfully.

All planned tasks will be delivered, tested, and integrated into the MythCore RPG Launcher repository without critical issues.