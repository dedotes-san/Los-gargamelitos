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
**Type:** Technical Task  
**Status:** In Progress  
**Responsible:** B. Dorian, C. Dereck  

### Description
Design, create, and configure the MySQL database structure for the MythCore RPG Launcher project using XAMPP, phpMyAdmin, PHP, and MySQL relational databases.

The objective of this task is to build the complete database structure required for the launcher systems, including authentication, social interaction, messaging, moderation, and game management features.

The following technical tasks will be performed during this activity:

- Create the `users` table to store player account information
- Configure primary keys for all database tables
- Create the `friend_requests` table to manage pending friendship requests
- Configure foreign keys between `users` and `friend_requests`
- Create the `friends` table to store accepted friendships
- Create the `blocked_users` table to prevent unwanted interactions
- Create the `messages` table for the private messaging system
- Create the `games` table to store RPG game information
- Create the `favorites` table to manage favorite games
- Create the `reports` table for moderation and user reports
- Configure relational integrity between all tables
- Validate foreign key restrictions and cascading relationships
- Configure the PHP connection to the MySQL database
- Test SQL queries for insert, update, delete, and select operations
- Insert test records for database validation
- Verify compatibility with phpMyAdmin and XAMPP
- Organize SQL scripts and database files inside the GitHub repository
- Validate database functionality locally before integration with the launcher system

### Expected Closure Documentation
- Successful database connection using PHP and MySQL
- Validation of primary keys and foreign keys completed successfully
- SQL relational structure tested correctly
- Test data inserted into all required tables
- CRUD operations validated successfully
- Local testing completed using XAMPP and phpMyAdmin
- SQL scripts uploaded to the GitHub repository
- Database documentation completed successfully

---

## #INFRA-02 – Configure Authentication System
**Type:** Technical Task  
**Status:** In Progress  
**Responsible:** A. Irvin, C. Dereck  

### Description
Develop and configure the authentication system for the MythCore RPG Launcher using PHP sessions, MySQL queries, encrypted passwords, and secure session management.

The authentication system will allow users to register, log in, maintain active sessions securely, and log out safely while protecting private routes inside the launcher.

The following technical tasks will be completed during this activity:

- Create the user login validation system
- Configure PHP session initialization
- Validate credentials using MySQL queries
- Compare encrypted passwords securely
- Implement password encryption using `password_hash()`
- Configure password verification using `password_verify()`
- Create secure logout functionality
- Destroy active sessions correctly after logout
- Protect private routes using session validation
- Redirect unauthorized users to the login page
- Validate incorrect login credentials
- Display authentication error messages
- Validate empty login fields
- Configure secure session persistence
- Test multiple login attempts
- Validate login functionality using registered users
- Test session behavior after page refresh
- Validate access restrictions after logout
- Verify authentication compatibility with MySQL database
- Upload authentication files and documentation to GitHub repository

### Expected Closure Documentation
- Login validation configured successfully
- PHP sessions working correctly
- Secure logout functionality implemented
- Password encryption validated successfully
- Invalid credential validation functioning correctly
- Protected routes secured successfully
- Session persistence tested successfully
- Authentication system integrated with MySQL database
- Multiple login tests completed successfully
- Authentication documentation uploaded to GitHub repository
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

- [x] Configure MySQL database
- [x] Create users table
- [x] Create friend request system
- [x] Configure login system
- [x] Configure logout system
- [x] Implement profile management
- [x] Add avatar update system
- [x] Implement email validation with @
- [x] Implement password validation
- [x] Create loading animation with sword character
- [x] Implement accept friend request feature
- [x] Implement reject friend request feature
- [x] Change pending button to "Add Friend" after rejection
- [x] Display rejection notification message
- [x] Configure blocked users system
- [x] Test database connection
- [x] Validate authentication system
- [x] Validate protected routes
- [x] Upload project to GitHub repository
- [x] Complete Sprint 1 documentation

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
