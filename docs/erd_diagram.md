## Diagrama Entidad-Relación (ER)

```mermaid
erDiagram

    USERS {
        INT id PK
        VARCHAR username
        VARCHAR email
        VARCHAR password
        DATETIME created_at
    }

    GAMES {
        INT id PK
        VARCHAR name
        TEXT description
        INT id_category FK
    }

    CATEGORIES {
        INT id_category PK
        VARCHAR name
    }

    FAVORITES {
        INT id PK
        INT user_id FK
        INT game_id FK
    }

    FRIENDS {
        INT id PK
        INT sender_id FK
        INT receiver_id FK
        VARCHAR status
    }

    FRIEND_REQUESTS {
        INT id PK
        INT sender_id FK
        INT receiver_id FK
        VARCHAR status
    }

    BLOCKED_USERS {
        INT id PK
        INT blocker_id FK
        INT blocked_id FK
    }

    MESSAGES {
        INT id PK
        INT sender_id FK
        INT receiver_id FK
        TEXT message
        DATETIME sent_at
    }

    REPORTS {
        INT id PK
        INT reported_id FK
        TEXT reason
    }

    USERS ||--o{ FAVORITES : has
    GAMES ||--o{ FAVORITES : contains

    USERS ||--o{ FRIENDS : sends
    USERS ||--o{ FRIEND_REQUESTS : requests

    USERS ||--o{ BLOCKED_USERS : blocks

    USERS ||--o{ MESSAGES : sends
    USERS ||--o{ MESSAGES : receives

    USERS ||--o{ REPORTS : reports

    CATEGORIES ||--o{ GAMES : categorizes
