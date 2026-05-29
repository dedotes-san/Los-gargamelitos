# 🚀 Sprint 1 Backlog & Project Closure

This document contains the technical tasks, user stories, completed functionalities, acceptance criteria, validations, and closure documentation developed during **Sprint 1** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
February 13, 2026 — March 11, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Develop the authentication and social systems of the launcher, including registration, login, friend requests, rejection system, profile management, and database integration.

### Sprint Velocity:
15 Tasks Completed / 15 Planned (100% Velocity)

---

# 👥 Sprint Team Roles

| Member | Assigned Role | Responsibilities |
| :--- | :--- | :--- |
| A. Irvin | Analyst and Designer | ERD diagram design and process documentation |
| B. Dorian | SQL Developer | Table implementation, constraints, and database scripts |
| C. Dereck | Database Administrator (DBA) | File management, version control, and DB technical support |
| D. Manuel | Query Specialist | Test data insertion and SQL report generation |
| E. Carlos | SQL Tester | Integrity testing, query validation, and error control |

---

# 📌 Team Contribution Summary

Each team member contributed to the successful development of the MythCore RPG Launcher database and authentication systems during Sprint 1.

- The **Analyst and Designer** created the database structure and project documentation.
- The **SQL Developer** implemented relational tables, constraints, and SQL scripts.
- The **Database Administrator (DBA)** managed project files, database maintenance, and technical support.
- The **Query Specialist** generated SQL reports and inserted test records for validation.
- The **SQL Tester** validated data integrity, tested queries, and controlled database errors.

All responsibilities were completed successfully according to the sprint planning.

---

# 🛠️ Infrastructure & Database

## #INFRA-01 – Configure MySQL Database
* **Type:** Technical Task
* **Status:** Done
* **Responsible:** B. Dorian, C. Dereck

### Description
Creation and configuration of the MySQL database structure for the MythCore RPG Launcher using XAMPP and phpMyAdmin.

The following tables were created:
- `users`
- `friend_requests`
- `friends`
- `blocked_users`
- `messages`
- `games`
- `favorites`
- `reports`

### Closure Documentation
- Successful database connection using PHP and MySQL.
- Validation of primary keys and foreign keys.
- Test data inserted successfully.
- Database tested locally using XAMPP.
- Evidence available in the GitHub repository.

---

## #INFRA-02 – Configure Authentication System
* **Type:** Technical Task
* **Status:** Done
* **Responsible:** A. Irvin, C. Dereck

### Description
Implementation of the authentication system using PHP sessions and encrypted passwords.

### Closure Documentation
- Login validation implemented successfully.
- Secure session handling configured.
- Logout destroys active sessions correctly.
- Password hashing implemented with PHP security functions.
- Multiple login tests completed successfully.

---

# 👤 User Stories

## #US-01 – User Registration
* **Type:** User Story
* **Status:** Done
* **Responsible:** A. Irvin, E. Carlos

> **As a** new player,  
> **I want** to create an account with my credentials and personal information,  
> **so that** I can access the MythCore RPG Launcher platform securely.

### Acceptance Criteria Completed

#### Scenario: Successful registration
**Given** the user is on the registration page  
**When** the user enters a valid username, email, and password  
**And** submits the registration form  
**Then** the system creates a new account in the `users` table  
**And** redirects the user to the login page  
**And** displays a confirmation message

#### Scenario: Registration with existing username
**Given** the user is on the registration page  
**When** the user enters a username that already exists  
**Then** the system displays an error message  
**And** prevents account creation

#### Scenario: Registration with invalid email
**Given** the user is on the registration page  
**When** the user enters an email without the **@** symbol  
**Then** the system displays an invalid email message  
**And** prevents registration

#### Scenario: Empty fields
**Given** the user is on the registration page  
**When** required fields are empty  
**Then** the system prevents form submission  
**And** displays validation errors

#### Scenario: Weak password
**Given** the user is on the registration page  
**When** the password does not meet security requirements  
**Then** the system displays a password security warning

#### Scenario: Successful loading animation
**Given** the user submits the registration form  
**When** the system processes the registration  
**Then** a loading animation with a sword character is displayed

### Closure Documentation
- Registration form created successfully.
- Email validation with **@** symbol implemented.
- Duplicate users blocked correctly.
- Password security validation completed.
- Loading animation integrated successfully.
- Data stored correctly in MySQL database.
- 10 successful registration tests completed.

---

## #US-02 – User Login
* **Type:** User Story
* **Status:** Done
* **Responsible:** A. Irvin, E. Carlos

> **As a** registered player,  
> **I want** to log into the launcher,  
> **so that** I can access my profile and RPG services.

### Acceptance Criteria Completed

#### Scenario: Successful login
**Given** the user is registered  
**When** the user enters correct credentials  
**Then** the system authenticates the account  
**And** redirects the user to the dashboard

