<?php
$totCount = count($_POST['choice']);
$curTHE = $_POST['THE'];
include ('dbcon.php');


//THEATER TABLE 수정
$sql_2 = "UPDATE THEATER SET TOT_SEAT = TOT_SEAT - $totCount WHERE THEATER_NUM = '$curTHE' ";

$stmt_THE = oci_parse($connect, $sql_2);
oci_execute($stmt_THE);

oci_free_statement($stmt_THE);

/*
//조회
$sql_2 = "SELECT * FROM THEATER";

$stmt_THE = oci_parse($connect, $sql_2);
oci_execute($stmt_THE);

echo "<table width='300' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt_THE ,OCI_ASSOC+OCI_RETURN_NULLS)){

        echo"<tr>\n";
        foreach($row as $item){

                echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
        }
        echo "</tr>\n";
}
echo "</table>\n";
 

oci_free_statement($stmt_THE);
 */


//SEAT TABLE 수정 
foreach($_POST['choice'] as $SeatNum){
	$sql = "INSERT INTO SEAT(THEATER_NUM, SEAT_NUM, RESERVE_TF ) VALUES ('$curTHE' ,'$SeatNum', 1 )";
	$stid = oci_parse($connect,$sql);
	
	oci_execute($stid);
}

/////조회
/*
$sql_1 = "SELECT * FROM SEAT";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);

echo "<table width='300' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

	echo"<tr>\n";
	foreach($row as $item){
	
		echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";

oci_free_statement($stmt);

 */


//SCHEDULE_NUM 가져오기
$sql_1 = "SELECT SCHEDULE_NUM  FROM SCHEDULE WHERE THEATER_NUM = '$curTHE'";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);
$row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS);

$row_SCHEDULE_NUM =  (int)$row['SCHEDULE_NUM'];

oci_free_statement($stmt);

oci_close($connect);

include('dbcon.php');

//TICKET TABLE 수정

foreach($_POST['choice'] as $SeatNum){

	$tck = $curTHE.$SeatNum;

	$sql = "INSERT INTO TICKET(TICKET_NUM, SCHEDULE_NUM, THEATER_NUM, SEAT_NUM, PRICE)
		VALUES ('$tck', $row_SCHEDULE_NUM  , '$curTHE', '$SeatNum', 8000)";

	$stid = oci_parse($connect,$sql);

        oci_execute($stid);

}

/*
/////조회

$sql_1 = "SELECT * FROM TICKET";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);
echo "<table width='300' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

        echo"<tr>\n";
        foreach($row as $item){

                echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
        }
        echo "</tr>\n";
}
echo "</table>\n";

oci_free_statement($stmt);

 */
//////////////////////////////

//RESERVATION TABLE 수정

$tck = [$totCount];
$i=0;

foreach($_POST['choice'] as $SeatNum){

	$sql_search_ticket_num = "SELECT TICKET_NUM from ticket WHERE SEAT_NUM = '$SeatNum'";

	$stid = oci_parse($connect,$sql_search_ticket_num);

	oci_execute($stid);

	$row = oci_fetch_array($stid);

	$tck[$i] = $row['TICKET_NUM'];

	$i++;
}
$i = 0;
// INSERT INTO RESERVATION VALUES ('ticket1_id','ticket2_id','ticket3_id')

//sequence part
$sql_get_seq = "SELECT R_SEQ.NEXTVAL FROM DUAL";

$stid = oci_parse($connect, $sql_get_seq);

oci_execute($stid);

$row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS);

$RESERVE_NUM = $row['NEXTVAL'];
oci_free_statement($stid);

//insert part
if($tck[0] != NULL){
		
	$sql_reserve = "INSERT INTO RESERVATION(RESERVATION_NUM, TICKET1_ID) VALUES('R$RESERVE_NUM' ,'$tck[0]' ) ";
		
	$stid_reserve = oci_parse($connect,$sql_reserve);

        oci_execute($stid_reserve);

	if($tck[1] != NULL) { 
		$sql_reserve_up1 = "UPDATE RESERVATION SET TICKET2_ID = '$tck[1]' WHERE RESERVATION_NUM = 'R$RESERVE_NUM' ";
		
		$stid_reserve = oci_parse($connect,$sql_reserve_up1 );
		
		oci_execute($stid_reserve);

		if($tck[2] != NULL){
			$sql_reserve_up2 = "UPDATE RESERVATION SET TICKET3_ID = '$tck[2]' WHERE RESERVATION_NUM = 'R$RESERVE_NUM'";
			$stid_reserve = oci_parse($connect,$sql_reserve_up2);
			oci_execute($stid_reserve);
		}
	}
}

/*
//RESERVATION TABLE 조회
$sql_1 = "SELECT * FROM RESERVATION";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);
echo "<table width='300' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

        echo"<tr>\n";
        foreach($row as $item){

                echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
        }
        echo "</tr>\n";
}
echo "</table>\n";

oci_free_statement($stmt);

 */
///////////////////////////////////////

//PAY TABLE 수정
//PAY_NUM
$PAY_NUM = 'P'.$RESERVE_NUM;
//TOT_PRICE
$TOT_PRICE = $totCount * 8000;
//PAY_DATE
$sql_get_pay_date = "SELECT SCHEDULE_DATE  FROM schedule WHERE THEATER_NUM = '$curTHE' ";

$stid = oci_parse($connect, $sql_get_pay_date);

oci_execute($stid);

$row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS);

$PAY_DATE = $row['SCHEDULE_DATE'];

oci_free_statement($stid);

//CUS_ID
$USER_ID = $_SESSION['user_id'];

//RESERVATION_NUM
$RES_NUM = 'R'.$RESERVE_NUM;

////////////////////////////
//사전준비끝 위에값 insert//
////////////////////////////
$sql = "INSERT INTO PAY(PAY_NUM, TOT_PRICE, PAY_DATE, CUS_ID, RESERVATION_NUM)
                VALUES ('$PAY_NUM', $TOT_PRICE, '$PAY_DATE', '$USER_ID', '$RES_NUM')";

$stid = oci_parse($connect,$sql);

oci_execute($stid);

oci_free_statement($stid);

/*
//PAY TABLE 조회
$sql_1 = "SELECT * FROM PAY";

$stmt = oci_parse($connect, $sql_1);
oci_execute($stmt);
echo "<table width='300' border='1' cellpadding='0' cellspacing='0'>\n";

while($row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

        echo"<tr>\n";
        foreach($row as $item){

                echo "<td>".($item != NULL ? htmlentities($item,ENT_QUOTES):"&nbsp")."</td>\n";
        }
        echo "</tr>\n";
}
echo "</table>\n";

oci_free_statement($stmt);
/////////////////////////////////////////////////////////////////////////
//
 */

oci_close($connect);

?>
<script> alert("구매완료 \n 메인페이지로 돌아갑니다... " ); 

location.href='main.php'
 </script>
