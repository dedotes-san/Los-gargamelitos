# 🚀 Sprint 1 Backlog & Project Closure

This document contains the technical tasks, user stories, planned functionalities, acceptance criteria, validations, and project documentation for **Sprint 1** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
February 13, 2026 — March 11, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Develop the authentication and social systems of the launcher, including registration, login, friend requests, rejection system, profile management, and database integration.

### Sprint Velocity:
15 Tasks Planned / 15 Expected

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

Each team member will contribute to the successful development of the MythCore RPG Launcher database and authentication systems during Sprint 1.

- The **Analyst and Designer** will create the database structure and project documentation.
- The **SQL Developer** will implement relational tables, constraints, and SQL scripts.
- The **Database Administrator (DBA)** will manage project files, database maintenance, and technical support.
- The **Query Specialist** will generate SQL reports and insert test records for validation.
- The **SQL Tester** will validate data integrity, test queries, and control database errors.

All responsibilities will be completed according to the sprint planning.

---

# 🛠️ Infrastructure & Database

## #INFRA-01 – Configure MySQL Database
* **Type:** Technical Task
* **Status:** In Progress
* **Responsible:** B. Dorian, C. Dereck

### Description
Creation and configuration of the MySQL database structure for the MythCore RPG Launcher using XAMPP and phpMyAdmin.

The following tables will be created:
- `users`
- `friend_requests`
- `friends`
- `blocked_users`
- `messages`
- `games`
- `favorites`
- `reports`

### Expected Closure Documentation
- Successful database connection using PHP and MySQL.
- Validation of primary keys and foreign keys.
- Test data insertion.
- Local testing using XAMPP.
- Evidence uploaded to the GitHub repository.

---

## #INFRA-02 – Configure Authentication System
* **Type:** Technical Task
* **Status:** In Progress
* **Responsible:** A. Irvin, C. Dereck

### Description
Implementation of the authentication system using PHP sessions and encrypted passwords.

### Expected Closure Documentation
- Login validation configured successfully.
- Secure session handling implemented.
- Logout destroys active sessions correctly.
- Password hashing implemented using PHP security functions.
- Multiple login tests executed successfully.

---

# 👤 User Stories

## #US-01 – User Registration
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin, E. Carlos

> **As a** new player,  
> **I want** to create an account with my credentials and personal information,  
> **so that** I can access the MythCore RPG Launcher platform securely.

### Acceptance Criteria

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

### Expected Closure Documentation
- Registration form configured successfully.
- Email validation with **@** symbol implemented.
- Duplicate user prevention configured.
- Password validation implemented.
- Loading animation integrated successfully.
- MySQL insertion tested successfully.

---

## #US-02 – User Login
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin, E. Carlos

> **As a** registered player,  
> **I want** to log into the launcher,  
> **so that** I can access my profile and RPG services.

### Acceptance Criteria

#### Scenario: Successful login
**Given** the user is registered  
**When** the user enters correct credentials  
**Then** the system authenticates the account  
**And** redirects the user to the dashboard

#### Scenario: Invalid credentials
**Given** the user is on the login page  
**When** incorrect credentials are entered  
**Then** the system displays an authentication error

### Expected Closure Documentation
- PHP session system configured successfully.
- Invalid credential validation implemented.
- Dashboard redirection configured correctly.

---

## #US-03 – User Logout
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin

> **As a** logged-in player,  
> **I want** to close my session securely,  
> **so that** my account remains protected.

### Acceptance Criteria

#### Scenario: Successful logout
**Given** the user is logged into the launcher  
**When** the user clicks the logout button  
**Then** the session is terminated  
**And** the user is redirected to the login screen

### Expected Closure Documentation
- Logout system configured correctly.
- Session destruction validated successfully.
- Protected routes secured after logout.

---

## #US-04 – Edit User Profile
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel

> **As a** player,  
> **I want** to modify my profile information,  
> **so that** I can personalize my account.

### Acceptance Criteria

#### Scenario: Successful profile update
**Given** the user is on their profile page  
**When** they modify their profile information  
**Then** the system updates the `users` table  
**And** displays the updated information

### Expected Closure Documentation
- Profile editing interface implemented.
- Avatar update system configured.
- Changes saved correctly in MySQL.

---

## #US-05 – Send Friend Request
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel

> **As a** player,  
> **I want** to send friend requests to other users,  
> **so that** I can build my RPG community.

### Acceptance Criteria

#### Scenario: Successful friend request
**Given** the user searches another player  
**When** the user clicks "Send Friend Request"  
**Then** the system creates a record in `friend_requests`

### Expected Closure Documentation
- Friend request button configured.
- Requests stored correctly in database.
- Duplicate request prevention implemented.

---

## #US-06 – Accept or Reject Friend Requests
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel, E. Carlos

> **As a** player,  
> **I want** to manage incoming friend requests,  
> **so that** I can control my social connections.

### Acceptance Criteria

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

### Expected Closure Documentation
- Accept and reject buttons implemented.
- Friend relationships stored correctly.
- Rejected requests removed automatically.
- Notification system configured successfully.

---

## #US-07 – Block Users
* **Type:** User Story
* **Status:** In Progress
* **Responsible:** E. Carlos

> **As a** player,  
> **I want** to block toxic users,  
> **so that** I can avoid unwanted interactions.

### Acceptance Criteria

#### Scenario: Block user successfully
**Given** the user selects another player  
**When** the block option is confirmed  
**Then** the system inserts a record into `blocked_users`

### Expected Closure Documentation
- User blocking system implemented.
- Blocked users prevented from sending requests and messages.
- Database validation completed successfully.

---

# ✅ Sprint Checklist

- [ ] Configure MySQL database
- [ ] Create users table
- [ ] Create friend request system
- [ ] Configure login system
- [ ] Configure logout system
- [ ] Implement profile management
- [ ] Add avatar update system
- [ ] Implement email validation with @
- [ ] Implement password validation
- [ ] Create loading animation with sword character
- [ ] Implement accept friend request feature
- [ ] Implement reject friend request feature
- [ ] Change pending button to "Add Friend" after rejection
- [ ] Display rejection notification message
- [ ] Configure blocked users system
- [ ] Test database connection
- [ ] Validate authentication system
- [ ] Validate protected routes
- [ ] Upload project to GitHub repository
- [ ] Complete Sprint 1 documentation

---

# 📊 Sprint Summary

| Category | Total |
| :--- | :--- |
| User Stories Planned | 7 |
| Technical Tasks Planned | 2 |
| Planned Tests | 10 |
| Expected Critical Errors | 0 |
| Expected Sprint Velocity | 100% |

---

# ✅ Definition of Done

- Registration system will be connected to MySQL
- Login and logout will function correctly
- Friend request system will operate successfully
- Reject request system will be implemented
- Validation with **@** symbol will function properly
- Loading animation with sword character will display correctly
- Database tests will be completed successfully
- Protected routes will remain secured
- All sprint tasks will be completed
- GitHub repository will be updated successfully

---

# 🚀 Final Sprint Result

Sprint 1 will be completed successfully.  
All planned tasks will be delivered, tested, and integrated into the MythCore RPG Launcher repository without critical issues.
