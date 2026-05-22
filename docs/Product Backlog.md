# Product Backlog — MythCore RPG Launcher
RPG Social Platform · CBTis 47  
Stack: PHP · MySQL · Pusher JS · XAMPP · GitHub

---

# 🎯 Product Goal

Enable players to register, interact, communicate, manage their RPG library, and participate in a secure gaming community through a centralized launcher system that integrates social interaction, moderation, rankings, and personalized game management.

---

# 📦 Epics

| ID | Epic Name | Audience | Priority |
| :--- | :--- | :--- | :--- |
| EP-01 | User Authentication | User | High |
| EP-02 | User Profile Management | User | High |
| EP-03 | Social System | User | High |
| EP-04 | RPG Chat System | User | High |
| EP-05 | Game Library Management | User | High |
| EP-06 | Ranking & XP System | User | Medium |
| EP-07 | Moderation & Reports | Moderator / Admin | High |
| EP-08 | Administration Panel | Administrator | High |

---

# 📊 Backlog Summary

| Story ID | User Story | Epic | Role | Priority | Points |
| :--- | :--- | :--- | :--- | :--- | :--- |
| US-01 | User Registration | EP-01 | User | High | 5 |
| US-02 | User Login | EP-01 | User | High | 3 |
| US-03 | User Logout | EP-01 | User | Medium | 1 |
| US-04 | Edit User Profile | EP-02 | User | Medium | 3 |
| US-05 | Send Friend Request | EP-03 | User | High | 5 |
| US-06 | Accept or Reject Friend Requests | EP-03 | User | High | 3 |
| US-07 | Block Users | EP-03 | User | Medium | 3 |
| US-08 | Real-Time RPG Chat | EP-04 | User | High | 5 |
| US-09 | Send Messages | EP-04 | User | High | 3 |
| US-10 | Browse RPG Library | EP-05 | User | High | 5 |
| US-11 | Add Games to Favorites | EP-05 | User | Medium | 2 |
| US-12 | Create Custom Games | EP-05 | User | Medium | 5 |
| US-13 | View Rankings | EP-06 | User | Medium | 3 |
| US-14 | Gain XP and Achievements | EP-06 | User | Medium | 5 |
| US-15 | Report Users | EP-07 | User | High | 5 |
| US-16 | View User Reports | EP-07 | Moderator / Admin | High | 3 |
| US-17 | Manage Users | EP-08 | Administrator | High | 5 |
| US-18 | Manage Games | EP-08 | Administrator | High | 5 |
| US-19 | Manage Categories | EP-08 | Administrator | Medium | 3 |
| US-20 | Manage Reports | EP-08 | Administrator | High | 5 |

|  |  |  | **Total** |  | **74** |

---

# EP-01 · User Authentication

## US-01 — User Registration

As a new player, I want to create an account with my credentials and personal information, so that I can access the MythCore RPG Launcher platform securely.

**Priority:** High | **Story Points:** 5

### Acceptance Criteria

### Feature: User Registration

#### Scenario: Successful registration
Given the user is on the registration page  
When the user enters a valid username, email, and password  
And submits the registration form  
Then the system creates a new account in the `users` table  
And redirects the user to the login page  
And displays a confirmation message

#### Scenario: Registration with existing username
Given the user is on the registration page  
When the user enters a username that already exists  
Then the system displays an error message  
And prevents account creation

---

## US-02 — User Login

As a registered player, I want to log into the launcher, so that I can access my profile and RPG services.

**Priority:** High | **Story Points:** 3

### Acceptance Criteria

### Feature: User Login

#### Scenario: Successful login
Given the user is registered  
When the user enters correct credentials  
Then the system authenticates the account  
And redirects the user to the dashboard

#### Scenario: Invalid credentials
Given the user is on the login page  
When incorrect credentials are entered  
Then the system displays an authentication error

---

## US-03 — User Logout

As a logged-in player, I want to close my session securely, so that my account remains protected.

**Priority:** Medium | **Story Points:** 1

### Acceptance Criteria

### Feature: User Logout

#### Scenario: Successful logout
Given the user is logged into the launcher  
When the user clicks the logout button  
Then the session is terminated  
And the user is redirected to the login screen

---

# EP-02 · User Profile Management

## US-04 — Edit User Profile

As a player, I want to modify my profile information, so that I can personalize my account.

**Priority:** Medium | **Story Points:** 3

### Acceptance Criteria

### Feature: Profile Management

#### Scenario: Successful profile update
Given the user is on their profile page  
When they modify their profile information  
Then the system updates the `users` table  
And displays the updated information

---

# EP-03 · Social System

## US-05 — Send Friend Request

As a player, I want to send friend requests to other users, so that I can build my RPG community.

**Priority:** High | **Story Points:** 5

### Acceptance Criteria

### Feature: Friend Requests

#### Scenario: Successful friend request
Given the user searches another player  
When the user clicks "Send Friend Request"  
Then the system creates a record in `friend_requests`

---

## US-06 — Accept or Reject Friend Requests

As a player, I want to manage incoming friend requests, so that I can control my social connections.

**Priority:** High | **Story Points:** 3