#### Scenario: Invalid credentials
**Given** the user is on the login page  
**When** incorrect credentials are entered  
**Then** the system displays an authentication error

### Closure Documentation
- PHP session system implemented successfully.
- Incorrect credentials validation working properly.
- Dashboard redirection configured.
- Multiple login tests executed successfully.

---

## #US-03 – User Logout
* **Type:** User Story
* **Status:** Done
* **Responsible:** A. Irvin

> **As a** logged-in player,  
> **I want** to close my session securely,  
> **so that** my account remains protected.

### Acceptance Criteria Completed

#### Scenario: Successful logout
**Given** the user is logged into the launcher  
**When** the user clicks the logout button  
**Then** the session is terminated  
**And** the user is redirected to the login screen

### Closure Documentation
- Session destruction implemented successfully.
- Protected routes redirect correctly after logout.
- Security validation completed successfully.

---

## #US-04 – Edit User Profile
* **Type:** User Story
* **Status:** Done
* **Responsible:** D. Manuel

> **As a** player,  
> **I want** to modify my profile information,  
> **so that** I can personalize my account.

### Acceptance Criteria Completed

#### Scenario: Successful profile update
**Given** the user is on their profile page  
**When** they modify their profile information  
**Then** the system updates the `users` table  
**And** displays the updated information

### Closure Documentation
- Profile editing interface completed.
- Avatar update system implemented.
- Changes persist correctly after reload.
- MySQL update queries tested successfully.

---

## #US-05 – Send Friend Request
* **Type:** User Story
* **Status:** Done
* **Responsible:** D. Manuel

> **As a** player,  
> **I want** to send friend requests to other users,  
> **so that** I can build my RPG community.

### Acceptance Criteria Completed

#### Scenario: Successful friend request
**Given** the user searches another player  
**When** the user clicks "Send Friend Request"  
**Then** the system creates a record in `friend_requests`

### Closure Documentation
- Friend request button implemented.
- Requests stored correctly in database.
- Pending state displayed successfully.
- Duplicate requests blocked correctly.

---

## #US-06 – Accept or Reject Friend Requests
* **Type:** User Story
* **Status:** Done
* **Responsible:** D. Manuel, E. Carlos

> **As a** player,  
> **I want** to manage incoming friend requests,  
> **so that** I can control my social connections.

### Acceptance Criteria Completed

#### Scenario: Accept request
**Given** the user has a pending friend request  
**When** the user accepts it  
**Then** the system creates a friendship record in `friends`

#### Scenario: Reject request
**Given** the user has a pending friend request  
**When** the user rejects the request  
**Then** the system removes the request from `friend_requests`  
**And** the pending button changes to "Add Friend"  
**And** the sender receives the message "Your friend request was rejected"

### Closure Documentation
- Accept and reject buttons implemented.
- Friend relationships stored correctly.
- Rejected requests removed automatically.
- Notification system functioning correctly.
- UI updates instantly after rejection.

---

## #US-07 – Block Users
* **Type:** User Story
* **Status:** Done
* **Responsible:** E. Carlos

> **As a** player,  
> **I want** to block toxic users,  
> **so that** I can avoid unwanted interactions.

### Acceptance Criteria Completed

#### Scenario: Block user successfully
**Given** the user selects another player  
**When** the block option is confirmed  
**Then** the system inserts a record into `blocked_users`

### Closure Documentation
- User blocking system completed.
- Blocked users cannot send requests or messages.
- Database validations completed successfully.

---

# 🧪 Testing Phase

| Test ID | Description | Result |
| :--- | :--- | :--- |
| TEST-01 | Valid registration | Passed |
| TEST-02 | Invalid email validation | Passed |
| TEST-03 | Empty fields validation | Passed |
| TEST-04 | Successful login | Passed |
| TEST-05 | Incorrect login | Passed |
| TEST-06 | Logout validation | Passed |
| TEST-07 | Send friend request | Passed |
| TEST-08 | Reject friend request | Passed |
| TEST-09 | Block user system | Passed |
| TEST-10 | Database connection | Passed |

---

# 📊 Sprint Summary

| Category | Total |
| :--- | :--- |
| User Stories Completed | 7 |
| Technical Tasks Completed | 2 |
| Tests Executed | 10 |
| Critical Errors | 0 |
| Sprint Velocity | 100% |

---

# ✅ Definition of Done

- Registration system connected to MySQL
- Login and logout fully functional
- Friend request system operational
- Reject request system implemented
- Validation with **@** symbol functioning
- Loading animation working correctly
- Database tested successfully
- Protected routes secured
- All sprint tasks completed
- GitHub repository updated successfully

---

# 🚀 Final Sprint Result

Sprint 1 was completed successfully.  
All planned tasks were delivered, tested, and integrated into the MythCore RPG Launcher repository without critical issues.
