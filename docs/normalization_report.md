# Normalization Report

## First Normal Form (1NF)

The database satisfies First Normal Form because:

* Each table has a primary key.
* Each field contains atomic values (no multiple values in a single column).
* There are no repeating groups.

Example:
The `users` table stores one user per row and each column has a single value.

---

## Second Normal Form (2NF)

The database satisfies Second Normal Form because:

* All non-key attributes depend entirely on the primary key.
* There are no partial dependencies.

Example:
In the `games` table, the title, developer_id, and genre_id depend only on `game_id`.

---

## Third Normal Form (3NF)

The database satisfies Third Normal Form because:

* There are no transitive dependencies.
* Data about developers and genres is stored in separate tables.

Example:
Instead of storing developer names directly in the games table, we reference them using `developer_id`.

This avoids redundancy and improves data integrity.

