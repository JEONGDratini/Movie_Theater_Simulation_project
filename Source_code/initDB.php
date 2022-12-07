<?php

include ('dbcon.php');

$sql_del = "DELETE FROM seat WHERE RESERVE_TF = 1";

$stid_del = oci_parse($connect, $sql_del);

oci_execute($stid_del);

oci_free_statement($stid_del);

$sql_upA = "UPDATE THEATER SET TOT_SEAT = 30 WHERE THEATER_NUM = 'A'";

$stid_up = oci_parse($connect, $sql_upA);

oci_execute($stid_up);

$sql_upB = "UPDATE THEATER SET TOT_SEAT = 30 WHERE THEATER_NUM = 'B'";

$stid_up = oci_parse($connect, $sql_upB);

oci_execute($stid_up);

$sql_upC = "UPDATE THEATER SET TOT_SEAT = 30 WHERE THEATER_NUM = 'C'";

$stid_up = oci_parse($connect, $sql_upC);

oci_execute($stid_up);
oci_free_statement($stid_up);


$sql_del_tck = "DELETE FROM ticket WHERE PRICE = 8000";

$stid = oci_parse($connect, $sql_del_tck);


oci_execute($stid);
oci_free_statement($stid);


$sql_del_res = "DELETE FROM reservation WHERE RESERVATION_NUM IS NOT NULL ";

$stid = oci_parse($connect, $sql_del_res);

oci_execute($stid);
oci_free_statement($stid);

//시퀀스 초기화

$sql_get_seq = "SELECT R_SEQ.NEXTVAL FROM DUAL";

$stid = oci_parse($connect, $sql_get_seq);

oci_execute($stid);

$row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS);

echo "R_SEQ is ";

$val = -1 *  $row['NEXTVAL'];

echo $row['NEXTVAL']; 
echo "\n";
oci_free_statement($stid);
//-NEXTVAL 값 만들어서 증가시키면 0 그후 increment 1로 변경
$sql_zero_seq = "ALTER SEQUENCE R_SEQ INCREMENT BY $val";

$stid = oci_parse($connect, $sql_zero_seq);

oci_execute($stid);

oci_free_statement($stid);
//part 2
$sql_get_seq = "SELECT R_SEQ.NEXTVAL FROM DUAL";

$stid = oci_parse($connect, $sql_get_seq);

oci_execute($stid);

$row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS);

oci_free_statement($stid);

//part 3
$sql_zero_seq = "ALTER SEQUENCE R_SEQ INCREMENT BY 1";

$stid = oci_parse($connect, $sql_zero_seq);

oci_execute($stid);

oci_free_statement($stid);


//currval 값 확인
$sql_get_seq = "SELECT R_SEQ.CURRVAL FROM DUAL";

$stid = oci_parse($connect, $sql_get_seq);

oci_execute($stid);

$row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS);

echo "R_SEQ is ";
echo $row['CURRVAL'];
echo "\n";
oci_free_statement($stid);






echo "<script>\n";

echo "alert('DB REFRESH COMPLETE')";

echo "</script>\n";

oci_close($connect);









