<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$BDname = "users_search_db";

$mysqli = new mysqli($servername, $username, $password, $BDname);

if ($mysqli->connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
}

// echo "Всё подключилось <br>";
if (isset($_REQUEST['doGo'])) {
    $IfEmail = $_REQUEST['email'] != "" ? ", email" : "";
    $IfCity = $_REQUEST['city'] != "" ? ", city" : "";
    $IfYear = $_REQUEST['year_of_birth'] != "" ? ", year_of_birth" : "";

    $nameInput = $_REQUEST['name'] != "" ? $_REQUEST['name'] : false;
    $surnameInput = $_REQUEST['surname'] != "" ? $_REQUEST['surname'] : false;
    $numphoneInput = $_REQUEST['numPhone'] != "" ? $_REQUEST['numPhone'] : false;
    $yearInput = $_REQUEST['year_of_birth'] != "" ? ", '".$_REQUEST['year_of_birth']."'" : "";
    $emailInput = $_REQUEST['email'] != "" ? ", '".$_REQUEST['email']."'" : "";
    $cityInput = $_REQUEST['city'] != "" ? ", '".$_REQUEST['city']."'" : "";

    if ($nameInput != false && $surnameInput != false && $numphoneInput != false) {
        $sql = "INSERT INTO users_main (name, surname, number_phone $IfEmail $IfCity $IfYear) VALUES ('$nameInput', '$surnameInput', '$numphoneInput' $emailInput $cityInput $yearInput)";
        if ($mysqli -> query($sql) === true) {
            echo "Человек записан в базу данных";
        } else {
            echo "Человек не записан в базу данных";
        }
    } else {
        echo "Человек не записан в базу данных";
    }
    $_REQUEST['doGo'] = false;
}



// echo "<br>".$sql;

// $sql = "SELECT * FROM `users_main`";
// $result = $mysqli -> query($sql);

// if ($result -> num_rows > 0) {
//     while ($row = $result -> fetch_assoc()) {
//         echo "<br> name: ". $row["name"] ."<br> surname: ". $row["surname"];
//     }
// }
// if ($mysqli -> query($sql) === true) {
//     echo "Запись создана";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php include_once "./header.php"; ?>
    <form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
        <p>Имя: <input type="text" name="name" id=""> <samp style="color:red">*</samp></p>
        <p>Фамилия: <input type="text" name="surname" id=""><samp style="color:red">*</samp></p>
        <p>Номер телефона: <input type="text" name="numPhone" id=""><samp style="color:red">*</samp></p>
        <p>EMail: <input type="email" name="email" id=""></p>
        <p>Город: <input type="text" name="city" id=""></p>
        <?php $year = date('Y'); ?>
        <select name="year_of_birth" id="">
        <option value="">----</option>
            <?php for ($i = $year - 14; $i > $year - 14 - 100; $i--) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
        </select>
        <p><input type="submit" value="Отправить данные" name="doGo"></p>
        <?php
        if (!$nameInput) echo "Вы не ввели имя <br>";
        if (!$surnameInput) echo "Вы не ввели фамилию <br>";
        if (!$numphoneInput) echo "Вы не ввели номер телефона <br>";
        ?>
    </form>
</body>
</html>



