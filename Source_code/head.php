<?php
if(!session_id()) {
    session_start();//세션이 시작 안돼있다면 세션시작.
}
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; 
    charset=UTF-8" />
<title>로그인 예제</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
			<ul class="nav navbar-nav">
            <li class="active"><a href="main.php">메인</a></li>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="">Signed in as <?php echo $_SESSION['user_id']; ?></a></li>
                <li><a href="logout.php">Log Out</a></li>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
             <?php } ?>
			</ul>
        </div>
    </div>
</nav>








