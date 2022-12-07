<?php

	include('dbcon.php');
	
?>


<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <title>영화 정보조회 화면</title>
  </head>
  <body>
  <div class = "usrlist">
    <?php if (isset($_SESSION['user_id'])) { ?>
                <li>id : <?php echo $_SESSION['user_id']; ?> 로 로그인 하셨습니다.</a></li>
                <input type="button" value="Log Out" onclick="location.href='logout.php'"/>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
             <?php } ?>
	<input type="button" value="티켓 구매하기" onclick="location.href='Buy_ticket.php'"/>
	<input type="button" value="메인화면으로 돌아가기" onclick="location.href='main.php'"/>
	<?php if (isset($_SESSION['has_ticket'])) { ?> //has_ticket 세션에 값이 세팅 되어있을 때만 티켓의 정보를 조회할 수 있도록 한다.
				<li><a href="">Signed in as <?php echo $_SESSION['user_id']; ?></a></li>
                <input type="button" value="티켓 정보 조회" onclick="location.href='Ticket_information.php'"/>
	<?php } ?>
    </form>
<?php
  
  include ('dbcon.php');
  $sql = "SELECT 'TITLE :', MOVIE_TITLE, 'DATE :', SCHEDULE_DATE, 'THEATER NUMBER :', THEATER_NUM FROM MOVIE join SCHEDULE on MOVIE.MOVIE_NUM = SCHEDULE.MOVIE_NUM";
		
	$stid = oci_parse($connect,$sql);

	oci_execute($stid);//쿼리 실행하고

  echo"<table width='600' border='1' cellpadding='5' cellspacing='0'>\n";//영화 정보 table출력 설정

  while ($row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS))    {//남은 줄이 있을 동안 작동
      echo "<tr>\n";
      foreach($row as $item) {//출력된 각 줄마다 내용에 대해서
          echo " <td>" .($item !== NULL ? htmlentities($item,ENT_QUOTES) : "&nbsp;") ."</td>\n";//td로 출력하기
      }
       echo "</tr>\n";
  }

  echo "</table>\n";


  oci_free_statement($stid);
  oci_close($connect);
?>
</div>
</body>
</html>