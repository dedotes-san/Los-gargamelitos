---

#  Team Roles & Responsibilities

| Role Name | Primary Responsibility (Spanish) | Key Artifacts (English) | Evaluation Criteria (DGETI + English) |
|-----------|----------------------------------|--------------------------|--------------------------------------|
| **1. The Analyst & Designer (Architect)** | Traduce las reglas del sistema MythCore RPG Launcher a un modelo visual y garantiza la normalización hasta 3FN. | • docs/ER_diagram.txt  <br> • docs/dictionary.md | Concept: Correct relationships between users, games and messages. <br> English: Clear descriptions in Data Dictionary. <br> Tech: ER structure correctly defined. |
| **2. The SQL Developer (Builder)** | Diseña la estructura completa de la base de datos usando SQL y define llaves primarias y foráneas. | • src/01_schema.sql | Concept: Correct table structure and foreign keys. <br> English: Clear naming (users, games, messages). <br> Tech: Schema executes without syntax errors. |
| **3. The Database Administrator (Guardian)** | Organiza la estructura del proyecto y asegura que la base pueda ejecutarse correctamente desde cero. | • README.md <br> • Database structure organization | Concept: Proper database organization. <br> English: Professional documentation. <br> Tech: Database can be executed correctly. |
| **4. The Query Master (Manipulator)** | Inserta datos y crea consultas SQL para generar reportes útiles del sistema. | • src/02_inserts_sample.sql <br> • queries/report_games.sql <br> • queries/advanced_queries.sql | Concept: Use of JOIN, COUNT, GROUP BY. <br> English: Clear query aliases. <br> Tech: Queries return correct results. |
| **5. The SQL Tester (QA / Breaker)** | Verifica que la base funcione correctamente y detecta posibles errores en las consultas. | • queries/advanced_queries.sql <br> • docs/normalization_report.md | Concept: Validation of database logic. <br> English: Clear validation explanations. <br> Tech: Queries tested successfully. |

---
