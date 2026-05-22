# Product Backlog — RPG Launcher MythCore RPG Launcher


> **Plataforma de Gestión RPG** · Desarrollo Independiente  
> **Stack:** HTML5 · CSS3 · JavaScript · PHP · MySQL (XAMPP) · GitHub

---

## 🎯 Product Goal

Habilitar a los usuarios de un juego de rol para registrarse, gestionar su perfil de guerrero, visualizar su progreso de nivel/XP y configurar su ambiente sonoro de forma independiente a través de una aplicación web, sincronizando cada cambio con el servidor en tiempo real — reduciendo la carga manual de administración y mejorando la inmersión de los jugadores en el Nexo.

---

## 📦 Epics

| ID | Epic Name | Audience | Priority |
| :--- | :--- | :--- | :--- |
| **EP-01** | User Authentication | Guerrero | High |
| **EP-02** | Warrior Profile Management | Guerrero | High |
| **EP-03** | Ambient Audio System | Guerrero | Medium |
| **EP-04** | Experience & Leveling Logic | Guerrero | High |
| **EP-05** | System Administration | Administrator | High |

---

## 📊 Backlog Summary

| Story ID | User Story | Epic | Role | Priority | Points |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **US-01** | Warrior Registration | EP-01 | Guerrero | High | 5 |
| **US-02** | Warrior Login | EP-01 | Guerrero | High | 2 |
| **US-03** | Warrior Logout | EP-01 | Guerrero | Medium | 1 |
| **US-04** | Update ADN Visual (Avatar) | EP-02 | Guerrero | High | 5 |
| **US-05** | Edit Battle Name | EP-02 | Guerrero | High | 3 |
| **US-06** | Adjust Master Volume | EP-03 | Guerrero | Medium | 3 |
| **US-07** | Audio Sync with Database | EP-03 | Guerrero | High | 5 |
| **US-08** | Real-time XP Progress Bar | EP-04 | Guerrero | High | 3 |
| **US-09** | Manual Stat Modification | EP-05 | Admin | High | 5 |
| **US-10** | Manage Warrior Database (CRUD) | EP-05 | Admin | High | 5 |
| **Total** | | | | | **37** |

---

## EP-01 · User Authentication

### US-01 — Warrior Registration
**As a** new visitor,  
**I want to** create a warrior account with my credentials,  
**so that** I can start my journey in the RPG and save my progress.

**Priority:** High | **Story Points:** 5

