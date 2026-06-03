# 🚀 Sprint Backlog 3 — MythCore RPG Launcher

This document contains the planned tasks, user stories, estimated hours, responsibilities, validations, and deliverables for **Sprint 3** of the **MythCore RPG Launcher** project.

---

# 📅 Sprint Information

### Sprint Duration:
April 20, 2026 — May 22, 2026

### Product Owner:
Jose Octavio Sánchez Contreras

### Sprint Goal:
Complete the social interaction system, friend management, notifications, reports, messaging features, and finalize all launcher functionalities for deployment.

### Sprint Velocity:
15 Tasks Planned / 15 Expected

---

# 👥 Sprint Team Roles

| Member | Assigned Role | Responsibilities |
| :--- | :--- | :--- |
| A. Irvin | Analyst and Designer | Interface improvements, documentation, social system design |
| B. Dorian | SQL Developer | New tables, constraints, stored procedures, optimization |
| C. Dereck | Database Administrator (DBA) | Database maintenance, backups, deployment support |
| D. Manuel | Query Specialist | Queries, notifications, reports, data generation |
| E. Carlos | SQL Tester | Functional testing, integrity validation, bug reporting |

---

# 🛠️ Infrastructure & Database

## #INFRA-03 – Social System Database Integration

* **Type:** Technical Task
* **Status:** In Progress
* **Responsible:** B. Dorian, C. Dereck

### Description

Expand the database structure to support social interactions between users.

Tasks include:

- Create relationships between `friend_requests` and `users`.
- Create relationships between `friends` and `users`.
- Add notification support for friendship actions.
- Optimize friendship lookup queries.
- Validate cascade delete behavior.
- Create indexes for social features.
- Verify referential integrity.

### Estimated Hours

**12 Hours**

---

## #INFRA-04 – Notification System

* **Type:** Technical Task
* **Status:** In Progress
* **Responsible:** D. Manuel, B. Dorian

### Description

Develop the notification system responsible for informing users about:

- Friend requests received.
- Friend requests accepted.
- Friend requests rejected.
- User reports.
- System alerts.

### Estimated Hours

**10 Hours**

---

# 👤 User Stories

---

## #US-11 – Real-Time Friend Request Notifications

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel

> **As a** player,
>
> **I want** to receive notifications when someone sends me a friend request,
>
> **so that** I can respond quickly.

### Acceptance Criteria

#### Scenario: Notification received

**Given** another player sends a friend request

**When** the request is stored

**Then** the system displays a notification

**And** updates the pending requests counter

### Estimated Hours

**6 Hours**

---

## #US-12 – Accept Friend Requests

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel

> **As a** player,
>
> **I want** to accept friend requests,
>
> **so that** I can add users to my friends list.

### Acceptance Criteria

#### Scenario: Request accepted

**Given** the user has a pending friend request

**When** the accept button is pressed

**Then** the system inserts records into `friends`

**And** removes the request from `friend_requests`

### Estimated Hours

**5 Hours**

---

## #US-13 – Reject Friend Requests

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** D. Manuel

> **As a** player,
>
> **I want** to reject friend requests,
>
> **so that** I can control who interacts with me.

### Acceptance Criteria

#### Scenario: Request rejected

**Given** the user has a pending friend request

**When** the reject button is pressed

**Then** the system removes the request from `friend_requests`

**And** changes the button from "Pending" to "Add Friend"

**And** displays the message:

*"Your friend request was rejected"*

### Estimated Hours

**5 Hours**

---

## #US-14 – Friends List

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin

> **As a** player,
>
> **I want** to see my friends list,
>
> **so that** I can manage my connections.

### Acceptance Criteria

#### Scenario: Friends loaded

**Given** the user has friends

**When** the friends page is opened

**Then** all accepted friendships are displayed

### Estimated Hours

**6 Hours**

---

## #US-15 – User Blocking System

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** E. Carlos

> **As a** player,
>
> **I want** to block unwanted users,
>
> **so that** they cannot interact with me.

### Acceptance Criteria

#### Scenario: User blocked

**Given** the user selects another player

**When** block is confirmed

**Then** a record is inserted into `blocked_users`

**And** the blocked user cannot send requests

### Estimated Hours

**5 Hours**

---

## #US-16 – Messaging System

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin

> **As a** player,
>
> **I want** to exchange messages with friends,
>
> **so that** we can communicate inside the launcher.

### Acceptance Criteria

#### Scenario: Message sent

**Given** two users are friends

**When** a message is sent

**Then** the system stores it in `messages`

**And** displays it in the conversation window

### Estimated Hours

**8 Hours**

---

## #US-17 – Report User

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** E. Carlos

> **As a** player,
>
> **I want** to report inappropriate users,
>
> **so that** administrators can review their behavior.

### Acceptance Criteria

#### Scenario: Report submitted

**Given** the user selects another player

**When** a report is submitted

**Then** the system stores the report in `reports`

### Estimated Hours

**5 Hours**

---

## #US-18 – Favorites System

* **Type:** User Story
* **Status:** In Progress
* **Responsible:** A. Irvin

> **As a** player,
>
> **I want** to save favorite games,
>
> **so that** I can access them quickly.

### Acceptance Criteria

#### Scenario: Add favorite

**Given** a game exists

**When** the user clicks favorite

**Then** the game is stored in `favorites`

### Estimated Hours

**4 Hours**

---

# 🧪 Testing Tasks

| Test ID | Description | Hours | Responsible |
| :--- | :--- | :---: | :--- |
| TEST-01 | Friend request validation | 3 h | Carlos |
| TEST-02 | Accept request validation | 2 h | Carlos |
| TEST-03 | Reject request validation | 2 h | Carlos |
| TEST-04 | Blocking system validation | 2 h | Carlos |
| TEST-05 | Messaging system validation | 3 h | Carlos |
| TEST-06 | Reports validation | 2 h | Carlos |
| TEST-07 | Notification validation | 2 h | Carlos |

---

# 📊 Hours Distribution by Team Member

| Member | Assigned Hours |
| :--- | :---: |
| A. Irvin | 22 h |
| B. Dorian | 18 h |
| C. Dereck | 12 h |
| D. Manuel | 20 h |
| E. Carlos | 18 h |
| **Total Sprint Hours** | **90 h** |

---

# ✅ Definition of Done

- [x] Create friendship relationships in database
- [x] Implement notification system
- [x] Implement friend request system
- [x] Implement accept request feature
- [x] Implement reject request feature
- [x] Change "Pending" button to "Add Friend" after rejection
- [x] Display rejection notification message
- [x] Create friends list
- [x] Implement blocking system
- [x] Implement messaging system
- [x] Implement report system
- [x] Implement favorites system
- [x] Validate database integrity
- [x] Execute all functional tests
- [x] Upload final version to GitHub repository
- [x] Update project documentation

---

# 📦 Expected Deliverables

| Deliverable | Location |
| :--- | :--- |
| Friendship System | Repository |
| Notification System | Repository |
| Messaging System | Repository |
| Blocking System | Repository |
| Reporting System | Repository |
| Favorites System | Repository |
| Updated Database | MySQL |
| Test Documentation | GitHub |

---

# 🚀 Expected Sprint Result

Sprint 3 will complete all social and interaction features of the MythCore RPG Launcher, including friend management, messaging, notifications, reports, favorites, and user moderation systems. All planned functionalities will be integrated, tested, and documented before project delivery.