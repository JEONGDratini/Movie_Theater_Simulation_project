<?php

	include('dbcon.php');
	
?>



<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <title>서비스 화면(메인화면)</title>
  </head>
  <body><form class=loginForm>
	  <div class="idform"><input type="button" value="티켓 구매하기" class = "btn" onclick="location.href='Buy_ticket.php'"/></div>
	  <div class="passform"><input type="button" value="개봉 영화 조회" class = "btn" onclick="location.href='Movie_information.php'"/></div>
	  <div><input type="button" value="예약 내역 조회" class = "btn" onclick="location.href='ticket_information.php'"/></div>
  </div>
              <?php if (isset($_SESSION['user_id'])) { //로그인이 되어있다면?>
                id : <?php echo $_SESSION['user_id']; ?> 로 로그인 하셨습니다.
                <input type="button" value="Log Out" text-align:center onclick="location.href='logout.php'"/>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
             <?php } ?>
  

  <?php if (isset($_SESSION['user_id'])) {  ?>
      <?php if ($_SESSION['is_admin'] == 1) { 
				  echo("<script>location.href='admin.php';</script>"); ?>
	   <?php } ?>
  <?php } else {?>
    <li>로그인이 되어있지 않습니다. <tr>
                        <td><?php echo $username;  ?></td>
                        <td><?php echo $userprofile; ?></td>
                        <td>
                        <?php
                        if($activate)
                        {
                                echo "활성";
                        } else{
                            echo "비활성";
                        }
                        ?>
                        </td>
                        <td><a class="btn btn-primary" href="editform.php?edit_id=<?php echo $username ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a></td>
                        <td><a class="btn btn-warning" href="delete.php?del_id=<?php echo $username ?>" onclick="return confirm('<?php echo $username ?> 사용자를 삭제할까요?')">
                        <span class="glyphicon glyphicon-remove"></span>Del</a></td>
                        </tr>
서비스에 제한을 받을 수 있습니다.</li>
  <?php } ?>
    </form>
  </body>
</html>
