erDiagram

    RPG {
        string nombre
    }

    PERSONAJE {
        string Desarrollo
        string Estadisticas
        string Clases
    }

    SISTEMAS {
        string Combate
        string Inventario
        string Progresion
    }

    MUNDO {
        string Historia
        string Mundo_Abierto
        string Facciones
    }

    DESARROLLO {
        string Niveles
        string Habilidades
    }

    ESTADISTICAS {
        int Fuerza
        int Vida_HP
    }

    COMBATE {
        string Turnos
        string Tiempo_Real
    }

    INVENTARIO {
        string Armas
        string Pociones
    }

    RPG ||--|| PERSONAJE : incluye
    RPG ||--|| SISTEMAS : incluye
    RPG ||--|| MUNDO : incluye

    PERSONAJE ||--|| DESARROLLO : contiene
    PERSONAJE ||--|| ESTADISTICAS : contiene

    SISTEMAS ||--|| COMBATE : gestiona
    SISTEMAS ||--|| INVENTARIO : gestiona
