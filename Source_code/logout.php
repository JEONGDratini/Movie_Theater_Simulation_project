<?php
if(!session_id()) {
    session_start();//세션이 시작 안돼있다면 세션시작.
}

    include('dbcon.php');    
    include('check.php');

    if (isset($_SESSION['user_id'])){//세션에 뭐가 있다면

        unset($_SESSION['user_id']);//세션 초기화시키고
        unset($_SESSION['is_admin']);
        session_destroy();//때려부순다.
    }

    header("Location: login.php");
?>

