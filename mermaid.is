## Diagrama E-R

```mermaid
graph LR

    RPG["🎮 RPG (Role-Playing Game)"]

    %% BLOQUE PERSONAJE
    subgraph PERSONAJE
        Desarrollo["Desarrollo"]
        Estadisticas["Estadísticas"]
        Clases["Clases"]
    end

    %% BLOQUE SISTEMAS
    subgraph SISTEMAS
        Combate["Combate"]
        Inventario["Inventario"]
        Progresion["Progresión"]
    end

    %% BLOQUE MUNDO
    subgraph MUNDO
        Historia["Historia"]
        Mundo["Mundo Abierto"]
        Facciones["Facciones"]
    end

    %% RELACIONES PRINCIPALES
    RPG --> Desarrollo
    RPG --> Combate
    RPG --> Historia
    RPG --> Inventario

    %% SUBNIVELES
    Desarrollo --> Niveles["Niveles"]
    Desarrollo --> Habilidades["Habilidades"]

    Estadisticas --> Fuerza["Fuerza"]
    Estadisticas --> Vida["Vida (HP)"]

    Combate --> Turnos["Turnos"]
    Combate --> TiempoReal["Tiempo Real"]

    Inventario --> Armas["Armas"]
    Inventario --> Pociones["Pociones"]

    %% ESTILOS
    classDef principal fill:#6C5CE7,color:#ffffff,stroke:#333,stroke-width:2px;
    class RPG principal;

```

