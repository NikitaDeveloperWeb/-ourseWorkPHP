<?php

$TaxmanName = $_POST['taxmanName'];
$Taxman_P = $TaxmanName;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel='stylesheet' href='../styles.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | таксисты</title>
</head>
<body>
  
<header>
  <nav>
  <h2>Меню</h2>
  <hr>
  <a href="../index.php"><h2>Операторы</h2></a>
    <a href="../taxmans.php"><h2>Таксисты</h2></a>
    <a href="../orders.php"><h2>Заказы</h2></a>
    <a href="../clients.php"><h2>Клиенты</h2></a>
  </nav>
</header>
   <div class="content">
    <h1>Система учета таксопарка</h1>
    <h2>Таксисты</h2>
    <hr/>
    <form name="search" method="post" action="SearchTaxmans.php">
      <h3>Найти таксиста:</h3>
      <input type="search" name="taxmanName" placeholder="Поиск">
      <button type="submit">Найти</button> 
    </form>
    <table border="1px" cellspacing="2px" cellpadding="3px">
      <caption><h2>Таблица таксистов:</h2></caption>
      <tr>
        <th>Имя</th>
        <th>Водительское удостоверение</th>
        <th>ИНН</th>
        <th>Телефон</th>
        <th>Дата рождения</th>
        <th>Адрес</th>
        <th>Марка машины</th>
        <th>Гос. номер машины</th>
        <th>Действия</th>
      </tr>
    
     <?
     require_once('../DB.php');
     echo $TaxmanName;
     $query = "SELECT * FROM `Taxman` WHERE Fullname='$Taxman_P'";
     $taxman = $mysqli->query($query);
     $data;
     while($data = mysqli_fetch_array($taxman)){
       #Taxman
      $id_Taxman = $data['ID_TAXMAN'];
      $queryCar = $mysqli->query("SELECT * FROM `Car` WHERE ID_TAXMAN=$id_Taxman");
      $CarModel;
      $CarNumber;
      $idCarTax;
      $carID;
      while ($dataCar = mysqli_fetch_array($queryCar)) {
        $idCarTax = $dataCar['ID_TAXMAN'];
        $carID = $dataCar['ID_CAR'];
        if($id_Taxman == $dataCar['ID_TAXMAN']){
          $CarModel = $dataCar['Model'];
        }else {
          $CarModel = "не добавленно";
        }
        if($id_Taxman == $dataCar['ID_TAXMAN']){
          $CarNumber = $dataCar['Number'];
        }else {
          $CarNumber = "не добавленно";
        }
       
       } 
       ?>
       <tr>

        <td><?= $data['Fullname']?></td>
        <td><?= $data['Driver']?></td>
        <td><?= $data['INN']?></td>
        <td><?= $data['Phone']?></td>
        <td><?= $data['Date']?></td>
        <td><?= $data['adress']?></td>
        <td><?= $data['ID_TAXMAN'] ==  $idCarTax ? $CarModel:'Не добавлено'; ?></td>
        <td><?= $data['ID_TAXMAN'] ==  $idCarTax ? $CarNumber:'Не добавлено'; ?></td>
        <td>
          <a href="../SORTING/OrdersComplite.php?id=<?php echo $data['ID_TAXMAN'];?>">Выполненные заказы</a><br/><hr/>
          <a href="../ADD/CarAdd.php?id=<?php echo $data['ID_TAXMAN'];?>">Добавить автомобиль таксиста...</a><br/><hr/>
          <a href="../UPDATE/CarUpdate.php?id=<?php echo $data['ID_TAXMAN'] ==  $idCarTax ? $carID:'Не добавлено';?>">Редактировать автомобиль таксиста..</a><br/><hr/>
          <a href="../DELETE/CarDelete.php?id=<?php echo $data['ID_TAXMAN'] ==  $idCarTax ? $carID:'Не добавлено';?>">Удалить автомобиль таксиста...</a><br/><hr/>
          <a href="../UPDATE/TaxmanUpdate.php?id=<?php echo $data['ID_TAXMAN'];?>">Редактировать</a><br/><hr/>
          <a href="../DELETE/TaxmanDelete.php?id=<?php echo $data['ID_TAXMAN'];?>">Удалить</a>
        </td>

    </tr> 
     
     <?
     }
     mysqli_close($mysqli);
     ?>
    </table>
    <a href="../ADD/TaxmanAdd.php"><h3>Добавить нового таксиста...</h3></a>
   
   

  </div>
</body>
</html>