<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Генератор логинов">
        <title>Генератор логинов</title>
        <link rel="stylesheet" href="./style.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <img src="logo.png" alt="Генератор логинов" width="150" height="150">
            </header>
            <div id="content">
                <h1>Генератор логинов</h1>
                <form action="generator.php" method="POST" class="form" id="myForm">
                    <div class="numbers">
                        <label name="numbers">
                        Выберете количество букв в логине.
                        </label>
                        
                        <select name="numbers" id="numbers">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </select>
                        <span id="error"></span>
                    </div>
                    <div class="letters">
                        <label name="letters">
                        Выберете буквы, которые должны присутствовать в названии логина.
                        </label>
                        <select multiple name="letters[]" id="letters"> 
                            <?php
                            $alphabet = ['А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д',

                            'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и',
                    
                            'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н',
                    
                            'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т',
                    
                            'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч',
                    
                            'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь',
                    
                            'Э', 'э', 'Ю', 'ю', 'Я', 'я'];

                            foreach($alphabet as $elem){
                                echo "<option value=\"$elem\">$elem</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="submit" value="Сгенерировать логин">
                </form>
                <div id="login">
                    <p></p>
                </div>
            </div>
            <div id="footer">
                <span>Гребенёк Татьяна © 2025</span>
            </div>
        </div>
        <script>
            document.getElementById('myForm').addEventListener('submit', function(event){
                event.preventDefault();//Предотвратить обычную отправку формы
                
                const formData = new FormData(this);//Создаем объект FormData
                const login = document.querySelector('#login p');

                fetch('generator.php', {//Отправляем данные на сервер
                    method:'POST',
                    body:formData,
                })
                .then(response => response.json())//Обрабатываем ответ в формате JSON
                .then(data=>{
                    if(data.error){
                        document.querySelector('#error').textContent = `${data.error}`;
                        console.log(data); //Выводим результат в консоль
                    } else {
                        document.querySelector('#error').textContent = ` `;
                        const lettersString = data.generatedlogin;//Преобразуем массив букв в строку
                        login.textContent = `Ваш новый логин: ${lettersString}`;
                        console.log(data); //Выводим результат в консоль
                    }
                    
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });

            });


            // const formData = new FormData();
            // const numbers = document.querySelector('#numbers');
            // const letters = document.querySelector('#letters');
            
            // formData.append("numbers", numbers);
            // formData.append("letters", letters);

            // try{
            //     const response = await fetch('/generator.php', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: formData,
            // });
            // const result = await response.json();
            // console.log(JSON.stringify(result)); 
            // }catch (error) {
            //     console.error("Ошибка:", error);
            // }

            
        </script>        
    </body>
</html>