# SOFTWARE REQUIREMENTS SPECIFICATION (SRS)

# MythCore RPG Launcher

**Version:** 1.0  
**Institution:** CBTis 47  
**Project:** MythCore RPG Launcher  
**Development Team:**

- A. Irvin Hernández Trejo
- B. Dorian
- C. Dereck
- D. Manuel
- E. Carlos

**Product Owner:** Jose Octavio Sánchez Contreras

---

# 1. Introduction

## 1.1 Purpose

The purpose of this Software Requirements Specification (SRS) document is to define the functional and non-functional requirements of the MythCore RPG Launcher system.

The system allows users to create accounts, log in securely, manage profiles, send friend requests, accept or reject requests, block users, exchange messages, manage favorite games, and interact with social features integrated into the launcher.

This document serves as a reference for developers, testers, stakeholders, and project managers throughout the software development lifecycle.

---

## 1.2 Scope

MythCore RPG Launcher is a desktop launcher focused on RPG communities.

The system provides:

- User registration.
- Secure login and logout.
- User profile management.
- Avatar customization.
- Friend request management.
- Friend acceptance and rejection.
- User blocking.
- Messaging system.
- Favorite games management.
- MySQL database integration.
- Session management.
- Administrative support features.

The application will be developed using:

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- XAMPP
- phpMyAdmin
- GitHub

---

## 1.3 Definitions, Acronyms and Abbreviations

| Term | Definition |
|--------|------------|
| RPG | Role Playing Game |
| DB | Database |
| MySQL | Relational Database Management System |
| PHP | Hypertext Preprocessor |
| CRUD | Create, Read, Update, Delete |
| UI | User Interface |
| UX | User Experience |
| SRS | Software Requirements Specification |
| DBA | Database Administrator |
| SQL | Structured Query Language |

---

## 1.4 References

- IEEE 830 Software Requirements Specification Standard
- Scrum Guide 2020
- PHP Official Documentation
- MySQL Official Documentation
- GitHub Documentation

---

## 1.5 Overview

This document contains:

- Functional Requirements
- Non-Functional Requirements
- User Interface Requirements
- Database Requirements
- Security Requirements
- Business Rules
- System Constraints

---

# 2. Overall Description

## 2.1 Product Perspective

MythCore RPG Launcher is a standalone application connected to a MySQL database.

The launcher acts as a central platform where users can manage their accounts, communicate with friends, customize profiles, and organize RPG-related activities.

The system interacts directly with the database to manage authentication, user information, social relationships, messages, and game preferences.

---

## 2.2 Assumptions and Dependencies

The system assumes:

- MySQL Server is available.
- XAMPP services are running correctly.
- PHP version 8.0 or higher is installed.
- Users have internet access when required.
- GitHub repository access is available.
- Database credentials are configured correctly.

Dependencies include:

- PHP
- MySQL
- Apache
- XAMPP
- GitHub

---

# 3. System Features and Requirements

## 3.1 Functional Requirements

### Authentication

**FR-01**  
The system shall allow new users to register using a username, email address, and password.

**FR-02**  
The system shall validate that the username does not already exist in the database.

**FR-03**  
The system shall validate that the email format is correct.

**FR-04**  
The system shall prevent registration when required fields are empty.

**FR-05**  
The system shall store passwords using PHP password hashing functions.

**FR-06**  
The system shall authenticate users using stored credentials.

**FR-07**  
The system shall redirect authenticated users to the main dashboard.

**FR-08**  
The system shall display an error message when incorrect credentials are entered.

**FR-09**  
The system shall allow users to log out at any time.

**FR-10**  
The system shall destroy active sessions during logout.

---

### User Profile Management

**FR-11**  
The system shall allow users to edit their profile information.

**FR-12**  
The system shall allow users to update their avatar image.

**FR-13**  
The system shall store avatar information in the users table.

**FR-14**  
The system shall display the selected avatar after login.

---

### Friend Request System

**FR-15**  
The system shall allow users to search for other registered users.

**FR-16**  
The system shall allow users to send friend requests.

**FR-17**  
The system shall prevent duplicate friend requests.

**FR-18**  
The system shall store friend requests in the friend_requests table.

**FR-19**  
The system shall allow users to accept friend requests.

**FR-20**  
The system shall create friendship records in the friends table after acceptance.

**FR-21**  
The system shall allow users to reject friend requests.

**FR-22**  
The system shall remove rejected requests automatically.

**FR-23**  
The system shall notify the sender when a request is rejected.

---

### User Blocking

**FR-24**  
The system shall allow users to block other users.

**FR-25**  
The system shall store blocked users in the blocked_users table.

**FR-26**  
Blocked users shall not be able to send friend requests.

**FR-27**  
Blocked users shall not be able to send messages.

---

### Messaging System

**FR-28**  
The system shall allow users to send messages to friends.

**FR-29**  
The system shall store messages in the messages table.

**FR-30**  
The system shall display conversation history.

---

### Favorite Games

**FR-31**  
The system shall allow users to add games to favorites.

**FR-32**  
The system shall allow users to remove games from favorites.

**FR-33**  
The system shall display favorite games in the user profile.

---

## 3.2 Non-Functional Requirements

### Performance Requirements

**NFR-01**  
The login process shall complete in less than 3 seconds.

**NFR-02**  
Database queries shall return results within 2 seconds under normal conditions.

**NFR-03**  
Profile updates shall be reflected immediately after saving.

---

### Security Requirements

**NFR-04**  
Passwords shall never be stored in plain text.

**NFR-05**  
All protected pages shall require authentication.

**NFR-06**  
SQL Injection attacks shall be prevented using prepared statements.

**NFR-07**  
Sessions shall expire automatically after inactivity.

---

### Reliability Requirements

**NFR-08**  
The system shall maintain database consistency during transactions.

**NFR-09**  
Friendship records shall not be duplicated.

**NFR-10**  
Message records shall remain available after user logout.

---

### Maintainability Requirements

**NFR-11**  
Source code shall be documented.

**NFR-12**  
Database scripts shall be version controlled using GitHub.

**NFR-13**  
The project repository shall include installation instructions.

---

## 3.3 External Interface Requirements

### User Interface Requirements

**UI-01**  
The system shall provide a login page.

**UI-02**  
The system shall provide a registration page.

**UI-03**  
The system shall provide a profile management page.

**UI-04**  
The system shall provide a friend management interface.

**UI-05**  
The system shall provide a messaging interface.

**UI-06**  
The system shall display avatars throughout the application.

---

### Database Interface Requirements

The system shall interact with the following tables:

- users
- friend_requests
- friends
- blocked_users
- messages
- games
- favorites
- reports

Primary keys and foreign keys shall be enforced to guarantee database integrity.

---

### Business Rules

**BR-01**  
A username can belong to only one account.

**BR-02**  
An email address can belong to only one account.

**BR-03**  
Blocked users cannot send friend requests.

**BR-04**  
Blocked users cannot send messages.

**BR-05**  
Only authenticated users can access protected pages.

---

# 4. Constraints

**C-01**  
The project shall use PHP as the backend language.

**C-02**  
The database shall be implemented using MySQL.

**C-03**  
The project shall run locally using XAMPP.

**C-04**  
The project shall be managed using GitHub.

**C-05**  
The system is intended exclusively for educational purposes.

---

# 5. Conclusion

This Software Requirements Specification (SRS) defines the complete set of requirements necessary for the successful development, testing, deployment, and maintenance of the MythCore RPG Launcher.

All requirements described in this document must be satisfied before the project is considered complete and accepted by the Product Owner.