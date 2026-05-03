# 🎯 Product Backlog: MythCore RPG Launcher

### 🛡️ Product Goal
> Permitir a los jugadores de RPG gestionar su experiencia de juego de forma integral, ofreciendo un sistema de 
alianzas en tiempo real, buscador de juegos, chat seguro y progresión de personajes (XP/Logros) mediante una interfaz inmersiva medieval.

---

### 📦 Epics

| ID | Nombre de la Épica | Prioridad |
|---|---|---|
| EP-01 | Autenticación y Seguridad Extrema | Alta |
| EP-02 | Libro de Alianzas (Social) | Alta |
| EP-03 | Gestión de Títulos (RPG Library) | Media |
| EP-04 | Sistema de Progresión y Logros | Media |

---

#### US-01 — Libro de Alianzas: Estado en Tiempo Real

**As a** guerrero de MythCore,
**I want to** ver quién de mis aliados está conectado,
**So that** pueda enviar un "cuervo" solo cuando sea efectivo.

**Priority:** High | **Story Points:** 5

##### Acceptance Criteria
```gherkin
Feature: Estado de Conexión Dinámico

  Scenario: Actualización automática del rastro
    Given el usuario está en el "Libro de Alianzas"
    When el servidor detecta un rastro (last_seen) menor a 90 segundos
    Then la etiqueta del aliado cambia a "EN LÍNEA" en color verde
    And el cambio se refleja sin necesidad de recargar la página
US-02 — Filtro de Nombres Extremo
As a administrador,
I want to bloquear correos tras 3 intentos de usar groserías,
So that el ranking se mantenga limpio y respetuoso.

Priority: High | Story Points: 3

Acceptance Criteria
Gherkin
Feature: Filtro de Lenguaje Prohibido

  Scenario: Agotar oportunidades
    Given el usuario ya ha intentado usar 2 nombres ofensivos
    When el usuario ingresa un tercer nombre con groserías
    Then el sistema bloquea la cuenta y el correo permanentemente
