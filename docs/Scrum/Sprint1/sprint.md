# 🛡️ Sprint 1 — MythCore RPG Launcher

**Periodo:** Marzo – Abril 2026  
**Institución:** CBTis 47  
**Metodología:** Scrum  

---

## 1. Objetivo del Sprint 1

Refinar las definiciones del Sprint 0, establecer los estándares y reglas del esquema de la base de datos MySQL en **InfinityFree** y redactar las Historias de Usuario con sus criterios de aceptación iniciales para el ecosistema RPG.

Al finalizar este sprint, el equipo tendrá una estructura de datos sólida y entenderá exactamente qué debe hacer cada función (como el rastro de conexión y el filtro de baneo) para comenzar el desarrollo en el Sprint 2 sin ambigüedades.

---

## 2. Equipo de Trabajo

| Miembro Asignado | Rol | Responsabilidad Principal | Artefactos Clave |
| :--- | :--- | :--- | :--- |
| **A. Irvin** | Analista y Diseñador | Diseña la estructura y relaciones de la BD. | `erd_diagram.md`, `dictionary.md` |
| **B. Dorian** | Desarrollador SQL | Crea tablas y restricciones en el servidor remoto. | `01_schema.sql` |
| **C. Derek** | Administrador (DBA) | Organiza la estructura y documentación del proyecto. | `LÉAME.md` |
| **D. Manuel** | Maestro de Consultas | Inserta datos de prueba y crea reportes de ranking. | `02_inserts_sample.sql` |
| **E. Carlos** | Probador SQL (Tester) | Valida consultas y la integridad de los filtros. | `consultas_avanzadas.sql` |

---

## 3. Estándares de la Base de Datos

### 3.1 Convenciones de Nomenclatura

| Elemento | Convención | Ejemplo |
| :--- | :--- | :--- |
| **Tablas** | Minúsculas con guiones bajos | `usuarios`, `lista_amigos` |
| **Columnas** | Minúsculas (snake_case) | `xp_total`, `ultimo_visto` |
| **Llaves Primarias** | `id_` + nombre singular | `id_usuario`, `id_logro` |
| **Llaves Foráneas** | Mismo nombre que la PK original | `id_usuario FK → usuarios.id_usuario` |

### 3.2 Reglas del Esquema

* **Normalización (3NF):** Los datos están organizados para evitar redundancia.
* **Gestión de Tiempo:** Se utiliza `DATETIME` para la columna `last_seen` para calcular el estado "En Línea".
* **Seguridad de Acceso:** Las contraseñas se gestionan mediante hashing en PHP.

---

## 4. Decisiones de Diseño Clave

* **Cálculo de Conexión:** Determinado por la diferencia entre la hora del servidor y el campo `last_seen`.
* **Filtro de Seguridad:** El sistema de baneo rastrea intentos fallidos en una tabla de auditoría.
* **Hosting:** Uso de **InfinityFree** como servidor remoto.

---

## 5. Product Backlog (Historias de Usuario)

### EP-02 · Libro de Alianzas

#### US-02 — Estado de Conexión Dinámico
**Como** guerrero de MythCore, **quiero** ver quién de mis aliados está conectado, **para** enviar un "cuervo" (mensaje) solo cuando sea efectivo.

**Criterios de Aceptación:**

```gherkin
Scenario: Actualización de estado Online
  Given el aliado tuvo actividad hace menos de 90 segundos
  Then la etiqueta del aliado cambia a "EN LÍNEA" en color verde

6. Resumen del Backlog al Cierre del Sprint 1

| ID        | Historia de Usuario              | Épica | Prioridad | Puntos     |
| --------- | -------------------------------- | ----- | --------- | ---------- |
| **US-01** | Registro y Filtro de Seguridad   | EP-01 | Alta      | 3          |
| **US-02** | Login y Sesiones de Usuario      | EP-01 | Alta      | 2          |
| **US-03** | Estado de Conexión (Tiempo Real) | EP-02 | Alta      | 5          |
| **US-04** | Sistema de Amigos y Bloqueos     | EP-02 | Media     | 5          |
| **US-05** | Ranking Global Competitivo       | EP-04 | Baja      | 3          |
| **TOTAL** |                                  |       |           | **18 pts** |


7. Próximo Paso
El Sprint 2 se enfocará en el desarrollo de los scripts PHP y JavaScript necesarios para implementar la lógica del chat en tiempo real y la visualización dinámica del Libro de Alianzas.

MythCore RPG Launcher — CBTis 47 · Marzo – Abril 2026
