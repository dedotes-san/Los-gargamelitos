#  Database Normalization Report – MythCore RPG Launcher

This report explains how the MythCore database follows normalization rules to reduce redundancy and improve data integrity.

The database is normalized up to the **Third Normal Form (3NF)**.

---

#  FIRST NORMAL FORM (1NF)

A table is in First Normal Form when:

- Each column contains atomic values
- Each record is unique
- There are no repeating groups

## Example Tables in 1NF

### users

Each user record contains unique values:

| id | username | email | level | xp |
|----|----------|--------|-------|----|
| 1 | player01 | p@email.com | 5 | 200 |

✔ No repeating values  
✔ Each user has a unique ID  

---

### messages

Each message is stored separately:

| id | sender_id | receiver_id | message |
|----|------------|--------------|----------|
| 1 | 2 | 3 | Hello |

✔ Messages are stored individually  
✔ No grouped messages  

---

#  SECOND NORMAL FORM (2NF)

A table is in Second Normal Form when:

- It is already in 1NF
- All non-key attributes depend on the entire primary key

## Example

### favorites

Primary Key: **id**

| id | user_id | game_id |
|----|---------|---------|
| 1 | 2 | 5 |

✔ game_id depends fully on id  
✔ user_id depends fully on id  

No partial dependencies exist.

---

### friends

Primary Key: **id**

| id | sender_id | receiver_id | status |
|----|------------|--------------|--------|
| 1 | 3 | 5 | accepted |

✔ All columns depend on id  
✔ No partial key dependency  

---

#  THIRD NORMAL FORM (3NF)

A table is in Third Normal Form when:

- It is already in 2NF
- No transitive dependencies exist

## Example

### games and categories separation

Instead of:

```text
games:
id | name | category_name
