#  MythCore RPG Launcher

MythCore RPG Launcher is a database-driven platform designed to manage RPG games, users, friendships, messages, and favorites within a gaming environment.

Author: **Los gargamelitos**

---

#  Project Description

MythCore RPG Launcher simulates a gaming launcher system where users can:

- Create user accounts  
- Add friends  
- Send messages  
- Favorite games  
- Browse RPG games  
- Report users  
- Block users  
- Manage game categories  

The system supports both real commercial games and custom games created by users.

---

#  Database Features

The database includes:

- Multiple related tables  
- Primary Keys (PK)  
- Foreign Keys (FK)  
- Normalized structure (3NF)  
- Real sample data  
- Advanced SQL queries  

---

#  Project Structure


MythCore-RPG-Launcher/

│
├── src/
│ ├── 01_schema.sql
│ ├── 02_inserts_sample.sql
│
├── docs/
│ ├── dictionary.md
│ ├── normalization_report.md
│ ├── erd_diagram.mmd
│
├── queries/
│ ├── report_games.sql
│ ├── advanced_queries.sql
│
└── README.md


---

# Database Tables

The system includes the following tables:

- users  
- games  
- categories  
- favorites  
- friends  
- friend_requests  
- blocked_users  
- messages  
- reports  

Total Tables: **9**

---

#  Normalization Level

Database normalization achieved:

**Third Normal Form (3NF)**

This ensures:

- Reduced redundancy  
- Better performance  
- Data integrity  
- Structured relationships  

---

#  How to Run the Database

Follow these steps:

1. Open MySQL or phpMyAdmin  

2. Run:


src/01_schema.sql


3. Then run:


src/02_inserts_sample.sql


4. Run query examples:


queries/report_games.sql


The database will be fully ready to use.

---

#  Team Roles & Responsibilities

| Role Name | Primary Responsibility | Key Artifacts |
|-----------|-----------------------|----------------|
| The Analyst & Designer | Designs the database structure and relationships | docs/erd_diagram.mmd, docs/dictionary.md |
| The SQL Developer | Creates database tables and constraints | src/01_schema.sql |
| The Database Administrator | Organizes project structure and documentation | README.md |
| The Query Master | Inserts data and creates queries | src/02_inserts_sample.sql, queries/report_games.sql |
| The SQL Tester | Tests database queries and validates structure | queries/advanced_queries.sql |

---

#  Technologies Used

- MySQL  
- phpMyAdmin  
- SQL  
- Relational Database Design  
- Data Normalization (3NF)

---

#  Author

**Los gargamelitos**

Project created for database system design practice.

System Name: MythCore

**MythCore RPG Launcher**
