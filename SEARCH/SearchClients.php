<?php

$ClientName = $_POST['clientName'];
$Client_P = $ClientName;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel='stylesheet' href='../styles.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | клиенты</title>
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
    <h2>Клиенты</h2>
    <hr/>
    <form name="search" method="post" action="SearchClients.php">
      <h3>Найти клиента:</h3>
      <input type="search" name="clientName" placeholder="Поиск">
      <button type="submit">Найти</button> 
    </form>
    <table border="1px" cellspacing="2px" cellpadding="3px">
      <caption><h2>Таблица клиентов:</h2></caption>
      <tr>
        <th>Имя</th>
        <th>Телефон</th>
        <th>Действия</th>
      </tr>
    
     <?
     require_once('../DB.php');
     $query = "SELECT * FROM Client WHERE Fullname='$Client_P'";
     $clients = $mysqli->query($query);
     $data;
     
     while($data = mysqli_fetch_array($clients)){
       
       ?>
       <tr>
        <td><?= $data['Fullname']?></td>
        <td><?= $data['Phone']?></td>
        <td>
          <a href="../UPDATE/ClientUpdate.php?id=<?= $data['ID_CLIENT'] ?>">Редактировать</a>
          <a href="../DELETE/ClientDelete.php?id=<?= $data['ID_CLIENT'] ?>">Удалить</a>
        </td>
    </tr> 

     <?
     }
     mysqli_close($mysqli);
     ?>
      

    </table>
    <a href="../ADD/ClientAdd.php"><h3>Добавить нового клиента...</h3></a>
  </div>
</body>
</html>