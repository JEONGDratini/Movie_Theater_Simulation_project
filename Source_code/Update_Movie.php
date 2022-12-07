<?php
include('dbcon.php');
?>


<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <title>영화 정보 수정</title>
  </head>
  <body>
    <form action ="Movie_Update_Execute.php" method="post">	
      <div class="usrlist">
        <div class="page-header">
        <h1 class="h2">&nbsp; 영화 정보 수정</h1><hr>
    </div>
      수정할 영화 번호 : <input type="number" name="Update_Movie_number"/></br>
      수정할 영화 제목 : <input type="text" name="Update_Movie_name"/></br>
    <input type="button" value="뒤로가기" onclick="location.href='admin.php'"/>
    <input type="submit" value="수정" onclick="location.href='Movie_Update_Execute.php'"/>
    </form>
  </body>
</html>

