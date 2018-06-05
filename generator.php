<?php
error_reporting(E_ALL);
ini_set('memory_limit', '4096M');
require_once("dico.php");

function mb_str_split($string, $split_length = 1)
{
    if ($split_length == 1) {
        return preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY);
    } elseif ($split_length > 1) {
        $return_value = [];
        $string_length = mb_strlen($string, "UTF-8");
        for ($i = 0; $i < $string_length; $i += $split_length) {
            $return_value[] = mb_substr($string, $i, $split_length, "UTF-8");
        }
        return $return_value;
    } else {
        return false;
    }
}

function transforme($mot) {
    $caracteres = mb_str_split($mot);
    $resultat = "";
    foreach ($caracteres as $lettre) {
        if ($lettre ==='a' || $lettre == "à" || $lettre === 'â' || $lettre === 'ä' || $lettre === 'b' || $lettre === 'c' || $lettre === 'ç') {
                $resultat .= "2";
            }
            if ($lettre ==='d' || $lettre === 'e' || $lettre === 'é' || $lettre === 'è' || $lettre === 'ê' || $lettre === 'ë' || $lettre === 'f') {
                $resultat .= "3";
            }
            if ($lettre ==='g' || $lettre === 'h' || $lettre === 'i' || $lettre === 'ï' || $lettre === 'î') {
                $resultat .= "4";
            }
            if ($lettre ==='j' || $lettre === 'k' || $lettre === 'l') {
                $resultat .= "5";
            }
            if ($lettre ==='m' || $lettre === 'n' || $lettre === 'o' || $lettre === 'ö' || $lettre === 'ô') {
                $resultat .= "6";
            }
            if ($lettre ==='p' || $lettre === 'q' || $lettre === 'r' || $lettre === 's') {
                $resultat .= "7";
            }
            if ($lettre ==='t' || $lettre === 'u' || $lettre === 'û' || $lettre === 'ü' || $lettre === 'v') {
                $resultat .= "8";
            }
            if ($lettre ==='w' || $lettre === 'x' || $lettre === 'y' || $lettre === 'ÿ' || $lettre === 'z') {
                $resultat .= "9";
            }
    }
    return $resultat;
}

function init_t9($dico) {
    $dico_t9 = [];
    foreach ($dico as $mot) {
        $index = transforme($mot);
        if(isset($dico_t9[$index])) {
            $dico_t9[$index][] = $mot;
        } else {
            $dico_t9[$index] = [$mot];
        }
    }
    return $dico_t9;
}

$dico_t9 = init_t9($dico);
foreach ($dico_t9 as $key => $values) {
    echo "\"$key\" => [";
    foreach ($values as $mot) {
        echo "\"$mot\",";
    }
    echo "],\n";
}