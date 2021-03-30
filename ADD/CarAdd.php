<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel='stylesheet' href='../styles.css'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | добавить автомобиль</title>
</head>
<body>
 
  <div class="form">
    <h1>Система учета таксопарка</h1>
    <hr/>
    <?
     require_once('../DB.php');
     $url = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://';
     $url = $url . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
     define('URL', $url);

     $id = intval(str_replace('http://taxi/ADD/CarAdd.php?id=','',$url));
     $queryTaxman = $mysqli->query("SELECT * FROM `Taxman` WHERE ID_TAXMAN=$id");
     $idTax;
     $fullnameTaxman;
     while ($dataTaxman = mysqli_fetch_array($queryTaxman)) {
      $idTax =  strval($dataTaxman['ID_TAXMAN']);
      $fullnameTaxman = $dataTaxman['Fullname'];
     } 
    

     if (isset($_POST["d_model"])) {
      $model = strval($_POST['d_model']);
      $number = strval($_POST['d_number']);
      $taxman = strval($_POST['d_taxman']);
      $taxQuery = $mysqli->query("SELECT * FROM `Taxman` WHERE Fullname='$taxman'");
      $ID_TAXMAN = intval($idTax);
      // while ($dataTax = mysqli_fetch_array($taxQuery)) {
      //   $ID_TAXMAN = intval($dataTax['ID_TAXMAN']);
      // }
     
     
      $query = "INSERT INTO `Car` (`ID_TAXMAN`, `Model`, `Number`) VALUES ('$ID_TAXMAN','$model','$number')";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        echo '<p>Данные успешно добавлены в таблицу.</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };
     
       ?>
       <h2>Таксист - <?= $fullnameTaxman ?></h2>
    <form action="" method="post">
    <h2>Добавить автомобиль таксиста</h2>
      <label for="d_model">Модель:</label>
      <input type="text" name="d_model">

      <label for="d_number">Номер:</label>
      <input type="text" name="d_number">
    
     
  

      <input type="submit" value="Добавить">
    </form>
    <a href="../taxmans.php"><h3>Назад</h3></a>
  </div>
</body>
</html>