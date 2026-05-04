# 🛡️ Sprint 1 — MythCore RPG Launcher
**Periodo:** Marzo – Abril 2026
**Institución:** CBTis 47
**Metodología:** Scrum

---

## 1. Objetivo del Sprint 1

Establecer los estándares de la base de datos MySQL, definir las reglas de normalización para el sistema de alianzas y redactar las Historias de Usuario iniciales para el ecosistema RPG.

Al finalizar este sprint, el equipo tendrá una estructura de datos sólida en **InfinityFree** y entenderá exactamente cómo debe funcionar el sistema de "En Línea" y el filtro de seguridad antes de pasar a la programación intensiva.

---

## 2. Equipo de Trabajo

| Miembro Asignado | Rol | Responsabilidad Principal |
| :--- | :--- | :--- |
| **A. Irvin** | Analista y Diseñador | Estándares de nombres y normalización 3NF. |
| **B. Dorian** | Desarrollador SQL | Implementación de tablas en el servidor remoto. |
| **C. Derek** | Administrador (DBA) | Gestión de documentación y README. |
| **D. Manuel** | Maestro de Consultas | Creación de datos de prueba para el Ranking. |
| **E. Carlos** | Probador SQL (Tester) | Validación de triggers y filtros de seguridad. |

---

## 3. Estándares de la Base de Datos (MythCore DB)

### 3.1 Convenciones de Nomenclatura

| Elemento | Convención | Ejemplo |
| :--- | :--- | :--- |
| Tablas | Minúsculas con guiones bajos | `usuarios`, `lista_amigos` |
| Columnas | Minúsculas (snake_case) | `xp_total`, `ultimo_visto` |
| Llaves Primarias | `id` + nombre singular | `id_usuario`, `id_logro` |
| Llaves Foráneas | Mismo nombre que la PK original | `id_usuario FK → usuarios.id_usuario` |

### 3.2 Reglas de Esquema General

*   **Normalización (3NF):** Los datos de los juegos (nombre, género) están en `juegos` y se vinculan a `favoritos` mediante FK para evitar redundancia.
*   **Gestión de Tiempo:** Se utiliza `DATETIME` para la columna `last_seen` (rastro de conexión).
*   **Seguridad:** Las contraseñas se gestionan con `password_hash()` de PHP; nunca se guardan en texto plano.
*   **Integridad:** Se aplican restricciones `UNIQUE` al correo y al nombre de usuario para evitar duplicados.

---

## 4. Decisiones de Diseño Clave



*   **Rastro de Conexión:** Se decidió que el estado "EN LÍNEA" se calcule mediante la diferencia de tiempo (`TIMESTAMPDIFF`) entre la hora actual y el campo `last_seen` en la base de datos.
*   **Filtro de Seguridad:** El baneo se activa tras 3 intentos fallidos registrados en una tabla de auditoría de seguridad.
*   **Separación Social:** La tabla `mensajes` es independiente de `lista_amigos` para permitir el vaciado del chat sin eliminar la amistad.

---

## 5. Product Backlog Inicial (User Stories)

### EP-01 · Seguridad y Acceso

#### US-01 — Registro con Filtro de Nombres
**Como** nuevo jugador, **quiero** crear una cuenta con un nombre permitido, **para** no ser bloqueado por el sistema desde el inicio.

```gherkin
Scenario: Registro exitoso
  Given el usuario ingresa un nombre sin groserías y un correo nuevo
  Then el sistema crea la cuenta en la tabla 'usuarios'

Scenario: Intento con nombre prohibido
  Given el usuario ingresa una palabra de la lista negra
  Then el sistema resta una oportunidad y muestra advertencia
