#  MythCore RPG Launcher — Technical Documentation
**Versión:** 1.0 (Sprint 1)  
**Institución:** CBTis 47  
**Metodología:** Scrum  

---

## 1. Perfil del Proyecto
**MythCore** es un lanzador (launcher) integral para juegos RPG que centraliza la gestión de bibliotecas, interacción social en tiempo real y competitividad mediante gamificación.

### 1.1 Equipo de Desarrollo
| Nombre | Rol |
| :--- | :--- |
| **A. Irvin** | Analista y Diseñador |
| **B. Dorian** | Desarrollador SQL |
| **C. Derek** | Administrador (DBA) |
| **D. Manuel** | Maestro de Consultas |
| **E. Carlos** | Probador SQL (Tester) |

---

## 2. Historias de Usuario (User Stories)

| Historia de Usuario | Descripción | Prioridad |
| :--- | :--- | :--- |
| **Guerrero (Seguridad)** | Como guerrero, quiero que el sistema filtre nombres ofensivos para mantener una comunidad segura. Incluye baneo permanente tras 3 intentos fallidos. | 100 |
| **Aliado (Social)** | Como aliado, quiero buscar amigos y chatear en tiempo real con "Bloqueo Silencioso" y vaciado de historial. | 90 |
| **Competidor (XP)** | Como competidor, quiero ganar XP por tiempo de juego y ver mi posición en el Ranking Global. | 80 |
| **Coleccionista (Logros)** | Como coleccionista, quiero desbloquear 32 logros únicos con animaciones especiales. | 70 |

---

## 3. Criterios de Aceptación

###  Seguridad y Filtro
*   **Validación:** El sistema debe impedir el uso de palabras prohibidas en registros y cambios de nombre.
*   **Baneo:** Bloqueo automático de cuenta y correo tras el tercer intento de usar lenguaje inapropiado.
*   **Persistencia:** Las cuentas baneadas no pueden volver a registrarse con el mismo correo electrónico.

###  Chat y Social
*   **Real-time:** Los mensajes se deben enviar y recibir instantáneamente mediante Pusher JS.
*   **Privacidad:** El bloqueo de usuarios debe ser invisible para el emisor; sus mensajes simplemente no llegan al destino.
*   **Estados:** Mostrar indicadores dinámicos de conexión (Online/Offline).

###  Gamificación
*   **XP y Niveles:** La experiencia debe incrementarse proporcionalmente al tiempo de actividad en los juegos.
*   **Logros:** Desplegar una animación visual específica al completar cualquiera de los 32 logros.
*   **Ranking:** Tabla de posiciones global ordenada por Nivel y XP acumulada.

---

## 4. Requerimientos Técnicos

###  Stack Tecnológico
*   **Base de Datos:** MySQL (Alojada en InfinityFree).
*   **Backend:** PHP (Lógica de servidor y Hashing de contraseñas).
*   **Frontend:** HTML5, CSS3, JavaScript.
*   **Sincronización:** Pusher JS para chat en tiempo real.

###  Interfaz y UX
*   **Ambiente:** El sistema inicia con sonidos de truenos, relámpagos y música RPG persistente.
*   **Personalización:** Cambio de avatar con actualización inmediata en el historial de chat.

---

*MythCore RPG Launcher — CBTis 47 · Mayo 2026*
