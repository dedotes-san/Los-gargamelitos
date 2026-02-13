# Team Roles & Responsibilities

  -------------------------------------------------------------------------------------------
  Role Name     | Primary              |Key Artifacts   |Evaluation Criteria
                | Responsibility       |(English)       |(DGETI + English)
                | (Spanish)            |                |
  -------------------------------------------------------------------------------------------
  **1. The       Traduce las reglas de-  erd_diagram.      Concept: Correct Cardinality
  Analyst &      negocio a un modelo     mmd Dictiona     (1:N, N:M). English: Claar
                                         ry.md         
  Designer       visual. Garantiza la                 
  (Architect)**  Normalización (3FN).                  

  --------------------------------------------------------------------------------------------
  **2.The SQL  |Escribe el código DDl   | 01_schema.sq1   | Concept: Syntax accuracy
  Developer    |para crear la estructura| Constraints     |(CREATE, ALTER). **English:**
  (Builder)**  |Define tipos de datos   | (PK, FK)        |Meaning table/column names
               |exactos.                |                 |(snakes_case). **Tech:**
               |                        |                 |Script runs without syntax errors.
 ----------------------------------------------------------------------------------------------
 **3.The data  |Gestiona, seguridad,    | 03_users.sql    |**Concept:** Security principles (Least
 base Adminis  |usuarios y backups.     | Backup          |Privilege). **English:** Professional
 trator.       |Ensambla el entregable  | Strategy        |comments in SQL scripts.
 (Guardian)**  |final.                  |                 |**Tech:** Users have correct permissions
               |                        |                 |(GRANT/REVOKE).
 -------------------------------------------------------------------------------------------------
 **4. The Query| Pobla la base de datos | 02_seed.sql     |**Concept:** Logic in JOINs and
 Master        | (Datos semilla)y extrae|                 |Aggreagates. **English:** Query aliases
 (Manipulator  | reportes de inteligen  | queries/*.sql   |and readability. **Tech:** Queries return
               | cia de negocios.       |                 |accurate data sets.