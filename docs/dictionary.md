# 📚 Data Dictionary – RPG Launcher Database (MythCore)

This document describes the database structure used in the MythCore RPG Launcher system.

The database manages users, friendships, messages, favorites, reports, and games.

---

# TABLE: users

Stores registered users.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Unique user identifier |
| username | VARCHAR | Username used to log in |
| email | VARCHAR | User email |
| password | VARCHAR | Encrypted password |
| avatar | VARCHAR | Avatar filename |
| level | INT | User level |
| xp | INT | Experience points |
| created_at | DATETIME | Account creation date |
| profile_pic | VARCHAR | Profile picture |
| blocked | BOOLEAN | Account blocked status |
| last_active | DATETIME | Last active time |
| last_seen | DATETIME | Last seen time |

---

# TABLE: games

Stores available games.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Game identifier |
| name | VARCHAR | Game title |
| genre | VARCHAR | Game genre |
| description | TEXT | Game description |
| image | VARCHAR | Game image |
| is_real | BOOLEAN | Indicates if game is real |
| url | VARCHAR | Game URL |
| created_at | DATETIME | Game creation date |
| id_category | INT (FK) | Category reference |

---

# TABLE: categories

Stores game categories.

| Field | Data Type | Description |
|------|-----------|-------------|
| id_category | INT (PK) | Category ID |
| name | VARCHAR | Category name |

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
| status | VARCHAR | Friendship status |
| blocker_id | INT | User who blocked |

---

# TABLE: blocked_users

Stores blocked users.

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
| id | INT (PK) | Message ID |
| sender_id | INT (FK) | Sender user |
| receiver_id | INT (FK) | Receiver user |
| message | TEXT | Message content |
| sent_at | DATETIME | Sent date |
| status | VARCHAR | Message status |
| created_at | DATETIME | Creation date |

---

# TABLE: reports

Stores reports between users.

| Field | Data Type | Description |
|------|-----------|-------------|
| id | INT (PK) | Report ID |
| reported_id | INT (FK) | Reported user |
| reason | TEXT | Report reason |

---

# 🔗 RELATIONSHIPS

Database relationships:

- One USER can send many MESSAGES
- One USER can receive many MESSAGES
- One USER can have many FRIENDS
- One USER can block many USERS
- One USER can have many FAVORITES
- One GAME belongs to one CATEGORY
- One USER can create many REPORTS

---

# 📊 DATABASE SUMMARY

Total Tables: **9**

Tables included:

- users
- games
- categories
- favorites
- friends
- blocked_users
- messages
- reports
