# MythCore RPG Launcher - Documentación Técnica

## 1. Información del Proyecto
Este proyecto consiste en el desarrollo de un ecosistema integral para la gestión de videojuegos RPG, integrando funciones sociales y de administración de datos.

*   **Nombre del Proyecto:** MythCore RPG Launcher.
*   **Equipo de Desarrollo:** Los Gargamelitos.
*   **Institución:** CBTis 47.
*   **Estado Actual:** Sprint 2 (Mayo 2026).

## 2. Alcance Funcional
El sistema permite una gestión completa del entorno de juego y comunidad:
*   **Gestión de Usuarios:** Registro, inicio de sesión y administración de perfiles.
*   **Sistema Social:** Envío de solicitudes de amistad, chat en tiempo real ("rpg-chat") mediante Pusher JS y gestión de bloqueos.
*   **Biblioteca de Juegos:** Exploración de títulos comerciales y creación de juegos personalizados organizados por categorías.
*   **Moderación y Seguridad:** Sistema de reportes de usuarios para control de comunidad.
*   **Progresión:** Visualización de rankings, logros y acumulación de XP.

## 3. Arquitectura de la Base de Datos
La base de datos está diseñada bajo estándares de eficiencia y escalabilidad:
*   **Motor:** MySQL (Entorno XAMPP local y hosting en InfinityFree).
*   **Normalización:** Tercera Forma Normal (3NF) para eliminar redundancia.
*   **Relaciones:** Implementación estricta de Llaves Primarias (PK) y Foráneas (FK) en 9 tablas interconectadas.

### Listado de Tablas:
1.  `users`: Perfiles y credenciales de acceso.
2.  `games`: Catálogo general de títulos.
3.  `categories`: Géneros y clasificaciones.
4.  `favorites`: Relación de juegos marcados por el usuario.
5.  `friends`: Listado de amistades confirmadas.
6.  `friend_requests`: Control de solicitudes de amistad enviadas/recibidas.
7.  `blocked_users`: Restricciones de interacción entre usuarios.
8.  `messages`: Historial de comunicación interna.
9.  `reports`: Registro de incidencias y reportes de comportamiento.

## 4. Estructura de Roles (Equipo Los Gargamelitos)

| Integrante | Rol Designado | Responsabilidades |
| :--- | :--- | :--- |
| **A. Irvin** | Analista y Diseñador | Diseño de diagramas ERD y documentación de procesos. |
| **B. Dorian** | Desarrollador SQL | Implementación de tablas, constraints y scripts de base de datos. |
| **C. Dereck** | Administrador (DBA) | Gestión de archivos, versionado y soporte técnico de la DB. |
| **D. Manuel** | Especialista en Queries | Carga de datos de prueba y generación de reportes SQL. |
| **E. Carlos** | Tester SQL | Pruebas de integridad, validación de consultas y control de errores. |

## 5. Organización del Repositorio
El proyecto se organiza mediante una metodología de trabajo basada en Sprints para el control de versiones en GitHub:
*   `/database/01_schema.sql`: Definición de la estructura de tablas.
*   `/database/02_inserts.sql`: Scripts para población inicial de datos.
*   `/queries/reports.sql`: Consultas para estadísticas y reportes de administración.
*   `/docs/`: Diccionario de datos y manuales técnicos.

## 6. Tecnologías Utilizadas
*   **Lenguajes:** PHP (Backend) y SQL (Base de datos).
*   **Servicios:** Pusher JS para mensajería en tiempo real.
*   **Entorno:** XAMPP sobre Windows para desarrollo local.
