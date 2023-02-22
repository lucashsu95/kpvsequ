<?php
include('../link.php');
$sql = $db->prepare('insert into genrepair(class,genrepair_name,genrepair_place,situation,genrepair_date,processing) values(:class,:genrepair_name,:genrepair_place,:situation,:genrepair_date,:processing)');
$sql->bindValue('class',$_POST['class']);
$sql->bindValue('genrepair_name',$_POST['genrepair_name']);
$sql->bindValue('genrepair_place',$_POST['genrepair_place']);
$sql->bindValue('situation',$_POST['situation']);
$sql->bindValue('genrepair_date',$date);
$sql->bindValue('processing','未處理');
$sql->execute();
echo '<script>alert("報修成功"),location.href="../index.php"</script>';