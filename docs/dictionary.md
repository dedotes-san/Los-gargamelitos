# 📚 Data Dictionary – RPG Launcher Database

This document describes the structure of the RPG Launcher database, including all tables, fields, and relationships.

---

# TABLE: users

Stores registered users.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Unique user identifier |
| username | VARCHAR(50) | Username |
| email | VARCHAR(150) | Email address |
| password | VARCHAR(255) | Encrypted password |
| status | VARCHAR(20) | Account status |
| created_at | DATETIME | Account creation date |

---

# TABLE: games

Stores available games.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Game identifier |
| title | VARCHAR(100) | Game title |
| description | TEXT | Game description |
| release_date | DATE | Release date |
| id_category | INT (FK) | Category reference |

---

# TABLE: categories

Stores game categories.

| Field | Data Type | Description |
|------|-----------|-------------|
| id_category | INT (PK) | Category ID |
| name | VARCHAR(50) | Category name |

---

# TABLE: favorites

Stores user favorite games.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Favorite identifier |
| user_id | INT (FK) | User reference |
| game_id | INT (FK) | Game reference |
| added_at | DATETIME | Date added |

---

# TABLE: friends

Stores user friendships.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Friendship ID |
| user_id | INT (FK) | User reference |
| friend_id | INT (FK) | Friend reference |
| created_at | DATETIME | Friendship date |

---

# TABLE: friend_requests

Stores pending friend requests.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Request ID |
| sender_id | INT (FK) | Sender user |
| receiver_id | INT (FK) | Receiver user |
| status | VARCHAR(20) | Request status |
| created_at | DATETIME | Request date |

---

# TABLE: messages

Stores chat messages.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Message ID |
| sender_id | INT (FK) | Sender user |
| receiver_id | INT (FK) | Receiver user |
| message_text | TEXT | Message content |
| sent_at | DATETIME | Sent date |

---

# TABLE: blocked_users

Stores blocked users.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Block ID |
| user_id | INT (FK) | User who blocks |
| blocked_user_id | INT (FK) | Blocked user |
| created_at | DATETIME | Block date |

---

# TABLE: achievements

Stores unlocked achievements.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Achievement ID |
| user_id | INT (FK) | User reference |
| title | VARCHAR(100) | Achievement title |
| unlocked_at | DATETIME | Unlock date |

---

# TABLE: reports

Stores user reports.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Report ID |
| reporter_id | INT (FK) | Reporting user |
| reported_user_id | INT (FK) | Reported user |
| reason | TEXT | Report reason |
| created_at | DATETIME | Report date |

---

# 🔗 RELATIONSHIPS

Database relationships include:

- One USER can send many MESSAGES
- One USER can receive many MESSAGES
- One USER can have many FRIENDS
- One USER can block many USERS
- One USER can have many FAVORITES
- One GAME belongs to one CATEGORY
- One USER can unlock many ACHIEVEMENTS
- One USER can create many REPORTS

---

# 📌 DATABASE SUMMARY

Total Tables: 10

- users
- games
- categories
- favorites
- friends
- friend_requests
- messages
- blocked_users
- achievements
- reports
