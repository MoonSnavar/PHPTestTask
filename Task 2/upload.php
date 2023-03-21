<?php
if(isset($_POST['submit'])) {
  $file = $_FILES['file']['tmp_name'];
  $name = $_FILES['file']['name'];
  $ext = pathinfo($name, PATHINFO_EXTENSION);
  if($ext === 'csv') {
    // Открываем загруженный CSV-файл в режиме только для чтения
    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
    // Парсим (разбираем) данные из файла CSV построчно
    while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
    {
        //Перебираю все строки
        for($i = 0; $i < count($getData); $i++)
        {
            //разделяю строку
            $row = explode(';', $getData[$i]);
            
            $newFile = fopen("upload/" . $row[0], "w");
            //меняю кодировку строки
            $content = iconv('windows-1251', 'utf-8', $row[1]);
            fwrite($newFile, $content);
            fclose($newFile);
        }
    }

    // Закрываем открытый CSV-файл
    fclose($csvFile);
    echo "Файл успешно загружен!";
  } else {
    echo "Загружать можно только CSV файлы!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Upload CSV file</title>
</head>
<body>
  <h1>Upload CSV file</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file" accept=".csv">
    <br><br>
    <input type="submit" name="submit" value="Upload">
  </form>
</body>
</html>
