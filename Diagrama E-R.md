graph TD

    RPG["🎮 RPG (Role-Playing Game)"]

    %% =====================
    %% BLOQUE 1 - PERSONAJE
    %% =====================
    subgraph PERSONAJE
        Desarrollo["Desarrollo del Personaje"]
        Estadisticas["Sistema de Estadísticas"]
        Clases["Clases"]

        Desarrollo --> Niveles["Niveles"]
        Desarrollo --> Experiencia["Experiencia (EXP)"]
        Desarrollo --> Habilidades["Habilidades"]

        Estadisticas --> Fuerza["Fuerza"]
        Estadisticas --> Defensa["Defensa"]
        Estadisticas --> Inteligencia["Inteligencia"]
        Estadisticas --> Agilidad["Agilidad"]
        Estadisticas --> Vida["Vida (HP)"]
        Estadisticas --> Mana["Maná (MP)"]

        Clases --> Guerrero["Guerrero"]
        Clases --> Mago["Mago"]
        Clases --> Arquero["Arquero"]
        Clases --> Asesino["Asesino"]
    end

    %% =====================
    %% BLOQUE 2 - SISTEMAS
    %% =====================
    subgraph SISTEMAS
        Combate["Sistema de Combate"]
        Inventario["Sistema de Inventario"]
        Progresion["Sistema de Progresión"]

        Combate --> Turnos["Por Turnos"]
        Combate --> TiempoReal["Tiempo Real"]
        Combate --> Estrategico["Estratégico"]

        Inventario --> Armas["Armas"]
        Inventario --> Armaduras["Armaduras"]
        Inventario --> Pociones["Pociones"]
        Inventario --> Objetos["Objetos Especiales"]

        Progresion --> SubirNivel["Subida de Nivel"]
        Progresion --> Desbloqueo["Desbloqueo de Habilidades"]
        Progresion --> MejoraEquipo["Mejora de Equipamiento"]
    end

    %% =====================
    %% BLOQUE 3 - MUNDO
    %% =====================
    subgraph MUNDO
        Historia["Historia y Narrativa"]
        MundoAbierto["Mundo Abierto"]
        Facciones["Facciones"]
        Reputacion["Sistema de Reputación"]

        Historia --> Misiones["Misiones Principales"]
        Historia --> Secundarias["Misiones Secundarias"]
        Historia --> Decisiones["Decisiones del Jugador"]
    end

    %% RELACIONES PRINCIPALES
    RPG --> Desarrollo
    RPG --> Combate
    RPG --> Historia
    RPG --> Inventario
    RPG --> MundoAbierto
