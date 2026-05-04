# 🛡️ Technical Summary — MythCore RPG Launcher
**Versión:** 1.0 (Sprint 1)  
**Periodo:** Marzo – Abril 2026  
**Institución:** CBTis 47  

---

## 1. Descripción General

**MythCore** es un ecosistema integral para entusiastas de juegos RPG. Funciona como un lanzador (launcher) que centraliza la gestión de una biblioteca de juegos, interacción social en tiempo real, un sistema competitivo de niveles (XP) y una infraestructura de seguridad avanzada que incluye filtros de comportamiento y auditoría de perfiles.

---

## 2. Objetivo del Sistema

Desarrollar una plataforma interactiva que combine la ejecución de videojuegos con redes sociales funcionales, permitiendo a los usuarios gestionar sus progresos (logros y XP), competir en rankings globales y comunicarse de forma segura mediante un sistema de chat con moderación automática.

---

## 3. Equipo de Desarrollo

| Nombre | Rol |
| :--- | :--- |
| **A. Irvin** | Analista y Diseñador |
| **B. Dorian** | Desarrollador SQL |
| **C. Derek** | Administrador (DBA) |
| **D. Manuel** | Maestro de Consultas |
| **E. Carlos** | Probador SQL (Tester) |

---

## 4. Tecnologías Utilizadas

| Componente | Tecnología |
| :--- | :--- |
| **Frontend** | HTML5, CSS3 (Animaciones, Efectos de Rayos), JavaScript |
| **Backend** | PHP (Lógica de servidor y Hashing) |
| **Base de Datos** | MySQL (Alojada en InfinityFree) |
| **Real-time** | Pusher JS (Sincronización de chat y estados) |

---

## 5. Épicas del Proyecto (Epics)

| ID | Épica | Prioridad |
| :--- | :--- | :--- |
| **EP-01** | Autenticación y Seguridad (Filtro de Baneo) | Crítica |
| **EP-02** | Sistema Social (Chat, Amigos y Bloqueos) | Alta |
| **EP-03** | Biblioteca de Juegos y Favoritos | Alta |
| **EP-04** | Gamificación (Ranking, XP y Logros) | Media |
| **EP-05** | Personalización de Perfil y Ajustes | Baja |

---

## 6. Estándares y Decisiones de Diseño

*   **Seguridad Extrema:** Sistema de filtrado de palabras prohibidas con 3 oportunidades antes del baneo permanente por correo y usuario.
*   **Gestión de XP:** Sistema dinámico donde la experiencia se acumula mediante el tiempo de juego, afectando el ranking global en tiempo real.
*   **Privacidad Social:** Sistema de bloqueo "silencioso" donde el usuario bloqueado no recibe notificación, pero sus mensajes nunca llegan al destinatario.
*   **Multimedia:** Integración de audio ambiental dinámico (truenos/relámpagos) y música de fondo persistente.

---

## 7. Product Backlog — Historias de Usuario

| ID | Historia de Usuario | Épica | Prioridad | Puntos |
| :--- | :--- | :--- | :--- | :--- |
| **US-01** | Registro con validación de seguridad (10 chars) | EP-01 | Alta | 3 |
| **US-02** | Filtro de groserías y baneo automático | EP-01 | Alta | 5 |
| **US-03** | Recuperación de cuenta (Reset Password) | EP-01 | Media | 3 |
| **US-04** | Chat en tiempo real con borrado de historial | EP-02 | Alta | 5 |
| **US-05** | Buscador de amigos y sistema de bloqueos | EP-02 | Alta | 5 |
| **US-06** | Catálogo de juegos con sistema de favoritos | EP-03 | Media | 3 |
| **US-07** | Ranking global basado en nivel y XP | EP-04 | Media | 3 |
| **US-08** | Sistema de 32 logros con animaciones | EP-04 | Baja | 8 |
| **US-09** | Personalización de avatar y cambio de nombre | EP-05 | Baja | 2 |
| **Total** | | | | **37 pts** |

---

## 8. Alcance del Sistema (Scope)

### En Alcance (v1.0)
- Autenticación segura y recuperación de contraseña.
- Chat individual con funciones de bloqueo y eliminar amigos.
- Sistema de niveles, XP y 32 logros animados.
- Biblioteca de juegos con filtro de favoritos y categorías.
- Efectos visuales y sonoros ambientales.

### Fuera de Alcance / Próximas Mejoras
- Buscador predictivo (autocompletado) de juegos y amigos.
- Integración de cámara y envío de archivos en el chat.
- Avatares 3D personalizables.
- Sistema de grupos/clanes con historial de solicitudes.

---

*MythCore RPG Launcher — CBTis 47 · Marzo – Abril 2026*
