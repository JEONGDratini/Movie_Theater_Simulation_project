<?php
    include('dbcon.php')
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; 
    charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="./main.css">
<title>관리자 화면</title>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
			<ul class="nav navbar-nav">
	    <?php if (isset($_SESSION['user_id'])) ?>
                <li><a href="">Signed in as <?php echo $_SESSION['user_id']; ?></a></li>
		<li><a href="logout.php">Log Out</a></li>
		<div class="floating">
			<form class=adminForm method="post">
				<div class="adminmenu"><input type="submit" class="btn" name="admin_user" id="admin_user" value="회원가입된 유저현황" /></div>
				<div class="adminmenu"><input type="submit" class="btn" name="admin_theater" id="admin_theater" value="상영관별 좌석예매현황" /></div>
				<div class="adminmenu"><input type="submit" class="btn" name="admin_movie" id="admin_movie" value="상영영화현황" /></div>
				<div class="adminmenu"><input type="submit" class="btn" name="admin_reservation" id="admin_reservation" value="예매현황" /><br/></div>
			 </form>
</div>
		</ul>
        </div>
    </div>
</nav>
</body>
</html>
<?php

function admin_user() { include('admin_user.php'); }
                if(array_key_exists('admin_user',$_POST)){ admin_user(); 
		}


function admin_theater() { include('admin_theater.php'); }
if(array_key_exists('admin_theater',$_POST)){ admin_theater();
}
function admin_reservation() { include('admin_reservation.php'); }
                if(array_key_exists('admin_reservation',$_POST)){ admin_reservation();
		}

function admin_movie() { include('admin_movie.php'); }
if(array_key_exists('admin_movie',$_POST)){ admin_movie();
}

?>

