<html>
<body>
<div class="usrlist">
        <div class="page-header">
	<h1 class="h2">&nbsp; 사용자 목록</h1><hr>
<form action="" method="post">
<table width="650"  border="1" cellpadding="0" cellspacing="0">
<thead border="none">  
        <tr>
            <th width="100" >아이디</th>
            <th width="100" >비밀번호</th>
            <th width="100" >이름</th>
            <th width="100" >전화번호</th>
            <th width="150" >성별(M : 1, F : 0)</th>
            <th width="100" >삭제</th>
        </tr>
</thead>
</div>
<tbody>
<?php
        include('dbcon.php');

        $sql = "SELECT CUS_ID , CUS_PW, CUS_NAME, CUS_TEL, SEX   FROM customer WHERE CUS_ID != 'admin' ORDER BY CUS_ID ";

        $stid = oci_parse($connect, $sql);

	oci_execute($stid);
	echo "<tr>\n";
	while($row = oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS)){
                foreach($row as $item){
			echo " <td width = '100'>".($item !=NULL ? htmlentities($item,ENT_QUOTES) : "&nbsp;")."</td>\n";
	}
?>	
	<td><a href="delete.php?CUS_ID=<?php echo $row['CUS_ID'];?> ">Delete</a></td>
<?php
	echo"</tr>";
	}
	oci_free_statement($stid);
	oci_close($connect);
?>
</tbody>
</table>
</form>
</body>
</html>

