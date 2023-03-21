<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error){
    die("Connection failed: " . $connect->connect_error);
}

//ЗАПРОС 1
$sql ="CREATE TABLE sportsmen (
      PRIMARY KEY (id),
      id INT NOT NULL AUTO_INCREMENT,
      full_name VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL,
      phone VARCHAR(12) NOT NULL CHECK (phone LIKE '+7%'),
      date_of_birth DATE NOT NULL,
      age INT NOT NULL,
      creation_date DATETIME NOT NULL,
      passport_number VARCHAR(20) NOT NULL,
      average_place INT NOT NULL,
      biography TEXT NOT NULL,
      video_presentation VARCHAR(255) NOT NULL
    );
    ";

if ($connect->query($sql) === TRUE){
    echo "Таблица спрортсменов создана!<br>";
}
else{
    echo("Ошибка!<br>");
}

//ЗАПРОС 2
$sql ="INSERT INTO sportsmen (full_name, email, phone, date_of_birth, age, creation_date, passport_number, average_place, biography, video_presentation)
    VALUES
    ('Иванов Иван', 'johndoe@example.com', '+71234567890', '1990-01-01', 31, NOW(), 'AB1234567', 3, 'lived like a hero and died like a hero', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'),
    ('Сидоров Андрей', 'janesmith@example.com', '+71234567891', '1995-04-15', 26, NOW(), 'CD2345678', 2, 'Actually Im white and fluffy. Only fur on the inside.', 'https://www.youtube.com/watch?v=DLzxrzFCyOs'),
    ('Петров Петр', 'mikejohnson@example.com', '+71234567892', '1988-11-23', 33, NOW(), 'EF3456789', 1, 'Im sick of portals!', 'https://www.youtube.com/watch?v=djV11Xbc914');
    ";

if ($connect->query($sql) === TRUE){
  echo "Тестовые данные введены!<br>";
}
else{
  echo("Ошибка!<br>");
}

//ЗАПРОС 3
$sql ="SELECT full_name, average_place
        FROM sportsmen
        ORDER BY average_place ASC
        LIMIT 5;";

$result = $connect->query($sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        echo "<br> ФИО: " . $row["full_name"] . "<br> Среднее место: " .  $row["average_place"];
    }
}

$connect->close();
?>