#### Acceptance Criteria
```gherkin
Feature: Warrior Registration

  Scenario: Successful registration with valid data
    Given the user is on the registration page
    When the user enters a valid username, email, and password
    And the user submits the registration form
    Then the system creates a new record in the USERS table
    And initializes level = 1, xp = 0, and avatar = "default.png"
    And the user is redirected to the login page
    And a message "¡BIENVENIDO AL NEXO!" is displayed

  Scenario: Registration fails with an existing username
    Given the user is on the registration page
    When the user enters a username that already exists in the USERS table
    And the user submits the registration form
    Then the system displays an error message indicating the username is taken
    And no new record is created in the database
US-02 — Warrior Login
As a registered warrior,

I want to log in with my credentials,

so that I can access my profile and stats.

Priority: High | Story Points: 2

Acceptance Criteria
Gherkin
Feature: Warrior Login

  Scenario: Successful login
    Given the user is on the login page
    When the user enters their registered username and correct password
    And the user clicks the login button
    Then the system creates a PHP session ($_SESSION['user_id'])
    And the user is redirected to the dashboard.php
EP-02 · Warrior Profile Management
US-04 — Update ADN Visual (Avatar)
As a logged-in warrior,

I want to upload a profile image (ADN Visual),

so that I can personalize my identity in the Nexo.

Priority: High | Story Points: 5

Acceptance Criteria
Gherkin
Feature: Avatar Update

  Scenario: Successful image upload
    Given the user is in the "Perfil de Guerrero" section
    When the user selects a .jpg or .png file from their device
    And clicks on "Cargar ADN Visual"
    Then the file is moved to the uploads/ directory with a unique ID
    And the avatar column in the USERS table is UPDATED for the current user
    And the profile image updates instantly in the UI
EP-03 · Ambient Audio System
US-06 — Adjust Master Volume
As a logged-in warrior,

I want to adjust the background music volume through a slider,

so that I can customize the battle atmosphere to my preference.

Priority: Medium | Story Points: 3

Acceptance Criteria
Gherkin
Feature: Master Volume Adjustment

  Scenario: Real-time volume change
    Given the audioMaster object is playing "battle.mp3"
    When the user moves the volume slider (volRange)
    Then the system updates the audioMaster.volume property immediately
    And no page reload is required
EP-05 · System Administration
US-10 — Manage Warrior Database (CRUD)
As an Administrator,

I want to create, edit, or delete warrior records,

so that I can maintain the integrity of the Nexo database.

Priority: High | Story Points: 5

Acceptance Criteria
Gherkin
Feature: Warrior CRUD

  Scenario: Manual Rank Correction
    Given the administrator selects a warrior with level 9
    When they modify the level field to 10 and save
    Then the system executes an UPDATE in the USERS table
    And the change is reflected in the warrior's next session

---

## EP-03 · Ambient Audio System

### US-06 — Adjust Master Volume
**As a** logged-in warrior,  
**I want to** adjust the background music volume through a slider,  
**so that** I can customize the battle atmosphere to my preference.

**Priority:** Medium | **Story Points:** 3

#### Acceptance Criteria
```gherkin
Feature: Master Volume Adjustment

  Scenario: Real-time volume change
    Given the audioMaster object is playing "battle.mp3"
    When the user moves the volume slider (volRange)
    Then the system updates the audioMaster.volume property immediately
    And the UI displays the percentage (0% - 100%) in the volPerc element
    And no page reload is required for the change to take effect

  Scenario: Muting the audio
    Given the user is on the Sound System panel
    When the user moves the slider to the minimum position (0)
    Then the system sets audioMaster.volume to 0
    And the UI label displays "SILENCIO"
US-07 — Audio Sync with DatabaseAs a logged-in warrior,I want to save my audio preferences in the cloud,so that my volume level remains consistent across different sessions and devices.Priority: High | Story Points: 5Acceptance CriteriaGherkinFeature: Audio Preference Persistence

  Scenario: Successful synchronization with database
    Given the user has adjusted the volume slider to a specific level
    When the user clicks the "Sincronizar Cambios con la Nube" button
    Then the system executes an UPDATE on the vol_master column in the USERS table
    And a confirmation message "¡EXPEDIENTE ACTUALIZADO CON ÉXITO!" is displayed
    And the new volume level is loaded automatically on the next login
EP-04 · Experience & Leveling LogicUS-08 — Real-time XP Progress BarAs a logged-in warrior,I want to see my current level and an XP progress bar,so that I can track how much experience I need to reach the next rank.Priority: High | Story Points: 3Acceptance CriteriaGherkinFeature: XP Visualization

  Scenario: Correct progress bar calculation
    Given the user has a record in the USERS table with level = 9 and xp = 75
    When the dashboard or configuration page loads
    Then the system calculates the progress percentage as (xp / 100) * 100
    And the .level-fill element width is set to 75%
    And the labels "Nivel 9" and "75 / 100 XP" are displayed correctly
EP-05 · System Administration & SecurityUS-09 — Security Protocol CheckAs a logged-in warrior,I want to manage my security protocols (visibility and keys),so that I can protect my progress from unauthorized access.Priority: Medium | Story Points: 2Acceptance CriteriaGherkinFeature: Security Management

  Scenario: Toggle profile visibility
    Given the user is in the "Protocolos de Seguridad" section
    When the user toggles the "Visibilidad del Perfil" checkbox
    Then the system updates the visibility status in the database
    And determines if other warriors can view the user's achievements
