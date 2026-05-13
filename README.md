# MythCore RPG Launcher 🚀

![Build Status](https://img.shields.io/badge/build-passing-brightgreen)
![Sprint](https://img.shields.io/badge/sprint-2-blue)
![Database](https://img.shields.io/badge/database-MySQL-orange)
![Platform](https://img.shields.io/badge/platform-XAMPP-lightgrey)

> MythCore RPG Launcher es un ecosistema integral para la gestión de videojuegos RPG que combina administración de usuarios, biblioteca de juegos, funciones sociales y moderación de comunidad en una sola plataforma.

---

# 📖 Tabla de Contenidos
* [Información del Proyecto](#-información-del-proyecto)
* [Alcance Funcional](#-alcance-funcional)
* [Arquitectura de la Base de Datos](#-arquitectura-de-la-base-de-datos)
* [Estructura de Roles](#-estructura-de-roles-equipo-los-gargamelitos)
* [Organización del Repositorio](#-organización-del-repositorio)
* [Tecnologías Utilizadas](#-tecnologías-utilizadas)

---

# 📌 Información del Proyecto

| Campo | Información |
| :--- | :--- |
| **Nombre del Proyecto** | MythCore RPG Launcher |
| **Equipo de Desarrollo** | Los Gargamelitos |
| **Institución** | CBTis 47 |
| **Estado Actual** | Sprint 2 (Mayo 2026) |

---

# ⚔️ Alcance Funcional

El sistema permite una gestión completa del entorno de juego y comunidad:

* 👤 **Gestión de Usuarios:** Registro, inicio de sesión y administración de perfiles.
* 💬 **Sistema Social:** Envío de solicitudes de amistad, chat en tiempo real ("rpg-chat") mediante Pusher JS y gestión de bloqueos.
* 🎮 **Biblioteca de Juegos:** Exploración de títulos comerciales y creación de juegos personalizados organizados por categorías.
* 🛡️ **Moderación y Seguridad:** Sistema de reportes de usuarios para control de comunidad.
* 🏆 **Progresión:** Visualización de rankings, logros y acumulación de XP.

---

# 🏛️ Arquitectura de la Base de Datos

La base de datos está diseñada bajo estándares de eficiencia y escalabilidad:

* **Motor:** MySQL (Entorno XAMPP local y hosting en InfinityFree).
* **Normalización:** Tercera Forma Normal (3NF) para eliminar redundancia.
* **Relaciones:** Implementación estricta de Llaves Primarias (PK) y Foráneas (FK) en 9 tablas interconectadas.

## 📂 Listado de Tablas

| # | Tabla | Descripción |
| :--- | :--- | :--- |
| 1 | `users` | Perfiles y credenciales de acceso |
| 2 | `games` | Catálogo general de títulos |
| 3 | `categories` | Géneros y clasificaciones |
| 4 | `favorites` | Relación de juegos marcados por el usuario |
| 5 | `friends` | Listado de amistades confirmadas |
| 6 | `friend_requests` | Control de solicitudes de amistad enviadas/recibidas |
| 7 | `blocked_users` | Restricciones de interacción entre usuarios |
| 8 | `messages` | Historial de comunicación interna |
| 9 | `reports` | Registro de incidencias y reportes de comportamiento |

---

# 👥 Estructura de Roles (Equipo Los Gargamelitos)

| Integrante | Rol Designado | Responsabilidades |
| :--- | :--- | :--- |
| **A. Irvin** | Analista y Diseñador | Diseño de diagramas ERD y documentación de procesos |
| **B. Dorian** | Desarrollador SQL | Implementación de tablas, constraints y scripts de base de datos |
| **C. Dereck** | Administrador (DBA) | Gestión de archivos, versionado y soporte técnico de la DB |
| **D. Manuel** | Especialista en Queries | Carga de datos de prueba y generación de reportes SQL |
| **E. Carlos** | Tester SQL | Pruebas de integridad, validación de consultas y control de errores |

---

# 📁 Organización del Repositorio

El proyecto se organiza mediante una metodología de trabajo basada en Sprints para el control de versiones en GitHub:

```bash
/database
│── 01_schema.sql
│── 02_inserts.sql

/queries
│── reports.sql

/docs
│── Diccionario de datos
│── Manuales técnicos
```

### 📄 Descripción de Archivos

* `/database/01_schema.sql` → Definición de la estructura de tablas.
* `/database/02_inserts.sql` → Scripts para población inicial de datos.
* `/queries/reports.sql` → Consultas para estadísticas y reportes de administración.
* `/docs/` → Diccionario de datos y manuales técnicos.

---

# 💻 Tecnologías Utilizadas

| Tecnología | Uso |
| :--- | :--- |
| **PHP** | Desarrollo Backend |
| **SQL / MySQL** | Gestión de Base de Datos |
| **Pusher JS** | Mensajería en tiempo real |
| **XAMPP** | Entorno de desarrollo local |
| **Windows** | Sistema operativo de desarrollo |
