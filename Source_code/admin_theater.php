<html>
<body>
<div class="usrlist">
        <div class="page-header">
        <h1 class="h2">&nbsp; 상영관별 좌석 예매현황</h1><hr>
    </div>
<table width="640"  border="1" cellpadding="0" cellspacing="0" >
<thead border="none">  
        <tr>
            <th width="100" >아이디</th>
            <th width="100" >예약번호</th>
            <th width="80" >티켓번호1</th>
            <th width="80" >티켓번호2</th>
            <th width="80" >티켓번호3</th>
            <th width="100" >좌석번호</th>
            <th width="100" >상영관</th>
        </tr>
</thead>


<?php
        include('dbcon.php');



	$sql = "SELECT distinct  PAY.CUS_ID, PAY.RESERVATION_NUM, TICKET1_ID, TICKET2_ID, TICKET3_ID, ticket.SEAT_NUM, ticket.THEATER_NUM
		FROM pay, reservation, ticket, seat
		WHERE PAY.RESERVATION_NUM = RESERVATION.RESERVATION_NUM and
		(TICKET1_ID = TICKET_NUM or  TICKET2_ID = TICKET_NUM or TICKET3_ID = TICKET_NUM)  order by PAY.RESERVATION_NUM";
        $stid = oci_parse($connect, $sql);

        oci_execute($stid);
        while($row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS)){

                echo "<tr>\n";
                foreach($row as $item){
                        echo " <td width = '100'>".($item !=NULL ? htmlentities($item,ENT_QUOTES) : "&nbsp;")."</td>\n";
                }
                echo "</tr>\n";
        }
?>

</table>

<table  width="200"  border="0" cellpadding="0" cellspacing="0" >
<thead>
        <tr>
            <th width="100" > 상영관번호 </th>
            <th width="100" >총좌석수</th>
        </tr>
</thead>
<table  width="200"  border="1" cellpadding="0" cellspacing="0" >

<?php
        include('dbcon.php');

        $sql = "SELECT *  FROM theater";

        $stid = oci_parse($connect, $sql);

        oci_execute($stid);
        while($row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS)){

                echo "<tr>\n";
                foreach($row as $item){
                        echo " <td width = '100'>".($item !=NULL ? htmlentities($item,ENT_QUOTES) : "&nbsp;")."</td>\n";
                }
                echo "</tr>\n";
	}

	oci_free_statement($stid);
?>

</table>


</body>
</html>