US-10 — Manual Stat Modification (Admin)As an Administrator,I want to manually edit any warrior's level or XP,so that I can correct errors or reward specific heroic actions.Priority: High | Story Points: 5Acceptance CriteriaGherkinFeature: Manual Stat Correction

  Scenario: Successful stat override
    Given the administrator has identified a specific warrior's ID
    When they update the level or xp fields via the admin panel
    Then the system executes an UPDATE on the USERS table
    And the warrior sees the updated stats immediately upon their next session refresh
📈 Story Points SummaryEpicStoriesTotal PointsEP-01 · User AuthenticationUS-01, US-02, US-038EP-02 · Warrior Profile ManagementUS-04, US-058EP-03 · Ambient Audio SystemUS-06, US-078EP-04 · Experience & Leveling LogicUS-083EP-05 · System AdministrationUS-09, US-1010TOTAL37

---

## EP-06 · Gestión de Misiones Asignadas (Nivel Maestro)
> **Roles:** Administrador / Maestro de Armas  
> **Tablas involucradas:** `USERS`, `MISSIONS`, `USER_MISSIONS`, `XP_LOG`

### US-12 — Consultar Estadísticas de Jugadores Asignados
**Como** Maestro de Armas,  
**quiero** consultar los guerreros bajo mi supervisión con su nivel, XP actual y estado,  
**para** monitorear el progreso del servidor y planificar eventos de nivelación.

**Prioridad:** Alta | **Story Points:** 3

