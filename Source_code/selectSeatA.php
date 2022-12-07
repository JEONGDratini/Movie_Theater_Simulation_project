<?php
$tckoption = isset($_POST['ticketOption']) ? $_POST['ticketOption'] : false;
$theoption = isset($_POST['theaterOption']) ? $_POST['theaterOption'] : false;

if ($tckoption !=""  && $theoption !="" ) {
   }
   else {
	   echo "<script> alert('티켓매수와 상영관을 선택해주세요! ') \n";
	   echo "location.href='Buy_ticket.php'\n";
	   echo "</script>";
	   exit;
   }


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./screen.css">
<div class="container">
</head>
<body class = "screenback">
	<font color="white"><h1 class="h2">&nbsp; <?php echo $theoption; ?>  상영관</h1><hr></font>
	<font size="5em" color="white"><?php echo $tckoption ; ?>개의 좌석을 선택해주세요.  </font>
        <div class="sreen">
        <div style="text-align:center;"><img src="./img/screen.png"></div>
    <form name="form1" id="id1" action="selectSeat_DB.php "  method="post">
        <table width="360" height="300" border ="1" align="center">
           <tr>
                <td align="center"><b>A</td>
		<td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="A1" value="A1"><label for="A1"></label></td>
		<td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="A2" value="A2"><label for="A2"></label></td>
		<td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="A3" value="A3"><label for="A3"></label></td>
		<td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="A4" value="A4"><label for="A4"></label></td>
		<td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="A5" value="A5"><label for="A5"></label></td>
		<td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="A6" value="A6"><label for="A6"></label></td>
	   </tr>
           <tr>
                <td align="center"><b>B</td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="B1" value="B1"><label for="B1"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="B2" value="B2"><label for="B2"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="B3" value="B3"><label for="B3"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="B4" value="B4"><label for="B4"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="B5" value="B5"><label for="B5"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="B6" value="B6"><label for="B6"></label></td>
            </tr>
		<tr>
                <td align="center"><b>C</td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="C1" value="C1"><label for="C1"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="C2" value="C2"><label for="C2"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="C3" value="C3"><label for="C3"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="C4" value="C4"><label for="C4"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="C5" value="C5"><label for="C5"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="C6" value="C6"><label for="C6"></label></td>
            </tr>
		<tr>
                <td align="center"><b>D</td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="D1" value="D1"><label for="D1"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="D2" value="D2"><label for="D2"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="D3" value="D3"><label for="D3"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="D4" value="D4"><label for="D4"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="D5" value="D5"><label for="D5"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="D6" value="D6"><label for="D6"></label></td>
           </tr>
		<tr>
                <td align="center"><b>E</td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="E1" value="E1"><label for="E1"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="E2" value="E2"><label for="E2"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="E3" value="E3"><label for="E3"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="E4" value="E4"><label for="E4"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="E5" value="E5"><label for="E5"></label></td>
                <td align="center" ><input onclick="CountChecked(this)" type="checkbox" name="choice[]" id ="E6" value="E6"><label for="E6"></label></td>
	    </tr>
	</table>
	<table align="right">
                <tr>
                        <td><input type="hidden"  value=<?php echo $theoption; ?> name="THE" /></td>
	                <td><input type="button"  id = "goback" class="btn" style="width:60pt;height:30pt;" value="뒤로가기" onclick="location.href='Buy_ticket.php'" /></td>
	                <td><input type="submit"  id = "select" class="btn" style="width:60pt;height:30pt;"  value="확정" /></td>
                </tr>
        </table>
        
</form>
</body> 
<script type="text/javascript">// 카운트 최대값은 2
var maxCount = "<?php echo (int)$tckoption;  ?>";
var count = 0;                                                                  // 카운트, 0으로 초기화 설정
function CountChecked(field){
	
        if (field.checked) {                                            // 만약 field의 속성이 checked 라면(사용자가 클릭해서 체크상태가 된다면)
		count += 1;
	// count 1 증가
        }
        else {                                                                          
                count -= 1;                                                             
        }
	
	if (count > maxCount ) {                                         
		alert("최대 <?php echo $tckoption  ; ?>개까지만 선택가능합니다!");        
        field.checked = false;                                          
        count -= 1;                                                                 
}
	
}
</script>
</html>