### Acceptance Criteria

### Feature: Friend Request Management

#### Scenario: Accept request
Given the user has a pending friend request  
When the user accepts it  
Then the system creates a friendship record in `friends`

---

## US-07 — Block Users

As a player, I want to block toxic users, so that I can avoid unwanted interactions.

**Priority:** Medium | **Story Points:** 3

### Acceptance Criteria

### Feature: User Blocking

#### Scenario: Block user successfully
Given the user selects another player  
When the block option is confirmed  
Then the system inserts a record into `blocked_users`

---

# EP-04 · RPG Chat System

## US-08 — Real-Time RPG Chat

As a player, I want to communicate in real time through the RPG chat, so that I can interact instantly with friends.

**Priority:** High | **Story Points:** 5

### Acceptance Criteria

### Feature: Real-Time Chat

#### Scenario: Real-time communication
Given two users are online  
When a message is sent  
Then the message appears instantly using Pusher JS

---

## US-09 — Send Messages

As a player, I want to send messages to friends, so that I can communicate privately.

**Priority:** High | **Story Points:** 3

### Acceptance Criteria

### Feature: Private Messaging

#### Scenario: Send private message
Given two users are friends  
When one user sends a message  
Then the system stores the message in `messages`

---

# EP-05 · Game Library Management

## US-10 — Browse RPG Library

As a player, I want to browse the game catalog, so that I can discover RPG titles.

**Priority:** High | **Story Points:** 5

### Acceptance Criteria

### Feature: Game Library

#### Scenario: Display RPG games
Given the user enters the library section  
When the page loads  
Then the system displays all records from `games`

---

## US-11 — Add Games to Favorites

As a player, I want to save favorite games, so that I can access them quickly later.

**Priority:** Medium | **Story Points:** 2

### Acceptance Criteria

### Feature: Favorites

#### Scenario: Add favorite game
Given the user selects a game  
When the favorite button is pressed  
Then the system inserts a record into `favorites`

---

## US-12 — Create Custom Games

As a player, I want to create custom RPG entries, so that I can personalize my library.

**Priority:** Medium | **Story Points:** 5

### Acceptance Criteria

### Feature: Custom Games

#### Scenario: Create custom RPG
Given the user fills the custom game form  
When the form is submitted  
Then the system stores the game in `games`

---

# EP-06 · Ranking & XP System

## US-13 — View Rankings

As a player, I want to see rankings, so that I can compare my progress with others.

**Priority:** Medium | **Story Points:** 3

### Acceptance Criteria

### Feature: Rankings

#### Scenario: Display ranking board
Given the user opens the ranking section  
When the page loads  
Then the system displays players ordered by XP

---

## US-14 — Gain XP and Achievements

As a player, I want to earn XP and achievements, so that I can track my progression.

**Priority:** Medium | **Story Points:** 5

### Acceptance Criteria

### Feature: XP System

#### Scenario: Gain XP
Given the user completes activities in the launcher  
When XP conditions are met  
Then the system updates the player's XP and achievements

---

# EP-07 · Moderation & Reports

## US-15 — Report Users

As a player, I want to report inappropriate behavior, so that moderators can review incidents.

**Priority:** High | **Story Points:** 5

### Acceptance Criteria

### Feature: User Reports

#### Scenario: Successful report
Given the user selects another player  
When the report form is submitted  
Then the system inserts a record into `reports`

---

## US-16 — View User Reports

As a moderator or administrator, I want to review reports, so that I can take moderation actions.

**Priority:** High | **Story Points:** 3

### Acceptance Criteria

### Feature: Report Management

#### Scenario: View reports
Given the moderator accesses the reports section  
When the page loads  
Then the system displays all records from `reports`

---

# EP-08 · Administration Panel

## US-17 — Manage Users

As an administrator, I want to manage users, so that I can maintain platform integrity.

**Priority:** High | **Story Points:** 5

---

## US-18 — Manage Games

As an administrator, I want to manage the RPG catalog, so that the library remains updated.

**Priority:** High | **Story Points:** 5

---

## US-19 — Manage Categories

As an administrator, I want to organize RPG categories, so that games are classified correctly.

**Priority:** Medium | **Story Points:** 3

---

## US-20 — Manage Reports

As an administrator, I want to resolve reports and moderate users, so that the community remains safe.

**Priority:** High | **Story Points:** 5

---

# 📈 Story Points Summary

| Epic | Stories | Total Points |
| :--- | :--- | :--- |
| EP-01 · User Authentication | US-01, US-02, US-03 | 9 |
| EP-02 · User Profile Management | US-04 | 3 |
| EP-03 · Social System | US-05, US-06, US-07 | 11 |
| EP-04 · RPG Chat System | US-08, US-09 | 8 |
| EP-05 · Game Library Management | US-10, US-11, US-12 | 12 |
| EP-06 · Ranking & XP System | US-13, US-14 | 8 |
| EP-07 · Moderation & Reports | US-15, US-16 | 8 |
| EP-08 · Administration Panel | US-17, US-18, US-19, US-20 | 18 |

| **Grand Total** | **20 Stories** | **74 pts** |
