<?php

function validarStock($conn, $producto_id, $cantidad){

    $receta = $conn->prepare("SELECT materia_prima_id, cantidad_usada 
                              FROM recetas WHERE producto_id=?");
    $receta->bind_param("i",$producto_id);
    $receta->execute();
    $result = $receta->get_result();

    while($r = $result->fetch_assoc()){
        $necesario = $r['cantidad_usada'] * $cantidad;

        $stock = $conn->query("SELECT stock_actual FROM materias_primas 
                               WHERE id=".$r['materia_prima_id'])
                               ->fetch_assoc()['stock_actual'];

        if($stock < $necesario){
            return false;
        }
    }

    return true;
}


function aplicarProduccion($conn, $producto_id, $cantidad){

    $costo_total = 0;

    $receta = $conn->prepare("SELECT materia_prima_id, cantidad_usada 
                              FROM recetas WHERE producto_id=?");
    $receta->bind_param("i",$producto_id);
    $receta->execute();
    $result = $receta->get_result();

    while($r = $result->fetch_assoc()){

        $materia_id = $r['materia_prima_id'];
        $cantidad_usada = $r['cantidad_usada'] * $cantidad;

        $conn->query("UPDATE materias_primas 
                      SET stock_actual = stock_actual - $cantidad_usada 
                      WHERE id=$materia_id");

        $precio = $conn->query("SELECT costo_unitario_usd FROM materias_primas 
                                WHERE id=$materia_id")
                                ->fetch_assoc()['costo_unitario_usd'];

        $costo_total += $precio * $cantidad_usada;
    }

    $conn->query("UPDATE productos 
                  SET stock_actual = stock_actual + $cantidad 
                  WHERE id=$producto_id");

    return $costo_total;
}


function revertirProduccion($conn, $producto_id, $cantidad){

    $receta = $conn->prepare("SELECT materia_prima_id, cantidad_usada 
                              FROM recetas WHERE producto_id=?");
    $receta->bind_param("i",$producto_id);
    $receta->execute();
    $result = $receta->get_result();

    while($r = $result->fetch_assoc()){

        $materia_id = $r['materia_prima_id'];
        $cantidad_usada = $r['cantidad_usada'] * $cantidad;

        $conn->query("UPDATE materias_primas 
                      SET stock_actual = stock_actual + $cantidad_usada 
                      WHERE id=$materia_id");
    }

    $conn->query("UPDATE productos 
                  SET stock_actual = stock_actual - $cantidad 
                  WHERE id=$producto_id");
}