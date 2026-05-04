#  Sprint 0 — MythCore RPG Launcher

**Periodo:** Marzo - Mayo 2026
**Institución:** CBTis 47
**Metodología:** Scrum

---

## 1. Objetivo del Sprint 0
Definir el alcance general de **MythCore**, formar el equipo de trabajo con sus roles específicos, establecer acuerdos de colaboración en GitHub y estructurar las áreas funcionales (Épicas) del lanzador de juegos RPG.

---

## 2. Equipo de Trabajo

| Miembro Asignado | Rol | Responsabilidad Principal | Artefactos Clave |
| :--- | :--- | :--- | :--- |
| **A. Irvin** | Analista y Diseñador | Diseña la estructura y relaciones de la BD. | `erd_diagram.md`, `dictionary.md` |
| **B. Dorian** | Desarrollador SQL | Crea tablas y restricciones de la base de datos. | `01_schema.sql` |
| **C. Derek** | Administrador (DBA) | Organiza la estructura y documentación del proyecto. | `LÉAME.md` |
| **D. Manuel** | Maestro de Consultas | Inserta datos de prueba y crea reportes. | `02_inserts_sample.sql`, `report_games.sql` |
| **E. Carlos** | Probador SQL (Tester) | Validar consultas y la integridad de la estructura. | `consultas_avanzadas.sql` |

---

## 3. Descripción del Proyecto

### Nombre: **MythCore**
### ¿Qué es?
Un lanzador de videojuegos RPG con sistema de búsqueda, gestión de favoritos, ranking competitivo por nivel/XP y un sistema social avanzado que incluye chat, bloqueo de usuarios y un "Libro de Alianzas" para ver estados de conexión.

### Objetivo del Producto
Desarrollar una plataforma funcional que automatice la interacción entre jugadores y la gestión de su biblioteca de juegos, garantizando un entorno seguro mediante filtros de seguridad extremos y una interfaz inmersiva.

---

## 4. Tecnologías Seleccionadas

| Componente | Tecnología | Razón |
| :--- | :--- | :--- |
| **Frontend** | HTML5, CSS3, JavaScript | Compatibilidad y diseño de UI/UX para RPG. |
| **Backend** | PHP | Lógica del servidor para autenticación y mensajería. |
| **Base de Datos** | MySQL / MariaDB | Gestión robusta de usuarios, logros y amigos. |
| **Servidor** | XAMPP (Local) / InfinityFree (Remoto) | Entornos de desarrollo y hosting gratuito. |
| **Control de Versiones** | Git + GitHub | Colaboración por Sprints y control de cambios. |

---

## 5. Épicas Identificadas

| ID | Épica | Descripción General | Prioridad |
| :--- | :--- | :--- | :--- |
| **EP-01** | Autenticación y Seguridad | Registro, login y filtro de nombres extremo (baneos). | Alta |
| **EP-02** | Libro de Alianzas | Sistema de amigos, chat en vivo y rastro de conexión. | Alta |
| **EP-03** | RPG Library | Buscador de juegos, categorías y sistema de favoritos. | Media |
| **EP-04** | Progresión | Sistema de 32 logros, ranking global y ganancia de XP. | Media |

---

## 6. Alcance del Proyecto

### Dentro del Alcance (v1.0)
*   Registro con validación de seguridad y sistema de recuperación de contraseña.
*   Chat con sistema de bloqueo silencioso y vaciado de historial.
*   Ranking competitivo basado en nivel y experiencia de juego (XP).
*   Libro de Alianzas con estados "En Línea" y "Offline" dinámicos.

### Fuera del Alcance (v1.0)
*   Integración de pasarelas de pago reales.
*   Aplicación móvil nativa.
*   Notificaciones vía correo electrónico.

---

## 7. Acuerdos del Equipo
*   Todo el código vive en GitHub organizado por carpetas de Sprints.
*   Se utiliza la estructura de carpetas: `/docs` para documentación, `/src` para código y `/queries` para SQL.
*   Cualquier cambio en la base de datos debe ser validado por el **Probador SQL** antes de realizar el commit.
