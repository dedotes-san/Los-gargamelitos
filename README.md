# 🛡️ MythCore RPG Launcher

> Plataforma integral basada en bases de datos para la gestión de videojuegos RPG, interacción social entre usuarios, sistemas de mensajería y personalización de bibliotecas.

---

![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Status](https://img.shields.io/badge/Status-Sprint%202-green?style=for-the-badge)
![DB](https://img.shields.io/badge/Normalización-3NF-blue?style=for-the-badge)
![Académico](https://img.shields.io/badge/Uso-Académico%20CBTis%2047-purple?style=for-the-badge)

---

## 📋 Tabla de Contenidos

- [Sobre el proyecto](#-sobre-el-proyecto)
- [Funcionalidades principales](#-funcionalidades-principales)
- [Características de la Base de Datos](#-características-de-la-base-de-datos)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Esquema de Tablas](#-esquema-de-tablas)
- [Historias de Usuario](#-historias-de-usuario)
- [Guía de Instalación](#-guía-de-instalación)
- [Equipo de Desarrollo](#-equipo-de-desarrollo)

---

## 📖 Sobre el proyecto

**MythCore RPG Launcher** simula un ecosistema de videojuegos donde la persistencia de datos es el núcleo. El sistema permite a los jugadores no solo gestionar su librería de juegos, sino también construir una comunidad mediante sistemas de amistad, reportes y mensajería en tiempo real, todo bajo una arquitectura de datos optimizada.

> 📌 Desarrollado por el equipo **"Los Gargamelitos"** para la práctica de diseño de sistemas de bases de datos.

---

## ✨ Funcionalidades principales

- **Gestión de Cuentas:** Registro y administración de perfiles de usuario.
- **Ecosistema Social:** Sistema de solicitudes de amistad, chat entre usuarios y gestión de bloqueos.
- **Biblioteca RPG:** Exploración de categorías, búsqueda de juegos comerciales y creación de juegos personalizados.
- **Sistema de Moderación:** Reportes de usuarios para mantener un ambiente de juego sano.
- **Personalización:** Marcado de juegos favoritos y organización por categorías.

---

## 🗄️ Características de la Base de Datos

El motor del launcher está construido bajo estándares profesionales:
- **Normalización:** Estructura en **Tercera Forma Normal (3NF)** para eliminar redundancias.
- **Integridad:** Uso estricto de Llaves Primarias (PK) y Foráneas (FK).
- **Rendimiento:** Consultas avanzadas optimizadas para reportes y estadísticas.
- **Escalabilidad:** Soporta tanto juegos reales como contenido generado por el usuario.

---

## 📁 Estructura del Proyecto

MythCore-RPG-Launcher/
│
├── src/
│   ├── 01_schema.sql           # Definición de tablas y constraints
│   └── 02_inserts_sample.sql   # Datos de prueba reales
│
├── docs/
│   ├── dictionary.md           # Diccionario de datos detallado
│   ├── normalization_report.md # Reporte de cumplimiento 3NF
│   └── erd_diagram.mmd         # Diagrama Entidad-Relación
│
├── queries/
│   ├── report_games.sql        # Consultas de reportes generales
│   └── advanced_queries.sql    # Queries complejas y validaciones
│
└── README.md                   # Documentación principal


---

## 📊 Esquema de Tablas

El sistema se compone de **9 tablas interconectadas**:

1.  `users`: Perfiles y credenciales.
2.  `games`: Catálogo de títulos RPG.
3.  `categories`: Clasificación de géneros.
4.  `favorites`: Relación usuario-juego preferido.
5.  `friends`: Lista de amistades confirmadas.
6.  `friend_requests`: Gestión de invitaciones sociales.
7.  `blocked_users`: Sistema de seguridad y privacidad.
8.  `messages`: Historial de comunicación interna.
9.  `reports`: Registro de incidencias y moderación.

---

## 🚀 Guía de Instalación

Para desplegar la base de datos localmente:

1.  Abre tu gestor de base de datos (**MySQL Workbench** o **phpMyAdmin**).
2.  Importa y ejecuta el archivo de esquema: `src/01_schema.sql`.
3.  Puebla el sistema con datos de prueba: `src/02_inserts_sample.sql`.
4.  Verifica el funcionamiento con las consultas en: `queries/report_games.sql`.

---

## 👥 Equipo de Desarrollo (Los Gargamelitos)

| Rol | Responsabilidad | Miembro |
| :--- | :--- | :--- |
| **Analyst & Designer** | Diseño de arquitectura y diagramas ERD | **A. Irvin** |
| **SQL Developer** | Creación de tablas, constraints y triggers | **B. Dorian** |
| **DBA** | Organización de archivos y documentación | **C. Dereck** |
| **Query Master** | Inserción de datos y creación de reportes SQL | **D. Manuel** |
| **SQL Tester** | Validación de estructura y pruebas de estrés | **E. Carlos** |

---

## 🛠️ Tecnologías Utilizadas

- **Motor:** MySQL / MariaDB
- **Gestión:** phpMyAdmin
- **Lenguaje:** SQL Estándar
- **Metodología:** Agile / Scrum (Sprints)

---
*MythCore RPG Launcher — CBTis 47 · Mayo 2026*
