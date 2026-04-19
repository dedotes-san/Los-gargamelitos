#  Data Dictionary – MythCore RPG Launcher Database

This document describes the database structure used in the MythCore RPG Launcher system.

The database manages users, games, friendships, messages, favorites, reports, blocking systems, and game categories.

---

# TABLE: users

Stores registered users of the platform.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Unique user identifier |
| username | VARCHAR(50) | Username used to log in |
| email | VARCHAR(150) | User email |
| password | VARCHAR(255) | Encrypted password |
| avatar | VARCHAR(255) | Avatar filename |
| level | INT | User level |
| xp | INT | Experience points |
| created_at | DATETIME | Account creation date |
| profile_pic | VARCHAR(255) | Profile picture |
| blocked | BOOLEAN | Indicates if user is blocked |
| last_active | DATETIME | Last activity timestamp |
| last_seen | DATETIME | Last seen timestamp |

---

# TABLE: games

Stores all available games.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Game identifier |
| name | VARCHAR(100) | Game title |
| genre | VARCHAR(50) | Game genre |
| description | TEXT | Game description |
| image | VARCHAR(255) | Game image |
| is_real | BOOLEAN | Indicates if the game is real |
| url | VARCHAR(255) | Game URL |
| created_at | DATETIME | Game creation date |
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

Stores favorite games per user.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Favorite ID |
| user_id | INT (FK) | User reference |
| game_id | INT (FK) | Game reference |

---

# TABLE: friends

Stores friendships between users.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Friendship ID |
| sender_id | INT (FK) | Request sender |
| receiver_id | INT (FK) | Request receiver |
| status | VARCHAR(20) | Friendship status |
| blocker_id | INT | User who blocked another user |

---

# TABLE: friend_requests

Stores pending friend requests.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Request identifier |
| sender_id | INT (FK) | User who sends request |
| receiver_id | INT (FK) | User who receives request |
| created_at | DATETIME | Request creation date |

---

# TABLE: blocked_users

Stores blocked user relationships.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Block identifier |
| blocker_id | INT (FK) | User who blocks |
| blocked_id | INT (FK) | Blocked user |
| created_at | DATETIME | Block date |

---

# TABLE: messages

Stores chat messages.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Message identifier |
| sender_id | INT (FK) | Sender user |
| receiver_id | INT (FK) | Receiver user |
| message | TEXT | Message content |
| sent_at | DATETIME | Sent timestamp |
| status | VARCHAR(20) | Message status |
| created_at | DATETIME | Message creation timestamp |

---

# TABLE: reports

Stores user reports.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Report identifier |
| reported_id | INT (FK) | Reported user |
| reason | TEXT | Report reason |

---

#  RELATIONSHIPS

Database relationships include:

- One USER can send many MESSAGES  
- One USER can receive many MESSAGES  
- One USER can have many FRIENDS  
- One USER can send many FRIEND REQUESTS  
- One USER can block many USERS  
- One USER can have many FAVORITES  
- One GAME belongs to one CATEGORY  
- One USER can create many REPORTS  

---

#  DATABASE SUMMARY

Total Tables: **10**

Tables included:

- users
- games
- categories
- favorites
- friends
- friend_requests
- blocked_users
- messages
- reports

Database Type: **MySQL**
Engine: **InnoDB**
Normalization Level: **Third Normal Form (3NF)**
