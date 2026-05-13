# MythCore RPG Launcher 🚀

![Build Status](https://img.shields.io/badge/build-passing-brightgreen)
![Sprint](https://img.shields.io/badge/sprint-2-blue)
![Database](https://img.shields.io/badge/database-MySQL-orange)
![Platform](https://img.shields.io/badge/platform-XAMPP-lightgrey)

> MythCore RPG Launcher is a comprehensive ecosystem for RPG video game management that combines user administration, game library features, social interaction, and community moderation into a single platform.

---

# 📖 Table of Contents
* [Project Information](#-project-information)
* [Functional Scope](#-functional-scope)
* [Database Architecture](#-database-architecture)
* [Role Structure](#-role-structure-team-los-gargamelitos)
* [Repository Organization](#-repository-organization)
* [Technologies Used](#-technologies-used)

---

# 📌 Project Information

| Field | Information |
| :--- | :--- |
| **Project Name** | MythCore RPG Launcher |
| **Development Team** | Los Gargamelitos |
| **Institution** | CBTis 47 |
| **Current Status** | Sprint 2 (May 2026) |

---

# ⚔️ Functional Scope

The system provides complete management of the gaming environment and community:

* 👤 **User Management:** Registration, login, and profile administration.
* 💬 **Social System:** Friend requests, real-time chat ("rpg-chat") using Pusher JS, and user blocking management.
* 🎮 **Game Library:** Browsing commercial titles and creating custom games organized by categories.
* 🛡️ **Moderation and Security:** User reporting system for community control.
* 🏆 **Progression:** Rankings, achievements, and XP accumulation display.

---

# 🏛️ Database Architecture

The database is designed following efficiency and scalability standards:

* **Engine:** MySQL (Local XAMPP environment and InfinityFree hosting).
* **Normalization:** Third Normal Form (3NF) to eliminate redundancy.
* **Relationships:** Strict implementation of Primary Keys (PK) and Foreign Keys (FK) across 9 interconnected tables.

## 📂 Table List

| # | Table | Description |
| :--- | :--- | :--- |
| 1 | `users` | User profiles and login credentials |
| 2 | `games` | General game catalog |
| 3 | `categories` | Genres and classifications |
| 4 | `favorites` | User favorite games relationship |
| 5 | `friends` | Confirmed friends list |
| 6 | `friend_requests` | Sent/received friend request management |
| 7 | `blocked_users` | User interaction restrictions |
| 8 | `messages` | Internal communication history |
| 9 | `reports` | Incident and behavior report records |

---

# 👥 Role Structure (Team Los Gargamelitos)

| Member | Assigned Role | Responsibilities |
| :--- | :--- | :--- |
| **A. Irvin** | Analyst and Designer | ERD diagram design and process documentation |
| **B. Dorian** | SQL Developer | Table implementation, constraints, and database scripts |
| **C. Dereck** | Database Administrator (DBA) | File management, version control, and DB technical support |
| **D. Manuel** | Query Specialist | Test data insertion and SQL report generation |
| **E. Carlos** | SQL Tester | Integrity testing, query validation, and error control |

---

# 📁 Repository Organization

The project is organized using a Sprint-based workflow methodology for GitHub version control:

```bash
/database
│── 01_schema.sql
│── 02_inserts.sql

/queries
│── reports.sql

/docs
│── Data Dictionary
│── Technical Manuals
```

### 📄 File Description

* `/database/01_schema.sql` → Table structure definition.
* `/database/02_inserts.sql` → Initial data population scripts.
* `/queries/reports.sql` → Queries for statistics and administrative reports.
* `/docs/` → Data dictionary and technical manuals.

---

# 💻 Technologies Used

| Technology | Purpose |
| :--- | :--- |
| **PHP** | Backend Development |
| **SQL / MySQL** | Database Management |
| **Pusher JS** | Real-time Messaging |
| **XAMPP** | Local Development Environment |
| **Windows** | Development Operating System |
