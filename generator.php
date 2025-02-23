<?php
error_reporting(1);
$alphabet = ['А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д',

                            'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и',
                    
                            'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н',
                    
                            'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т',
                    
                            'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч',
                    
                            'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь',
                    
                            'Э', 'э', 'Ю', 'ю', 'Я', 'я'];
if($_POST['numbers'] < 3) {
    $response = ['error' => "Минимальное количество букв в логине - 3."];
}
elseif(!isset($_POST['letters']) and  $_POST['numbers'] >= 3){
    $allNumbers = $_POST['numbers'];
    $randomElems = array_rand(array_flip($alphabet), $allNumbers);
    $strNew;
    foreach($randomElems as $value){
        $strNew.=$value;
}

$response = ['generatedlogin' => "$strNew"];

}
else {
    $str = $_POST['letters'];
    $allNumbers = $_POST['numbers'];
    $number = count($str);
    $strNew = implode($str);
    $addAlpha = $allNumbers - $number;
    $randomElems = array_rand(array_flip($alphabet), $addAlpha);

    foreach($randomElems as $value){
        $strNew.=$value;
}

$response = ['generatedlogin' => "$strNew"];
}                           


   
header('Conten-Type: application/json');
    echo json_encode($response);                       
?>