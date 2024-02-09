<?php
// benchmark.php

function performHeavyComputation() {
    $result = 0;
    for ($i = 0; $i < 100000000; $i++) {
        $result += sqrt($i);
    }
    return $result;
}

// Capturamos el tiempo de inicio
$startTime = microtime(true);

// Ejecutamos la función intensiva
performHeavyComputation();

// Capturamos el tiempo de finalización y calculamos la duración
$endTime = microtime(true);
$executionTime = $endTime - $startTime;

echo "Tiempo de ejecución: " . number_format($executionTime, 4) . " segundos\n";

// Función para ejecutar un algoritmo de ordenamiento de burbuja
function bubbleSort(array $arr): array {
    $n = sizeof($arr);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }
    return $arr;
}

// Función recursiva para calcular factorial
function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

// Generar un array con valores aleatorios
$arraySize = 1000;
$randomArray = array_map(function() {
    return rand(1, 1000);
}, range(1, $arraySize));

// Medir el tiempo de ejecución del ordenamiento de burbuja
$start = microtime(true);
$sortedArray = bubbleSort($randomArray);
$end = microtime(true);
echo "Tiempo de ejecución del ordenamiento de burbuja: " . number_format(($end - $start), 4) . " segundos\n";

// Medir el tiempo de ejecución de la función factorial repetidas veces
$iterations = 10000; // Aumenta el número de iteraciones para aumentar la carga de trabajo
$start = microtime(true);

for ($i = 0; $i < $iterations; $i++) {
    $factResult = factorial(20); // Puedes ajustar este número para cambiar la carga de trabajo
}

$end = microtime(true);
$executionTime = ($end - $start) / $iterations; // Promedio por iteración
echo "Tiempo promedio de ejecución de la función factorial por iteración: " . number_format($executionTime, 8) . " segundos\n";

function sieveOfEratosthenes($n) {
    $prime = array_fill(0, $n+1, true);
    for ($p = 2; $p * $p <= $n; $p++) {
        if ($prime[$p] == true) {
            for ($i = $p * $p; $i <= $n; $i += $p) {
                $prime[$i] = false;
            }
        }
    }
    $primeNumbers = [];
    for ($p = 2; $p <= $n; $p++) {
        if ($prime[$p]) {
            $primeNumbers[] = $p;
        }
    }
    return $primeNumbers;
}

function mandelbrotSet($width, $height, $maxIter = 100) {
    $image = [];
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $i = mandelbrot($x / $width * 3.5 - 2.5, $y / $height * 2 - 1, $maxIter);
            $image[$y][$x] = $i;
        }
    }
    return $image;
}

function mandelbrot($cr, $ci, $maxIter) {
    $i = 0;
    $zr = 0;
    $zi = 0;
    while ($i < $maxIter && $zr * $zr + $zi * $zi < 4) {
        $temp = $zr * $zr - $zi * $zi + $cr;
        $zi = 2 * $zr * $zi + $ci;
        $zr = $temp;
        $i++;
    }
    return $i;
}

function quicksort($arr) {
    if (count($arr) < 2) {
        return $arr;
    }
    $left = $right = array();
    reset($arr);
    $pivot_key = key($arr);
    $pivot = array_shift($arr);
    foreach ($arr as $k => $v) {
        if ($v < $pivot)
            $left[$k] = $v;
        else
            $right[$k] = $v;
    }
    return array_merge(quicksort($left), array($pivot_key => $pivot), quicksort($right));
}

function fibonacci($n) {
    if ($n <= 1) {
        return $n;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}

// Benchmark
$startTime = microtime(true);

// Sieve of Eratosthenes
sieveOfEratosthenes(100000);

$endTime = microtime(true);
$executionTime = $endTime - $startTime;
// Imprimir el tiempo de ejecución
echo "Tiempo total de ejecución de sieveOfEratosthenes: " . number_format($executionTime, 4) . " segundos\n";

$startTime = microtime(true);
// Mandelbrot Set
mandelbrotSet(800, 600, 50);
$endTime = microtime(true);
$executionTime = $endTime - $startTime;
echo "Tiempo total de ejecución de mandelbrotSet: " . number_format($executionTime, 4) . " segundos\n";

$startTime = microtime(true);
// Quicksort
$randomArray = array_map(function() { return rand(1, 10000); }, range(1, 10000));
quicksort($randomArray);

$endTime = microtime(true);
$executionTime = $endTime - $startTime;
echo "Tiempo total de ejecución de quicksort: " . number_format($executionTime, 4) . " segundos\n";

$startTime = microtime(true);
// Fibonacci
fibonacci(40);

$endTime = microtime(true);
$executionTime = $endTime - $startTime;
echo "Tiempo total de ejecución de fibonacci: " . number_format($executionTime, 4) . " segundos\n";