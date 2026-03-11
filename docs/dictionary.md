# 📚 Diccionario de Datos – Base de Datos del Launcher

Este documento describe la estructura de la base de datos utilizada en el proyecto del launcher de videojuegos.

---

# Tabla: users

| Campo | Tipo de Dato | Descripción |
|------|------|------|
| id_user | INT (PK) | Identificador único del usuario |
| username | VARCHAR(50) | Nombre de usuario para iniciar sesión |
| email | VARCHAR(100) | Correo electrónico del usuario |
| password | VARCHAR(255) | Contraseña cifrada del usuario |
| created_at | DATETIME | Fecha de creación de la cuenta |

---

# Tabla: games

| Campo | Tipo de Dato | Descripción |
|------|------|------|
| id_game | INT (PK) | Identificador único del juego |
| title | VARCHAR(100) | Nombre del videojuego |
| description | TEXT | Descripción del juego |
| file_path | VARCHAR(255) | Ruta del archivo ejecutable del juego |
| release_date | DATE | Fecha de lanzamiento del juego |

---

# Tabla: favorites

| Campo | Tipo de Dato | Descripción |
|------|------|------|
| id_favorite | INT (PK) | Identificador del registro de favorito |
| id_user | INT (FK) | Usuario que agregó el juego a favoritos |
| id_game | INT (FK) | Juego marcado como favorito |
| added_date | DATETIME | Fecha en que el juego se agregó a favoritos |

---

# Tabla: achievements

| Campo | Tipo de Dato | Descripción |
|------|------|------|
| id_achievement | INT (PK) | Identificador del logro |
| id_game | INT (FK) | Juego al que pertenece el logro |
| title | VARCHAR(100) | Nombre del logro |
| description | TEXT | Descripción del logro |
| points | INT | Puntos obtenidos al desbloquear el logro |

---

# Relaciones de la Base de Datos

- Un **usuario** puede tener múltiples **favoritos**.
- Un **juego** puede aparecer en múltiples **favoritos**.
- Un **juego** puede tener múltiples **logros (achievements)**.
