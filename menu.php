<?php
function generateLogin(){

    $vowels = 'aeiou';

    $consonants = 'bcdfghjklmnpqrstvwxzy';

    $strNew = ''; 

    $allNumbers = $_POST['numbers'];

    $letters = isset($_POST['letters']) ? $_POST['letters'] : [];


    if (empty($letters)) {

        // Если не переданы буквы, просто генерируем случайный логин

        for($i = 0; $i < $allNumbers; $i++) {

            if($i % 2 == 0) {

                $strNew .= $vowels[mt_rand(0, strlen($vowels) - 1)];

            } else {

                $strNew .= $consonants[mt_rand(0, strlen($consonants) - 1)];

            }

        }

    } else {

        // Используем переданные буквы для создания логина

        $firstCharacter = substr($letters, 0, 1); // Получаем первый символ из строки

        // Если первый символ - гласный, следующий должен быть согласным и наоборот.

        $strNew .= $firstCharacter; // Начинаем с первого символа

        $currentIsVowel = in_array($firstCharacter, str_split($vowels));


        for ($i = 1; $i < $allNumbers; $i++) {

            if ($currentIsVowel) {

                // Если текущий символ гласный, добавляем согласный

                $nextChar = $consonants[mt_rand(0, strlen($consonants) - 1)];

                $strNew .= $nextChar;

                $currentIsVowel = false; // Меняем состояние, ожидаем гласный
               
            } else {

                 // Если текущий символ согласный, добавляем гласный

                 $nextChar = $vowels[mt_rand(0, strlen($vowels) - 1)];

                 $strNew .= $nextChar;
 
                 $currentIsVowel = true; // Меняем состояние, ожидаем согласный             

            }

        }

    }
    
    $strNew = ucfirst($strNew);

    $response = ['generatedlogin' => $strNew];

    header('Content-Type: application/json');

    echo json_encode($response);

}


generateLogin();

?>