<?php
include ('dbcon.php');
?>

<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <title>예약 정보조회 화면</title>
  </head>
  <body>
  <div class="usrlist">  
  <?php if (isset($_SESSION['user_id'])) { ?>
                <li>id : <?php echo $_SESSION['user_id']; ?> 로 로그인 하셨습니다.</a></li>
                <input type="button" value="Log Out" onclick="location.href='logout.php'"/>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
             <?php } ?>
	<input type="button" value="메인화면으로 돌아가기" onclick="location.href='main.php'"/>
    </form>
    <div>
  </body>
</html>

<?php
  
  

  $user_id = $_SESSION['user_id'];
  $sql = "Select * from MOVIE";//"SELECT 'Reserved Movie : ', MOVIE_TITLE FROM MOVIE where MOVIE_NUM IN (
  //           Select MOVIE_NUM from schedule where THEATER_NUM IN (
  //             Select THEATER_NUM from ticket where TICKET1_ID IN(
  //                Select TICKET1_ID from RESERVATION where Exists(
  //                  Select * from Pay where Pay.RESERVATION_NUM = RESERVATION.RESERVATION_NUM and Pay.CUS_ID = '$user_id'))))";
		
	 $stid = oci_parse($connect,$sql);

	 oci_execute($stid);//쿼리 실행하고



$sql_1 = "SELECT  'Reservation Number : ',RESERVATION_NUM, 'Reserved Seat : ', TICKET1_ID, TICKET2_ID, TICKET3_ID  FROM RESERVATION where Exists(Select * from Pay where Pay.RESERVATION_NUM = RESERVATION.RESERVATION_NUM and Pay.CUS_ID = '$user_id')";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);
echo "<table width='500' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

        echo"<tr>\n";
        foreach($row as $item){

                echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
        }
        echo "</tr>\n";
}
echo "<br>";
echo "<br>";

  oci_free_statement($stid);
  oci_close($connect);

  $sql_1 = "SELECT 'Pay Number :', PAY_NUM,'Reservation Number :', RESERVATION_NUM,'TOTAL_PRICE :', TOT_PRICE,
                'DATE :',PAY_DATE,'user :',CUS_ID  FROM PAY where CUS_ID='$user_id'";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);
echo "<table width='750' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

        echo"<tr>\n";
        foreach($row as $item){

                echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
        }
        
        echo "</tr>\n";
}
echo "</table>\n";

?>
<input type="button" value="예약정보 삭제" onclick="location.href='delete_user.php?CUS_ID=<?php echo $_SESSION['user_id']; ?>'"/>
<?php

oci_free_statement($stmt);
oci_close($connect);
?>