#### Criterios de Aceptación
```gherkin
Feature: Consulta de Estadísticas de Guerreros

  Scenario: Visualización exitosa de guerreros
    Given el Maestro de Armas ha iniciado sesión
    When navega a la sección "Gestión de Guerreros"
    Then el sistema consulta la tabla USERS y despliega la lista de jugadores
    And cada registro muestra: user_name, level, current_xp, avatar y status (online/offline)

  Scenario: Filtrar guerreros por nivel
    Given el Maestro de Armas está viendo la lista de guerreros
    When aplica un filtro para "Nivel 9"
    Then el sistema muestra solo los registros en USERS donde level = 9
EP-07 · Gestión de Audio y Soporte Técnico
Roles: Centinela de Audio / Soporte

Tablas involucradas: USERS, INCIDENTS_LOG, AUDIO_SETTINGS

US-16 — Registrar Incidencias de Audio o Sistema
Como Centinela del Nexo,

quiero registrar cualquier fallo reportado en la música ambiental o errores de carga,

para que el administrador principal pueda realizar el seguimiento técnico.

Prioridad: Media | Story Points: 3

Criterios de Aceptación
Gherkin
Feature: Registro de Incidencias Técnicas

  Scenario: Registro exitoso de error de audio
    Given el Centinela detecta que el archivo "battle.mp3" no carga (Error 404)
    When completa el formulario de incidencia con tipo "Audio" y descripción del error
    Then el sistema inserta un registro en la tabla INCIDENTS_LOG con id_user, tipo, descripción y timestamp
    And muestra el mensaje "Incidencia reportada al Gran Maestro"
EP-09 · Administración del Reino (CRUD Maestro)
Role: Gran Administrador

Tablas involucradas: USERS, MISSIONS, AUDIO_SETTINGS, XP_TABLE

US-19 — Gestionar Guerreros y Niveles (CRUD)
Como Gran Administrador,

quiero crear, editar, subir de nivel o eliminar guerreros del sistema,

para mantener el catálogo de usuarios actualizado y libre de tramposos.

Prioridad: Alta | Story Points: 5

Criterios de Aceptación
Gherkin
Feature: Gestión de Usuarios (CRUD)

  Scenario: Subir nivel manualmente a un guerrero
    Given el Administrador selecciona un guerrero en la tabla USERS
    When modifica el campo level de "9" a "10" y confirma los cambios
    Then el sistema ejecuta un UPDATE en la base de datos
    And el cambio se refleja instantáneamente en el Dashboard del usuario

  Scenario: Eliminación de guerrero sin progreso activo
    Given el Administrador selecciona un usuario con level = 1 y xp = 0
    When confirma la eliminación del registro
    Then el sistema borra el registro de la tabla USERS y libera el user_name
US-22 — Ver Reportes de Progreso y Actividad
Como Gran Administrador,

quiero ver un reporte consolidado de cuánta XP se ha ganado en el servidor y cuántos niveles se han subido por día,

para medir el rendimiento y actividad de mi RPG Launcher.

Prioridad: Media | Story Points: 3

Criterios de Aceptación
Gherkin
Feature: Reportes de Actividad del Servidor

  Scenario: Visualizar total de XP global
    Given el Administrador accede al módulo de reportes
    When la página carga
    Then el sistema suma el campo xp de todos los registros en USERS
    And muestra el total de "Experiencia Acumulada en el Reino" en el gráfico principal
📈 Story Points Summary (Final)
Epic	Stories	Total Points
EP-01 · User Authentication	US-01, US-02, US-03	8
EP-02 · Warrior Profile Management	US-04, US-05	8
EP-03 · Ambient Audio System	US-06, US-07	8
EP-04 · Experience & Leveling Logic	US-08	3
EP-05 · System Administration	US-12, US-16, US-19, US-22	16
TOTAL GENERAL		43 pts

---

### US-23 — Cancelar o Modificar Progresos de Guerreros
**Como** Gran Administrador,  
**quiero** cancelar misiones o modificar registros de nivel en casos especiales,  
**de modo que** pueda corregir errores de sistema o manejar solicitudes directas de los guerreros.

**Prioridad:** Alta | **Story Points:** 3

#### Acceptance Criteria
```gherkin
Feature: Modificación Administrativa de Perfiles

  Scenario: Cancelar una misión confirmada (XP reversible)
    Given el administrador localiza un registro en USER_MISSIONS 
         con status = "confirmed"
    When selecciona la opción "Revocar Misión" y confirma la acción
    Then el sistema ejecuta un UPDATE en USER_MISSIONS seteando status = "cancelled"
    And descuenta la XP otorgada previamente del campo xp en la tabla USERS
    And la misión vuelve a estar disponible para ser reclamada por el usuario

  Scenario: Corrección manual de nivel
    Given el administrador localiza un guerrero con nivel incorrecto
    When selecciona la opción "Ajuste de Rango Manual"
    Then el sistema ejecuta un UPDATE en la tabla USERS modificando el campo level
    And registra el cambio en el historial de auditoría del sistema

  Scenario: Intento de cancelación en registro ya cancelado
    Given un registro en USER_MISSIONS ya tiene status = "cancelled"
    When el administrador intenta cancelarlo de nuevo
    Then el sistema despliega un mensaje indicando que el registro ya fue revocado
    And no se ejecuta ningún UPDATE adicional en la base de datos

  Scenario: Confirmar manualmente una actualización de estado pendiente
    Given el administrador localiza un cambio de avatar o ajuste de audio 
         con status = "pending" (bloqueado por sistema)
    When selecciona la opción "Confirmar Manualmente"
    Then el sistema fuerza el UPDATE en la tabla USERS seteando status = "confirmed"
    And los cambios se reflejan en el perfil del guerrero inmediatamente
📈 Story Points Summary (Final del Proyecto)
Epic	Stories	Total Points
EP-01 · User Authentication	US-01, US-02, US-03	8
EP-02 · Warrior Profile Management	US-04, US-05	8
EP-03 · Ambient Audio System	US-06, US-07	8
EP-04 · Experience & Leveling Logic	US-08	3
EP-05 · System Administration	US-09, US-10, US-12, US-16, US-19, US-22, US-23	26
Grand Total	15 stories	53 pts
