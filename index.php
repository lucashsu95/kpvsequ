<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>設備維修填報系統</title>
    <link rel="shortcut icon" href="img/LOGO.jpg" type="image/x-icon">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="container">
    <div>請選擇您想報修的項目。</div>
    <div>
      <a href='repair/addrepair.php'>
        教學設備報修系統
      </a>
      　（設備組）　
      <a href='repair/repairlist.php'>
        檢視已報修的記錄
      </a>
    </div>        
    <div>
      <a href='genrepair/addgenrepair.php'>
        校園設備報修系統
      </a>
        　（總務處）　
        <a href='genrepair/genrepairlist.php'>
          檢視已報修的記錄
        </a>
      </div>
  </div>
  <?php include('footer.php'); ?>
</body>
</html>