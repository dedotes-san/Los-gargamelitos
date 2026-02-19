# 🎮 Sistema de Inventario RPG - Modelo NoSQL

## 📌 Descripción General

Este documento describe la implementación de funcionalidades clave dentro de un sistema de inventario RPG usando un modelo NoSQL flexible basado en documentos.

---

## 📦 1. Gestión de Inventario

### ⚔️ 1.1 Gestión de Equipamiento (Espadas)

#### 📖 Historia de Usuario

> Como jugador guerrero, quiero equipar una espada con daño y durabilidad variables para enfrentar enemigos de alto nivel y saber cuándo mi arma está a punto de romperse.

---

### ✅ Criterios de Aceptación

| Elemento | Especificación |
|----------|---------------|
| `daño` | Valor numérico |
| `durabilidad` | Rango entre 0 y 100 |
| Ataque | Reduce la durabilidad del objeto |
| Durabilidad = 0 | El objeto cambia su estado a `"roto"` |

---

### 📄 Ejemplo de Documento (Espada)

```json
{
  "nombre": "Espada del Dragón",
  "tipo": "espada",
  "daño": 75,
  "durabilidad": 40,
  "estado": "activa"
}
