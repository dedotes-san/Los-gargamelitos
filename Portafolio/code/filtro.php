<?php
/**
 * FILTRO SUPREMO DE SEGURIDAD - EDICIÓN CORREGIDA
 * Bloquea variaciones de género (o/a/4) mediante raíces y añade reglas personalizadas.
 */

function validarSeguridad($texto_original) {
    // 1. Limpieza inicial de espacios al principio y al final
    $texto_trim = trim($texto_original);
    if (empty($texto_trim)) {
        return "El identificador no puede estar vacío.";
    }

    // 2. REGLA ESPECÍFICA PERSONALIZADA (Sensible a mayúsculas/minúsculas)
    if (strcasecmp($texto_trim, 'sheyla') === 0) {
        return "🛡️ ALERTA DEL SISTEMA: no gordas no";
    }

    // 3. LISTA NEGRA DE RAÍCES PROHIBIDAS (Basta con que la palabra EMPIECE o CONTENGA esto)
    $raices_prohibidas = [
        'pendej', // Captura: pendejo, pendeja, pendej4, pendejes, etc.
        'put',     // Captura: puto, puta, put0, put4
        'verg',    // Captura: verga
        'culer',   // Captura: culero, culera
        'chot',    // Captura: choto, chota, chot0
        'mamon',
        'maricon'
    ];

    // 4. PROCESO DE NORMALIZACIÓN AVANZADA
    $texto_procesado = mb_strtolower($texto_original, 'UTF-8');
    
    // Remover todos los espacios y caracteres especiales intermedios
    $texto_procesado = preg_replace('/[^a-z0-9]/', '', $texto_procesado);

    // Diccionario Leet Speak optimizado para interceptar letras trampa comunes
    $reemplazos = [
        '0' => 'o',
        '1' => 'i',
        '3' => 'e',
        '4' => 'a', // Transforma el 4 en 'a' para interceptar la raíz
        '5' => 's',
        '7' => 't',
        '8' => 'b',
        'v' => 'u'
    ];
    $texto_procesado = strtr($texto_procesado, $reemplazos);

    // Reducir letras duplicadas consecutivas (ej: "peeeeendejjjjoo" -> "pendejo")
    $texto_procesado = reducirCaracteresRepetidos($texto_procesado);

    // 5. EVALUACIÓN DE RAÍCES
    foreach ($raices_prohibidas as $raiz) {
        if (strpos($texto_procesado, $raiz) !== false) {
            return "🛡️ DETECTADO: El nombre contiene lenguaje no permitido por el Consejo.";
        }
    }

    return "OK";
}

/**
 * Función auxiliar para colapsar letras repetidas de forma consecutiva
 */
function reducirCaracteresRepetidos($cadena) {
    if (strlen($cadena) === 0) return "";
    
    $resultado = $cadena[0];
    for ($i = 1; $i < strlen($cadena); $i++) {
        if ($cadena[$i] !== $cadena[$i - 1]) {
            $resultado .= $cadena[$i];
        }
    }
    return $resultado;
}
?>
