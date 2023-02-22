<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>穀保-校園設備維修填報系統</title>
    <link rel="shortcut icon" href="../img/LOGO.jpg" type="image/x-icon">
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <?php include('../back.php') ?>
  <form action="addgenrepairprocess.php" method="post" class="repair">
    <div class='main'>
      <div>
        <div>損壞設備</div>
        <div>填報人</div>
        <div>教室編號<br>(損壞地點)</div>
        <div>狀況概述</div>
      </div>
      <div>
        <div><input type="text" name="class" id="class" placeholder='例如：黑板、桌子、窗戶…'></div>
        <div><input type="text" name="genrepair_name" placeholder='請輸入性名' maxlength='15' required ></div>
        <div><input type="text" name="genrepair_place" placeholder='例如：231教室、電3.....' maxlength='15' required ></div>
        <div><textarea name="situation" placeholder='狀況概述' required ></textarea></div>
      </div>
    </div>
    <div class='control-box'>
      <input type="submit" value="送出申請" class='btn'>
      <input type="reset" value="重填" class='btn'>
    </div>
  </form>

  <?php include('../footer.php'); ?>
</body>
</html>