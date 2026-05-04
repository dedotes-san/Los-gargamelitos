#  Technical Summary — MythCore RPG Launcher
**Versión:** 1.0 (Sprint 1)  
**Periodo:** Marzo – Mayo 2026  
**Institución:** CBTis 47  
**Metodología:** Scrum  

---

## 1. Descripción General
**MythCore** es un ecosistema integral para entusiastas de juegos RPG. Funciona como un lanzador (launcher) que centraliza la gestión de una biblioteca de juegos, interacción social en tiempo real, un sistema competitivo de niveles (XP) y una infraestructura de seguridad avanzada que incluye filtros de comportamiento y auditoría de perfiles.

---

## 2. Equipo de Desarrollo

| Nombre | Rol | Responsabilidad |
| :--- | :--- | :--- |
| **A. Irvin** | Analista y Diseñador | Diseño de arquitectura y diagramas ER. |
| **B. Dorian** | Desarrollador SQL | Implementación de base de datos en servidor. |
| **C. Derek** | Administrador (DBA) | Organización de documentación y repositorios. |
| **D. Manuel** | Maestro de Consultas | Inserción de datos y reportes de ranking. |
| **E. Carlos** | Probador SQL (Tester) | Validación de seguridad y filtros de baneo. |

---

## 3. Requerimientos Funcionales (FR)

### 3.1 Autenticación y Seguridad Extrema
*   **FR-01:** Registro de usuarios con validación de contraseña segura (mínimo 10 caracteres).
*   **FR-02:** Recuperación de cuenta mediante correo electrónico y nueva contraseña.
*   **FR-03:** Filtro de seguridad que prohíbe groserías en el nombre de usuario.
*   **FR-04:** Sistema de baneo automático al agotar 3 intentos de uso de lenguaje inapropiado.
*   **FR-05:** Bloqueo de registros duplicados por correo electrónico.

### 3.2 Sistema Social y Chat
*   **FR-06:** Chat en tiempo real con capacidad de vaciado de historial.
*   **FR-07:** Buscador de amigos y gestión de lista de aliados.
*   **FR-08:** Sistema de bloqueo de usuarios; el usuario bloqueado no recibe notificación de su estado.
*   **FR-09:** Visualización dinámica de estado Online/Offline basada en la última actividad.

### 3.3 Gamificación y Biblioteca
*   **FR-10:** Ejecución de juegos RPG directamente desde el launcher.
*   **FR-11:** Sistema de "Favoritos" para organizar la biblioteca personal.
*   **FR-12:** Acumulación de XP y niveles basada en el tiempo de juego efectivo.
*   **FR-13:** Gestión de 32 logros desbloqueables con animaciones visuales.
*   **FR-14:** Ranking global competitivo visible para todos los usuarios.

---

## 4. Requerimientos No Funcionales (NFR)

### 4.1 Rendimiento y Multimedia
*   **NFR-01:** Integración de audio ambiental persistente (música de fondo y efectos de rayos).
*   **NFR-02:** Interfaz optimizada para resolución de escritorio con carga fluida de avatares.

### 4.2 Seguridad y Datos
*   **NFR-03:** Las contraseñas deben estar cifradas mediante hashing en PHP antes de su almacenamiento.
*   **NFR-04:** Sincronización de datos mediante Pusher JS para evitar latencia en el chat.
*   **NFR-05:** Hosting de base de datos en InfinityFree para acceso remoto constante.

---

## 5. Product Backlog — Sprint 1

| ID | Historia de Usuario | Épica | Prioridad | Puntos |
| :--- | :--- | :--- | :--- | :--- |
| **US-01** | Registro y Filtro de Seguridad | Autenticación | Alta | 3 |
| **US-02** | Login y Sesiones de Usuario | Autenticación | Alta | 2 |
| **US-03** | Chat en Tiempo Real | Social | Alta | 5 |
| **US-04** | Sistema de Amigos y Bloqueos | Social | Media | 5 |
| **US-05** | Ranking de XP y Niveles | Gamificación | Media | 3 |
| **US-06** | Sistema de Logros (32) | Gamificación | Baja | 8 |
| **Total** | | | | **26** |

---

## 6. Alcance del Sistema

###  En Alcance (v1.0)
*   Módulo de seguridad con baneo por palabras prohibidas.
*   Chat individual funcional y lista de amigos.
*   Sistema de XP, niveles y ranking competitivo.
*   Biblioteca de juegos con gestión de favoritos.
*   Efectos de sonido y música persistente.

###  Fuera de Alcance / Próximas Mejoras
*   Buscador predictivo (autocompletado) para juegos y amigos.
*   Transferencia de archivos y uso de cámara en el chat.
*   Creación de grupos (clanes) con historial de solicitudes.
*   Personalización de avatares 3D con accesorios.

---

*MythCore RPG Launcher — CBTis 47 · Mayo 2026*
