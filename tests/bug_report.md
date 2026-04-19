#  Bug Report — MythCore RPG Launcher

Author: **Los garagamelitos**

This document contains detected issues during database testing and how they were resolved.

---

#  Bug Report Cases

##  Bug #1 — Foreign Key Error in Favorites Table

**Description:**
While inserting data into the favorites table, an error occurred due to a missing referenced user.

**Expected Result:**
The record should insert successfully if the user and game exist.

**Actual Result:**
MySQL returned a foreign key constraint error.

**Cause:**
The user_id referenced did not exist in the users table.

**Fix Applied:**
Inserted valid user data before inserting favorites.

**Status:**
 Fixed

---

##  Bug #2 — Duplicate Email in Users Table

**Description:**
Attempted to insert two users with the same email address.

**Expected Result:**
The database should prevent duplicate emails.

**Actual Result:**
Duplicate entries were allowed initially.

**Cause:**
The email column did not have a UNIQUE constraint.

**Fix Applied:**
Added UNIQUE constraint to email column in users table.

Example Fix:

```sql
ALTER TABLE users
ADD UNIQUE (email);
```

**Status:**
 Fixed

---

##  Bug #3 — Message Insert Without Receiver

**Description:**
A message was inserted without specifying receiver_id.

**Expected Result:**
Database should reject null receiver.

**Actual Result:**
Null value was accepted.

**Cause:**
receiver_id column allowed NULL values.

**Fix Applied:**
Modified column to NOT NULL.

Example Fix:

```sql
ALTER TABLE messages
MODIFY receiver_id INT NOT NULL;
```

**Status:**
 Fixed

---

##  Bug #4 — Invalid Category Reference

**Description:**
A game was inserted with an invalid category ID.

**Expected Result:**
Insert should fail.

**Actual Result:**
Game was inserted without validation.

**Cause:**
Foreign key constraint was missing.

**Fix Applied:**
Added foreign key to categories table.

**Status:**
 Fixed

---

# Testing Summary

All major relational integrity issues were tested and resolved.

Final database state:

* Foreign keys validated
* Unique values enforced
* Required fields validated
* Data consistency confirmed

Database status:

 **Stable and Working**
