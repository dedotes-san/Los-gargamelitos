# Data Dictionary

## Users

Stores registered users of the RPG Launcher.

| Field    | Type    | Description            |
| -------- | ------- | ---------------------- |
| user_id  | INT     | Unique user identifier |
| username | VARCHAR | User name              |
| email    | VARCHAR | User email             |
| password | VARCHAR | Encrypted password     |

## Games

Stores available games.

| Field        | Type    | Description            |
| ------------ | ------- | ---------------------- |
| game_id      | INT     | Unique game identifier |
| title        | VARCHAR | Game title             |
| developer_id | INT     | Developer reference    |
| genre_id     | INT     | Genre reference        |

## Developers

Stores game developers.

| Field        | Type    | Description                 |
| ------------ | ------- | --------------------------- |
| developer_id | INT     | Unique developer identifier |
| name         | VARCHAR | Developer name              |

## Genres

Stores game genres.

| Field    | Type    | Description             |
| -------- | ------- | ----------------------- |
| genre_id | INT     | Unique genre identifier |
| name     | VARCHAR | Genre name              |

