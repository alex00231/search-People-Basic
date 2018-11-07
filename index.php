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

$inputSearch = $_REQUEST['search'];

$sql = "SELECT * FROM `users_main` WHERE `name` = '$inputSearch' || `surname` = '$inputSearch' || `email` = '$inputSearch' || `number_phone` = '$inputSearch' || `city` = '$inputSearch' || `year_of_birth` = '$inputSearch'";

$result = $mysqli -> query($sql);

function doesItExist(array $arr) {
    $data = array(
        'email' => $arr['email'] != false ? $arr['email'] : 'Нет данных',
        'city' => $arr['city'] != false ? $arr['city'] : 'Нет данных',
        'year' => $arr['year_of_birth'] != false ? $arr['year_of_birth'] : 'Нет данных'
    );
    return $data;
}

function countPeople($result) {
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()) {
            $arr = doesItExist($row);
            echo "ID: ". $row['id'] ."<br>
                  Имя: ". $row['name'] ."<br>
                  Фамилия: ". $row['surname'] ."<br>
                  Телефон: ". $row['number_phone'] ."<br>
                  Email: ". $arr['email'] ."<br>
                  Город: ". $arr['city'] ."<br>
                  Год рождения: ". $arr['year'] ."<hr>";
        }
    } else {
        echo "Не кто не найден";
    }
}
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
        <p>Поиск Человека: <input type="text" name="search" id=""> <input type="submit" value="Поиск"></p>
        <hr>
    </form>
    <?php
    countPeople($result);
    ?>
</body>
</html>