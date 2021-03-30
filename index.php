<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php
    include('styles.php');
  ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | операторы</title>
</head>
<body>
  <?php
    include('navigation.php');
  ?>
  <div class="content">
    <h1>Система учета таксопарка</h1>
    <h2>Операторы</h2>
    <hr/>
    <form name="search" method="post" action="SEARCH/SearchOperators.php">
      <h3>Найти оператора:</h3>
      <input type="search" name="OperatorName" placeholder="Поиск">
      <button type="submit">Найти</button> 
    </form>
    <table border="1px" cellspacing="2px" cellpadding="3px">
      <caption><h2>Таблица операторов:</h2></caption>
      <tr>
        <th>Имя</th>
        <th>Паспорт</th>
        <th>ИНН</th>
        <th>Телефон</th>
        <th>Дата рождения</th>
        <th>Адрес</th>
        <th>Действия</th>
      </tr>
    
     <?
     require_once('DB.php');
     $query = "SELECT * FROM `dispetcher`";
     $operators = $mysqli->query($query);
     $data;
     while($data = mysqli_fetch_array($operators)){
       ?>
       <tr>

        <td><?= $data['Fullname']?></td>
        <td><?= $data['Passport']?></td>
        <td><?= $data['INN']?></td>
        <td><?= $data['Phone']?></td>
        <td><?= $data['Date']?></td>
        <td><?= $data['Adress']?></td>
        <td>
          <a href="UPDATE/OperatorUpdate.php?id=<?php echo $data['ID_Dispetcher'];?>">Редактировать</a>
          <a href="DELETE/OperatorDelete.php?id=<?php echo $data['ID_Dispetcher'];?>">Удалить</a>
        </td>

    </tr> 

     <?
     }
     mysqli_close($mysqli);
     ?>
      

    </table>
    <a href="ADD/OperatorAdd.php"><h3>Добавить нового оператора...</h3></a>
  </div>
</body>
</html>