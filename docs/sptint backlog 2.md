# 🚀 Sprint 2 Backlog

This document contains the planned technical tasks, user stories, acceptance criteria, validations, and expected deliverables for **Sprint 2** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
March 12, 2026 — April 17, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Develop and integrate the social interaction system, profile management, database validation, and user authentication improvements for the MythCore RPG Launcher.

### Sprint Velocity:
15 Tasks Planned / 15 Expected

---

# 👥 Sprint Team Roles

| Member | Assigned Role | Responsibilities |
|----------|----------|----------|
| A. Irvin | Analyst and Designer | ERD updates, interface design, documentation |
| B. Dorian | SQL Developer | Database structure, constraints, SQL scripts |
| C. Dereck | Database Administrator (DBA) | Database maintenance, backups, repository management |
| D. Manuel | Query Specialist | SQL queries, reports, test data generation |
| E. Carlos | SQL Tester | Testing, validation, error detection |

---

# 🛠️ Infrastructure & Database

## #INFRA-01 – Expand MySQL Database Structure

**Type:** Technical Task  
**Status:** Planned  
**Responsible:** B. Dorian, C. Dereck

### Description

The database structure will be expanded to support social interaction features within the launcher.

The team will:

- Create the `friend_requests` table.
- Create the `friends` table.
- Create the `blocked_users` table.
- Create the `messages` table.
- Configure primary keys.
- Configure foreign key relationships.
- Implement referential integrity constraints.
- Configure cascade delete rules where necessary.
- Validate relationships between users and social tables.

### Expected Closure Documentation

- Database schema updated successfully.
- Foreign keys validated.
- Relationships tested successfully.
- SQL scripts uploaded to GitHub.
- Local tests completed in phpMyAdmin.

---

## #INFRA-02 – Improve Authentication System

**Type:** Technical Task  
**Status:** Planned  
**Responsible:** A. Irvin, C. Dereck

### Description

The authentication system will be enhanced to improve security and session management.

The team will:

- Implement password hashing using PHP.
- Validate user credentials against the database.
- Configure secure PHP sessions.
- Restrict access to protected pages.
- Implement automatic logout after session expiration.
- Add login error handling.
- Prevent unauthorized access attempts.

### Expected Closure Documentation

- Login validation completed.
- Password encryption tested.
- Session management working correctly.
- Protected routes secured.
- Authentication tests completed successfully.

---

# 👤 User Stories

## #US-01 – User Registration

**Type:** User Story  
**Status:** Planned  
**Responsible:** A. Irvin, E. Carlos

> **As a** new player,  
> **I want** to create an account with my credentials and personal information,  
> **so that** I can access the MythCore RPG Launcher platform securely.

### Acceptance Criteria

#### Scenario: Successful registration

**Given** the user is on the registration page  
**When** the user enters a valid username, email, and password  
**And** submits the registration form  
**Then** the system will create a new account in the `users` table  
**And** redirect the user to the login page  
**And** display a confirmation message

#### Scenario: Existing username

**Given** the user is on the registration page  
**When** the user enters an existing username  
**Then** the system will display an error message  
**And** prevent account creation

---

## #US-02 – User Login

**Type:** User Story  
**Status:** Planned  
**Responsible:** A. Irvin, E. Carlos

> **As a** registered player,  
> **I want** to log into the launcher,  
> **so that** I can access my profile and RPG services.

### Acceptance Criteria

#### Scenario: Successful login

**Given** the user is registered  
**When** correct credentials are entered  
**Then** the system will authenticate the account  
**And** redirect the user to the dashboard

---

## #US-03 – User Logout

**Type:** User Story  
**Status:** Planned  
**Responsible:** A. Irvin

> **As a** logged-in player,  
> **I want** to close my session securely,  
> **so that** my account remains protected.

### Acceptance Criteria

#### Scenario: Logout

**Given** the user is logged in  
**When** the logout button is clicked  
**Then** the system will terminate the session  
**And** redirect the user to the login page

---

## #US-04 – Edit User Profile

**Type:** User Story  
**Status:** Planned  
**Responsible:** D. Manuel

> **As a** player,  
> **I want** to modify my profile information,  
> **so that** I can personalize my account.

### Acceptance Criteria

#### Scenario: Profile update

**Given** the user is on the profile page  
**When** profile information is modified  
**Then** the system will update the `users` table  
**And** display the updated information

---

## #US-05 – Send Friend Request

**Type:** User Story  
**Status:** Planned  
**Responsible:** D. Manuel

> **As a** player,  
> **I want** to send friend requests to other users,  
> **so that** I can build my RPG community.

### Acceptance Criteria

#### Scenario: Send request

**Given** the user searches another player  
**When** the user clicks "Send Friend Request"  
**Then** the system will create a record in `friend_requests`

---

## #US-06 – Accept or Reject Friend Requests

**Type:** User Story  
**Status:** Planned  
**Responsible:** D. Manuel, E. Carlos

> **As a** player,  
> **I want** to manage incoming friend requests,  
> **so that** I can control my social connections.

### Acceptance Criteria

#### Scenario: Accept request

**Given** the user has a pending friend request  
**When** the request is accepted  
**Then** the system will create a friendship record in `friends`

#### Scenario: Reject request

**Given** the user has a pending friend request  
**When** the request is rejected  
**Then** the system will remove the request from `friend_requests`  
**And** the pending button will change to **Add Friend**  
**And** the sender will receive the message:

*"Your friend request was rejected."*

---

## #US-07 – Block Users

**Type:** User Story  
**Status:** Planned  
**Responsible:** E. Carlos

> **As a** player,  
> **I want** to block toxic users,  
> **so that** I can avoid unwanted interactions.

### Acceptance Criteria

#### Scenario: Block user

**Given** the user selects another player  
**When** the block option is confirmed  
**Then** the system will insert a record into `blocked_users`

---

# ✅ Definition of Done

- [x] Configure MySQL database
- [x] Create users table
- [x] Create friend_requests table
- [x] Create friends table
- [x] Create blocked_users table
- [x] Create messages table
- [x] Configure foreign keys
- [x] Configure authentication system
- [x] Implement registration
- [x] Implement login
- [x] Implement logout
- [x] Implement profile editing
- [x] Implement avatar update
- [x] Implement send friend request
- [x] Implement accept friend request
- [x] Implement reject friend request
- [x] Implement block user feature
- [x] Validate database relationships
- [x] Perform authentication testing
- [x] Upload updates to GitHub
- [x] Database structure created successfully
- [x] Foreign keys validated
- [x] Authentication system implemented
- [x] Registration system connected to MySQL
- [x] Login and logout functional
- [x] Profile management implemented
- [x] Avatar system integrated
- [x] Friend request system operational
- [x] Rejection system operational
- [x] Block user system operational
- [x] Testing completed successfully
- [x] Documentation completed
- [x] Repository updated successfully

---

# 📊 Sprint Summary

| Category | Total |
|----------|----------|
| User Stories Planned | 7 |
| Technical Tasks Planned | 2 |
| Planned Tests | 10 |
| Expected Critical Errors | 0 |
| Expected Sprint Velocity | 100% |

---

# 🚀 Expected Sprint Result

Sprint 2 will deliver the complete social interaction system of the MythCore RPG Launcher, including authentication improvements, profile management, friend requests, rejection notifications, user blocking, and database integration.