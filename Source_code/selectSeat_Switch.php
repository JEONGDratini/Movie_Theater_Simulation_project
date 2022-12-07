<?php
$tckoption = isset($_POST['ticketOption']) ? $_POST['ticketOption'] : false;
$theoption = isset($_POST['theaterOption']) ? $_POST['theaterOption'] : false;

if ($tckoption!=""  && $theoption !="" ) {
}
   else {
           echo "<script> alert('티켓매수와 상영관을 선택해주세요! ') \n";
           echo "location.href='Buy_ticket.php'\n";
           echo "</script>";
           exit;
   }


if($_POST['theaterOption'] == "A"){

	include "selectSeatA.php";
}
else if($_POST['theaterOption'] == "B"){

	include "selectSeatB.php";
}

else{


	include "selectSeatC.php";

}


?>
