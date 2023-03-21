<?php
// Исходные данные
$array = array(22, 45, 22, 34, 234, 234, 657, 2, 22, 0, 2); 
$a = 11111111; 

//перебор массива
$lenght = count($array);
for ($i = 0; $i < $lenght; $i++){
    //проверяю наличие 2ки в текущем элементе массива
    if (strrpos($array[$i], "2") !== false) {
        //увеличиваю длину массива
        $lenght++;
        //от последнего элемента до текущего перемещаю значения массива 
        for ($move = $lenght - 1; $move > $i; $move--){
                $array[$move] = $array[$move-1];
        }        
        $i++;
        $array[$i] = $a;
    }
}

//вывод
echo '<pre>';
print_r($array);
echo '</pre>';
?> 
