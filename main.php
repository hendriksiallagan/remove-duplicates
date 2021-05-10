<?php

function removeDuplicates($data)
{
    $chars = 0;
    $after = [];

    for ($i = strlen($data) - 1; $i >= 0; $i--) {
        $ch = ord($data[$i]) - 97;
        $chars = $chars | (1 << $ch);
        $after[$i] = $chars;
    }

    $result = "";

    $start = 0;
    $pos = 0;

    while ($chars) {
        for ($i = 0; $i <26; $i++) {
            if($chars & (1 << $i)) {
                $pos = strpos($data, chr(97 + $i), $start);
                if ($chars == ($chars & $after[$pos])) {
                    $result = $result . chr(97 + $i);
                    $chars = $chars - (1 << $i);
                    break;
                }
            }
        }
        $start = $pos + 1;
    }

    return $result;
}


$openFile = fopen('data.txt', 'r');

$readFile = fread($openFile, filesize('data.txt'));

print_r(removeDuplicates($readFile));