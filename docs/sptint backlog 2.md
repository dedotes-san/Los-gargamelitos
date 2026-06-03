# 🚀 Sprint Backlog 2 — MythCore RPG Launcher

This document contains the planned tasks, user stories, validations, estimated hours, responsibilities, and deliverables for **Sprint 2** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
March 16, 2026 — April 17, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Complete the database structure, establish connections between the frontend and MySQL database, implement profile management features, and prepare the social interaction system for integration.

### Sprint Velocity:
12 Tasks Planned / 12 Expected

---

# 👥 Sprint Team Roles

| Member | Assigned Role | Responsibilities |
| :--- | :--- | :--- |
| A. Irvin | Analyst and Designer | ERD diagram updates, interface design, documentation |
| B. Dorian | SQL Developer | Database implementation, constraints, SQL scripts |
| C. Dereck | Database Administrator (DBA) | Database maintenance, backups, version control |
| D. Manuel | Query Specialist | SQL queries, reports, test data generation |
| E. Carlos | SQL Tester | Validation testing, integrity testing, bug reporting |

---

# 🛠️ Sprint Backlog

| ID | Task | Priority | Hours | Responsible | Status |
| :--- | :--- | :--- | :---: | :--- | :--- |
| DB-01 | Create foreign keys between users, friends and friend_requests tables | High | 4 h | Dorian | Planned |
| DB-02 | Create indexes to optimize login and user searches | Medium | 3 h | Dorian | Planned |
| DB-03 | Create reports table relationships and validations | High | 4 h | Dorian | Planned |
| DB-04 | Insert test users into database | Medium | 3 h | Manuel | Planned |
| DB-05 | Insert friendship requests and social interaction test data | Medium | 3 h | Manuel | Planned |
| INT-01 | Connect registration form with MySQL database | High | 5 h | Irvin | Planned |
| INT-02 | Connect login form with MySQL validation system | High | 4 h | Irvin | Planned |
| INT-03 | Create profile loading system from database | High | 5 h | Irvin | Planned |
| INT-04 | Implement avatar persistence in MySQL | High | 4 h | Irvin | Planned |
| TEST-01 | Validate registration scenarios | High | 3 h | Carlos | Planned |
| TEST-02 | Validate login scenarios and session management | High | 3 h | Carlos | Planned |
| TEST-03 | Validate database integrity and relationships | High | 4 h | Carlos | Planned |

---

# 👤 User Stories

## #US-08 – Avatar Management

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin

> **As a** player,
>
> **I want** to select and save a custom avatar,
>
> **so that** I can personalize my profile.

### Acceptance Criteria

#### Scenario: Successful avatar update

**Given** the user is on the profile page

**When** the user selects a new avatar

**Then** the system updates the avatar in the database

**And** displays the new avatar immediately

#### Scenario: Avatar persistence

**Given** the user previously selected an avatar

**When** the user logs in again

**Then** the selected avatar remains displayed

### Estimated Hours
**6 hours**

---

## #US-09 – User Search

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel

> **As a** player,
>
> **I want** to search for other users,
>
> **so that** I can send friendship requests.

### Acceptance Criteria

#### Scenario: User found

**Given** the user enters an existing username

**When** the search is executed

**Then** the system displays matching users

#### Scenario: User not found

**Given** the username does not exist

**When** the search is executed

**Then** the system displays a no-results message

### Estimated Hours
**5 hours**

---

## #US-10 – Profile Information Display

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin

> **As a** player,
>
> **I want** to view my stored profile information,
>
> **so that** I can verify my account data.

### Acceptance Criteria

#### Scenario: Successful profile loading

**Given** the user is logged in

**When** the profile page opens

**Then** the system retrieves information from the database

**And** displays username, email and avatar

### Estimated Hours
**4 hours**

---

# 🧪 Testing Tasks

| Test ID | Description | Hours | Responsible |
| :--- | :--- | :---: | :--- |
| TEST-01 | Registration validation tests | 3 h | Carlos |
| TEST-02 | Login and session validation | 3 h | Carlos |
| TEST-03 | Avatar persistence tests | 2 h | Carlos |
| TEST-04 | User search validation | 2 h | Carlos |
| TEST-05 | Foreign key validation | 2 h | Carlos |

---

# 📊 Hours Distribution by Team Member

| Member | Assigned Hours |
| :--- | :---: |
| A. Irvin | 24 h |
| B. Dorian | 14 h |
| C. Dereck | 12 h |
| D. Manuel | 14 h |
| E. Carlos | 12 h |
| **Total Sprint Hours** | **76 h** |

# ✅ Definition of Done
- [x] Create foreign keys between related tables
- [x] Create indexes for database optimization
- [x] Insert test users into database
- [x] Insert friendship request test data
- [x] Connect registration form to MySQL
- [x] Connect login form to MySQL
- [x] Implement profile information loading
- [x] Implement avatar persistence system
- [x] Implement user search functionality
- [x] Validate registration scenarios
- [x] Validate login scenarios
- [x] Validate database integrity
- [x] Validate avatar persistence
- [x] Upload updated code to GitHub repository
- [x] Update sprint documentation

---

# 📦 Expected Deliverables

| Deliverable | Location |
| :--- | :--- |
| Updated MySQL database | XAMPP / phpMyAdmin |
| Registration and Login integration | Repository |
| Avatar system | Repository |
| User search system | Repository |
| Updated documentation | GitHub |
| Test reports | Project documentation |

---

# 🚀 Expected Sprint Result

Sprint 2 will complete the database integration phase of the MythCore RPG Launcher project. All profile management features, user search functions, avatar persistence, and database relationships will be prepared for the social systems implemented during Sprint 3.