<?php

function generateLogin(){
    $vowels = 'aeiou';
    $consonants = 'bcdfghjklmnpqrstvwxzy';
    $strNew = '';

    if($_POST['numbers'] < 3) {
        $response = ['error' => "Минимальное количество букв в логине - 3."];
    }
    elseif(!isset($_POST['letters']) and  $_POST['numbers'] >= 3){
        $allNumbers = $_POST['numbers'];
        //$strNew = $_POST['letters'];
        for($i = 0; $i <= $allNumbers; $i++){
            if($i % 2 == 0){
                $strNew.= $vowels[mt_rand(0, strlen($vowels)-1)];
            } else {
                $strNew.= $consonants[mt_rand(0, strlen($consonants)-1)];
            }
        }
    
        $response = ['generatedlogin' => "$strNew"];
    }
    else {
        $str = $_POST['letters'];
        $allNumbers = $_POST['numbers'];
        $number = count($str);
        $strNew = implode($str);
        $addAlpha = $allNumbers - $number;

        for($i = 0; $i <= $addAlpha; $i++){
            if($i % 2 == 0){
                $strNew.= $vowels[mt_rand(0, strlen($vowels)-1)];
            } else {
                $strNew.= $consonants[mt_rand(0, strlen($consonants)-1)];
            }
        }

        $response = ['generatedlogin' => "$strNew"];
    }   
       
    header('Conten-Type: application/json');
    echo json_encode($response);
}

generateLogin();


?>