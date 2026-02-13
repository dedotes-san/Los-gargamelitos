# Team Roles & Responsibilities

  --------------------------------------------------------------------------------
  Role Name       Primary               Key Artifacts    Evaluation Criteria
                  Responsibility        (English)        (DGETI + English)
                  (Spanish)                              
  --------------- --------------------- ---------------- -------------------------
  **1. The        Traduce las reglas de \- erd_diagram   
  Analyst &       negocio a un modelo                    
  Designer        visual. Garantiza la                   
  (Architect)**   Normalización (3FN).                   

  --------------------------------------------------------------------------------

-   mmd\
-   dictionary.md \| **Concept:** Correct cardinality (1:N, N:M).\
    **English:** Clear descriptions in Data Dictionary.\
    **Tech:** Diagram compiles in Mermaid/Lucidchart. \| \| **2. The SQL
    Developer (Builder)** \| Escribe el código DDL para crear la
    estructura. Define tipos de datos exactos. \| - 01_schema.sql\
-   Constraints (PK, FK) \| **Concept:** Syntax accuracy (CREATE,
    ALTER).\
    **English:** Meaningful table/column names (snake_case).\
    **Tech:** Script runs without syntax errors. \| \| **3. The Database
    Administrator (Guardian)** \| Gestiona seguridad, usuarios y
    backups. Ensambla el entregable final. \| - 03_users.sql\
-   Backup Strategy \| **Concept:** Security principles (Least
    Privilege).\
    **English:** Professional comments in SQL scripts.\
    **Tech:** Users have correct permissions (GRANT/REVOKE). \| \| **4.
    The Query Master (Manipulator)** \| Pobla la base de datos (Datos
    semilla) y extrae reportes de inteligencia de negocios. \| -
    02_seed.sql\
-   queries/\*.sql \| **Concept:** Logic in JOINs and Aggregates.\
    **English:** Query aliases and readability.\
    **Tech:** Queries return accurate data sets. \| \| **5. The SQL
    Tester (QA / Breaker)** \| Intenta romper la BD. Valida integridad
    referencial y tipos de datos. \| - tests/bug_report.md\
-   tests/test_cases.sql \| **Concept:** Understanding of constraints &
    validation.\
    **English:** Clear bug descriptions (Expected vs Actual).\
    **Tech:** Identification of logic/structural flaws. \|
