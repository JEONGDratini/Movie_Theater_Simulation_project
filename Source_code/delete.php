<?php

include('dbcon.php');

$id = $_GET['CUS_ID'];
//상영관번호 가져오기

$sql = "SELECT ticket.THEATER_NUM  FROM customer, pay, reservation, ticket, seat
        WHERE customer.CUS_ID = '$id' and customer.CUS_ID = pay.CUS_ID and pay.RESERVATION_NUM = reservation.RESERVATION_NUM
        and (TICKET1_ID = TICKET_NUM or TICKET2_ID = TICKET_NUM or TICKET3_ID = TICKET_NUM)
        and  ticket.SEAT_NUM = seat.SEAT_NUM ";

$stmt = oci_parse($connect, $sql);

oci_execute($stmt);

$row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS);

$R = 0;
foreach($row as $a)
{ $R = $a;  }

//좌석수 가져오기
$sql = "SELECT count(seat.SEAT_NUM) FROM customer, pay, reservation, ticket, seat
        WHERE customer.CUS_ID = '$id' and customer.CUS_ID = pay.CUS_ID and pay.RESERVATION_NUM = reservation.RESERVATION_NUM
        and (TICKET1_ID = TICKET_NUM or TICKET2_ID = TICKET_NUM or TICKET3_ID = TICKET_NUM)
        and  ticket.SEAT_NUM = seat.SEAT_NUM ";

$stmt = oci_parse($connect, $sql);

oci_execute($stmt);

$row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS);
$SN = 0;
foreach($row as $b)
{$SN = $b ;}



//좌석 가져오기
$sql = "SELECT seat.SEAT_NUM FROM customer, pay, reservation, ticket, seat
	WHERE customer.CUS_ID = '$id' and customer.CUS_ID = pay.CUS_ID and pay.RESERVATION_NUM = reservation.RESERVATION_NUM
	and (TICKET1_ID = TICKET_NUM or TICKET2_ID = TICKET_NUM or TICKET3_ID = TICKET_NUM)
	and  ticket.SEAT_NUM = seat.SEAT_NUM ";

$stmt = oci_parse($connect, $sql);

oci_execute($stmt);
$list_data = array();
while( $row = oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)){

foreach($row as $item)
{ if($item != NULL){
	array_push($list_data, $item);
		}
	}	
}

//////////SEAT 테이블 삭제 쿼리
foreach($list_data as $a)
{

$sql_del = "DELETE FROM SEAT WHERE SEAT_NUM = '$a' and THEATER_NUM = '$R' ";

$stmt = oci_parse($connect, $sql_del);

oci_execute($stmt);

}
//////////THEATER TABLE 업데이트 쿼리
$sql_up = "UPDATE THEATER SET TOT_SEAT = TOT_SEAT + $SN WHERE THEATER_NUM = '$R'";

$stmt = oci_parse($connect, $sql_up);

oci_execute($stmt);


//////////////////////////////////////////$R = 영화관 넘버 $SN = 좌석수 $ $list_data = 좌석넘버배열
//
//
//
//
// CUSTOMER 까지 지웁니다.
//
$sql_del_customer = "DELETE FROM customer where CUS_ID = '$id'";

$stmt = oci_parse($connect, $sql_del_customer);

oci_execute($stmt);

if(oci_execute($stmt))
{

oci_free_statement($stmt);
        oci_close($connect);



    header("location:admin.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}

?>







