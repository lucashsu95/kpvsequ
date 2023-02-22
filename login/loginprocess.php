<?php
include('../link.php');
$sql = $db->prepare('select * from users where account=:account and password=:password');
$sql->bindValue('account', $_POST['account']);
$sql->bindValue('password', $_POST['password']);
$sql->execute();
$query = $sql->fetch();
if($query){
    if($query['role'] === '設備組'){
        $_SESSION['user'] = 'repair';
        header('location:../repair/repairlist.php');
    }elseif($query['role'] === '總務處'){
        $_SESSION['user'] = 'genrepair';
        header('location:../genrepair/genrepairlist.php');
    }
}else{
    echo '<script>alert("帳密錯誤"),location.href="login.html"</script>';
};