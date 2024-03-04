<?php
ini_set('memory_limit', '2048M'); // increasing memory limit for php...

$filePath = '/Users/jlc0m/Development/10m.txt'; // absolute path to the file...

$numbers = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// $numbers = [1,6,7,89,34,2,4,0,9];
// $numbers = ['23','1','2'];
// $numbers = [];

if (!$numbers) {
    echo "Empty file!";
    return;
}

if (ctype_digit(implode('', $numbers))) {
    echo "This file is not an integer!";
    return;
} else {
    $arr = array_map('intval', $numbers);
}

if (is_array($numbers)) {

    sort($arr);

    $n = count($arr);

    $minNumber = min($arr);
    $maxNumber = max($arr);
    $mediana = median($arr);
    $average = average($arr);

    echo "MAX: $maxNumber" . PHP_EOL;
    echo "MIN: $minNumber" . PHP_EOL;
    echo "MEDIANA: $mediana" . PHP_EOL;
    echo "AVARAGE: $average" . PHP_EOL;
    echo "The largest sequence of numbers that increases:\n" . implode("\n", sequenceIncrease($arr, $n)) . PHP_EOL;
    echo "The largest decreasing sequence of numbers:\n" . implode("\n", sequenceDecreasing($arr, $n)) . PHP_EOL;
}

function median(array $arr): int
{
     $totalArrElems = count($arr);

     $middleIndex = $totalArrElems / 2;
     if ($totalArrElems % 2 !== 0) {
         return $arr[floor($middleIndex)];
     }
     return intval(($arr[$middleIndex - 1] + $arr[$middleIndex]) / 2);
}

function average(array $arr): int
{
    $average = array_sum($arr) / count($arr);
    
    return intval($average);
}

function sequenceIncrease(array $arr, $n): array
{
    $S = [];
    for ($i = 0; $i < $n; $i++)
        $S[$arr[$i]] = true;

    $maxSeq = [];

    for ($i = 0; $i < $n; $i++) {
        if (!isset($S[$arr[$i] - 1])) {
            $j = $arr[$i];
            $currentSeq = [];

            while (isset($S[$j])) {
                $currentSeq[] = $j;
                $j++;
            }

            if (count($currentSeq) > count($maxSeq)) {
                $maxSeq = $currentSeq;
            }
        }
    }
    return $maxSeq;
}

function sequenceDecreasing(array $arr, $n): array {
    $S = [];
    for ($i = 0; $i < $n; $i++)
        $S[$arr[$i]] = true;

    $maxSeq = [];

    for ($i = $n - 1; $i >= 0; $i--) {
        if (!isset($S[$arr[$i] + 1])) {
            $j = $arr[$i];
            $currentSeq = [];

            while (isset($S[$j])) {
                $currentSeq[] = $j;
                $j--;
            }

            if (count($currentSeq) > count($maxSeq)) {
                $maxSeq = $currentSeq;
            }
        }
    }
    return $maxSeq;
}