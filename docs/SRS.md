# 📋 Software Requirements Specification (SRS)

## MythCore RPG Launcher

### Version 1.0
### CBTis 47

---

# 1. Functional Requirements (Agile & UI/UX)

Functional requirements describe the features and services that the MythCore RPG Launcher must provide to users.

---

## 1.1 Authentication

FR-01. The system must allow new users to register with a username, email address, password, and profile avatar.

FR-02. The system must validate that the username and email are not already registered in the users table.

FR-03. The system must display validation messages when required fields are left empty.

FR-04. The system must verify that the email contains a valid format including the "@" symbol.

FR-05. The system must validate password security requirements before account creation.

FR-06. The system must authenticate users using their username and password.

FR-07. The system must redirect authenticated users to the main launcher page.

FR-08. The system must allow users to log out at any time.

FR-09. After logout, protected pages must require authentication again.

FR-10. The system must display a loading animation with a sword character while processing registration.

---

## 1.2 User Profile

FR-11. The system must allow users to view their profile information.

FR-12. The system must allow users to modify profile information.

FR-13. The system must allow users to change their profile avatar.

FR-14. The selected avatar must be stored in MySQL and persist after future logins.

---

## 1.3 Friend Request System

FR-15. The system must allow users to search for other players.

FR-16. The system must allow users to send friend requests.

FR-17. The system must prevent duplicate friend requests.

FR-18. The system must display pending requests.

FR-19. The system must allow users to accept incoming friend requests.

FR-20. When a request is accepted, a new record must be created in the friends table.

FR-21. The system must allow users to reject incoming friend requests.

FR-22. When a request is rejected, the request must be removed from the friend_requests table.

FR-23. When a request is rejected, the button status must change from Pending to Add Friend.

FR-24. The sender must receive the notification:

"Your friend request was rejected."

---

## 1.4 Messaging System

FR-25. The system must allow friends to exchange messages.

FR-26. Messages must be stored in the messages table.

FR-27. The system must display conversation history.

FR-28. The system must display the sender username and timestamp.

---

## 1.5 Blocking System

FR-29. The system must allow users to block other players.

FR-30. Blocked users must not be able to send friend requests.

FR-31. Blocked users must not be able to send messages.

FR-32. The system must store blocked users in the blocked_users table.

---

## 1.6 Reports System

FR-33. The system must allow users to report inappropriate behavior.

FR-34. Reports must be stored in the reports table.

FR-35. The report must include the reported user, description, date, and reporter.

---

## 1.7 Game Library

FR-36. The system must display available RPG games.

FR-37. The system must allow users to add games to favorites.

FR-38. Favorite games must be stored in the favorites table.

FR-39. Users must be able to view their favorite games list.

---

# 2. Agile Requirements

AG-01. The project must be developed using Scrum methodology.

AG-02. The project must be divided into Sprint 1, Sprint 2, and Sprint 3.

AG-03. Every User Story must follow the format:

As a [user], I want [action], so that [benefit].

AG-04. Every User Story must contain Gherkin acceptance criteria using Given, When, and Then.

AG-05. Each User Story must have Story Points assigned.

AG-06. The Product Backlog must be prioritized.

AG-07. Sprint Reviews must be conducted after each Sprint.

AG-08. Source code must be managed using GitHub.

AG-09. Every team member must contribute using their own GitHub account.

AG-10. Sprint documentation must be updated throughout the project.

---

# 3. UI/UX Requirements

## 3.1 General Interface

UX-01. The launcher must maintain a consistent RPG visual theme.

UX-02. All pages must use the same color palette and typography.

UX-03. Navigation must be accessible through a persistent menu.

UX-04. Action buttons must clearly describe their purpose.

UX-05. Loading indicators must be displayed during server operations.

---

## 3.2 Forms and Validation

UX-06. Required fields must be clearly identified.

UX-07. Validation errors must appear below the corresponding field.

UX-08. Passwords must be hidden by default.

UX-09. Users must receive confirmation messages after successful registration and login.

---

## 3.3 Friend System

UX-10. Friend request status must be visually distinguishable.

UX-11. Pending requests must display a "Pending" label.

UX-12. Rejected requests must return to the "Add Friend" state.

UX-13. Acceptance and rejection buttons must remain visible until a decision is made.

---

# 4. Non-Functional Requirements

## 4.1 Performance

NFR-01. Login operations must complete within 3 seconds.

NFR-02. User searches must return results within 2 seconds.

NFR-03. Profile updates must be processed within 3 seconds.

---

## 4.2 Security

NFR-04. Passwords must be encrypted using PHP password_hash() functions.

NFR-05. Protected pages must require an authenticated session.

NFR-06. SQL Injection protection must be implemented using prepared statements.

NFR-07. User sessions must be securely managed through PHP sessions.

---

## 4.3 Reliability

NFR-08. Friend request records must remain consistent after acceptance or rejection.

NFR-09. Avatar changes must persist between sessions.

NFR-10. Messages must not be lost during normal operation.

---

## 4.4 Usability

NFR-11. New users must be able to create an account without assistance.

NFR-12. Error messages must clearly explain the problem.

NFR-13. The launcher must operate entirely through a web browser.

---

## 4.5 Maintainability

NFR-14. Source code must be organized into modules.

NFR-15. Database scripts must be documented.

NFR-16. The GitHub repository must include installation instructions.

---

## 4.6 Constraints

NFR-17. The project must be developed using HTML5, CSS3, JavaScript, PHP, and MySQL.

NFR-18. XAMPP will be used as the local development environment.

NFR-19. phpMyAdmin will be used for database management.

NFR-20. The system is intended exclusively for academic purposes within CBTis 47.

NFR-21. The system must support modern Chromium-based browsers.

---

# 👥 Development Team

| Member | Role |
|----------|----------|
| A. Irvin | Analyst and Designer |
| B. Dorian | SQL Developer |
| C. Dereck | Database Administrator (DBA) |
| D. Manuel | Query Specialist |
| E. Carlos | SQL Tester |

---

# 📌 Project Information

**Project Name:** MythCore RPG Launcher

**Institution:** CBTis 47

**Version:** 1.0

**Methodology:** Scrum

**Database:** MySQL (phpMyAdmin)

**Development Environment:** XAMPP

**Repository:** GitHub