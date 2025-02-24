<?php
function generateLogin() {

    $vowels = 'aeiou';

    $consonants = 'bcdfghjklmnpqrstvwxzy';

    $strNew = '';


    // Проверяем, сколько букв должно быть в логине

    if ($_POST['numbers'] < 3) {

        $response = ['error' => "Минимальное количество букв в логине - 3."];

        //echo json_encode($response);

        //return;

    }


    $allNumbers = $_POST['numbers'];

    $letters = isset($_POST['letters']) ? str_split($_POST['letters']) : [];


    // Проверяем первый символ и начинаем генерировать логин

    if (empty($letters)) {

        // Если не переданы буквы, генерируем случайный логин

        $firstIsVowel = mt_rand(0, 1); // случайно выбираем, будет ли первый символ гласным


        for ($i = 0; $i < $allNumbers; $i++) {

            if ($firstIsVowel) {

                $strNew .= $vowels[mt_rand(0, strlen($vowels) - 1)];

            } else {

                $strNew .= $consonants[mt_rand(0, strlen($consonants) - 1)];

            }

            $firstIsVowel = !$firstIsVowel; // меняем состояние

        }

    } else {

        // Используем переданные буквы для создания логина

        $firstCharacter = array_shift($letters); // Сохраняем первый символ и удаляем его из массива

        $strNew .= $firstCharacter; // Начинаем с первого символа

        $currentIsVowel = in_array($firstCharacter, str_split($vowels));


        for ($i = 1; $i < $allNumbers; $i++) {

            if ($currentIsVowel) {

                // Следующий символ должен быть согласным

                $nextChar = '';

                if (!empty($letters) && count(array_intersect($letters, str_split($vowels))) > 0) {

                    foreach ($letters as $key => $letter) {

                        if (in_array($letter, str_split($vowels))) {

                            $nextChar = $letter; // берем первую подходящую гласную

                            unset($letters[$key]); // удаляем букву из массива

                            break;

                        }

                    }

                }

                if (empty($nextChar)) {

                    $nextChar = $consonants[mt_rand(0, strlen($consonants) - 1)];

                }

                $strNew .= $nextChar;

                $currentIsVowel = false; // теперь ожидаем гласный

            } else {

                // Следующий символ должен быть гласным

                $nextChar = '';

                if (!empty($letters) && count(array_intersect($letters, str_split($consonants))) > 0) {

                    foreach ($letters as $key => $letter) {

                        if (in_array($letter, str_split($consonants))) {

                            $nextChar = $letter; // берем первую подходящую согласную

                            unset($letters[$key]); // удаляем букву из массива

                            break;

                        }

                    }

                }

                if (empty($nextChar)) {

                    $nextChar = $vowels[mt_rand(0, strlen($vowels) - 1)];

                }

                $strNew .= $nextChar;

                $currentIsVowel = true; // теперь ожидаем согласный

            }

        }

    }

    
    $response = ['generatedlogin' => "$strNew"];

    header('Content-Type: application/json');

    echo json_encode($response);

}


generateLogin();


// function generateLogin(){

//     $vowels = 'aeiou';

//     $consonants = 'bcdfghjklmnpqrstvwxzy';

//     $strNew = '';


//     // Проверяем, сколько букв должно быть в логине

//     if($_POST['numbers'] < 3) {

//         $response = ['error' => "Минимальное количество букв в логине - 3."];

//         echo json_encode($response);

//         return;

//     }


//     $allNumbers = $_POST['numbers'];

//     $letters = isset($_POST['letters']) ? $_POST['letters'] : [];


//     if (empty($letters)) {

//         // Если не переданы буквы, просто генерируем случайный логин

//         for($i = 0; $i < $allNumbers; $i++) {

//             if($i % 2 == 0) {

//                 $strNew .= $vowels[mt_rand(0, strlen($vowels) - 1)];

//             } else {

//                 $strNew .= $consonants[mt_rand(0, strlen($consonants) - 1)];

//             }

//         }

//     } else {

//         // Используем переданные буквы для создания логина

//         $firstCharacter = array_shift($letters); // Сохраняем первый символ и удаляем его из массива


//         // Если первый символ - гласный, следующий должен быть согласным и наоборот.

//         $strNew .= $firstCharacter; // Начинаем с первого символа

//         $currentIsVowel = in_array($firstCharacter, str_split($vowels));


//         for ($i = 1; $i < $allNumbers; $i++) {

//             if ($currentIsVowel) {

//                 // Если текущий символ гласный, добавляем согласный

//                 $nextChar = mt_rand(0, 1) ? array_shift($letters) : $consonants[mt_rand(0, strlen($consonants) - 1)];

//                 if (empty($nextChar)) {

//                     $nextChar = $consonants[mt_rand(0, strlen($consonants) - 1)];

//                 }

//                 $strNew .= $nextChar;

//                 $currentIsVowel = false; // Меняем состояние, ожидаем гласный

//             } else {

//                 // Если текущий символ согласный, добавляем гласный

//                 $nextChar = mt_rand(0, 1) ? array_shift($letters) : $vowels[mt_rand(0, strlen($vowels) - 1)];

//                 if (empty($nextChar)) {

//                     $nextChar = $vowels[mt_rand(0, strlen($vowels) - 1)];

//                 }

//                 $strNew .= $nextChar;

//                 $currentIsVowel = true; // Меняем состояние, ожидаем согласный

//             }

//         }

//     }

    

//     $response = ['generatedlogin' => $strNew];

//     header('Content-Type: application/json');

//     echo json_encode($response);

// }


// generateLogin();



// function generateLogin(){
//     $vowels = 'aeiou';
//     $consonants = 'bcdfghjklmnpqrstvwxzy';
//     $strNew = '';

//     if($_POST['numbers'] < 3) {
//         $response = ['error' => "Минимальное количество букв в логине - 3."];
//     }
//     elseif(!isset($_POST['letters']) and  $_POST['numbers'] >= 3){
//         $allNumbers = $_POST['numbers'];
//         //$strNew = $_POST['letters'];
//         for($i = 0; $i <= $allNumbers; $i++){
//             if($i % 2 == 0){
//                 $strNew.= $vowels[mt_rand(0, strlen($vowels)-1)];
//             } else {
//                 $strNew.= $consonants[mt_rand(0, strlen($consonants)-1)];
//             }
//         }
    
//         $response = ['generatedlogin' => "$strNew"];
//     }
//     else {
//         $str = $_POST['letters'];
//         $allNumbers = $_POST['numbers'];
//         $number = count($str);
//         $strNew = implode($str);
//         $addAlpha = $allNumbers - $number;

//         for($i = 0; $i <= $addAlpha; $i++){
//             if($i % 2 == 0){
//                 $strNew.= $vowels[mt_rand(0, strlen($vowels)-1)];
//             } else {
//                 $strNew.= $consonants[mt_rand(0, strlen($consonants)-1)];
//             }
//         }

//         $response = ['generatedlogin' => "$strNew"];
//     }   
       
//     header('Conten-Type: application/json');
//     echo json_encode($response);
// }

// generateLogin();


?>