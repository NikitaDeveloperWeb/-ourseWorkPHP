<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel='stylesheet' href='../styles.css'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | редактировать таксиста</title>
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

     $id = intval(str_replace('http://taxi/DELETE/TaxmanDelete.php?id=','',$url));

     $queryTaxman = $mysqli->query("SELECT * FROM `Taxman` WHERE ID_TAXMAN=$id");
     $fullname_p;
    
     
     while ($dataTaxman = mysqli_fetch_array($queryTaxman)) {
       $fullname_p =  strval($dataTaxman['Fullname']);
      
      } 

     if ($_POST['delete']) {
      $query = "DELETE from `Taxman` WHERE ID_TAXMAN=$id";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        echo '<p>Данные успешно удалены в таблице.</p>';
        echo '<a href="../taxmans.php">К таксистам</a>';
        mysqli_close($mysqli);
        exit;
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };
       ?> 
    <form action="" method="post">
    <h2>Вы уверены что хотите удалить таксиста - <?= $fullname_p ?></h2>
      <input type="submit" value="Да" name="delete">
      <a href="../taxmans.php"><input type="button" value="Нет"></a>
    </form>
  
  </div>
</body>
</html>