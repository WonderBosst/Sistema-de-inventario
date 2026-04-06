<?php

function obtenerDatosReporte($conn, $where){

    // Total ventas
    $ventas = $conn->query("
        SELECT SUM(ingreso_total_usd) as total
        FROM ventas
        WHERE $where
    ")->fetch_assoc()['total'] ?? 0;

    // Costo total producción
    $produccion = $conn->query("
        SELECT SUM(costo_total_usd) as total
        FROM produccion
        WHERE $where AND activo=1
    ")->fetch_assoc()['total'] ?? 0;

    // Total piezas producidas
    $piezas_producidas = $conn->query("
        SELECT SUM(cantidad_producida) as total
        FROM produccion
        WHERE $where AND activo=1
    ")->fetch_assoc()['total'] ?? 0;

    // Total piezas vendidas
    $piezas_vendidas = $conn->query("
        SELECT SUM(cantidad) as total
        FROM ventas
        WHERE $where
    ")->fetch_assoc()['total'] ?? 0;

    return [
        'ventas' => $ventas,
        'produccion' => $produccion,
        'utilidad' => $ventas - $produccion,
        'piezas_producidas' => $piezas_producidas,
        'piezas_vendidas' => $piezas_vendidas
    ];
}