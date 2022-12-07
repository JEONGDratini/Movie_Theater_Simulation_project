<html>
<body>
<div class="usrlist">
        <div class="page-header">
	<h1 class="h2">&nbsp; 현재 상영영화 목록</h1><hr>


<table width="300"  border="0" cellpadding="0" cellspacing="0">




    </div>

<?php
        include('dbcon.php');


        
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
    
    
?>

        
        <input type="button" value="영화 정보수정" onclick="location.href='Update_Movie.php'"/>
<?php
        oci_free_statement($stid);
        oci_close($connect);
?>

</table>

</body>
</html>