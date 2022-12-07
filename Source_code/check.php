<?php
//check.php 미완성 파일입니다. 안쓸 수도 있어용


    error_reporting(E_ALL); 
    ini_set('display_errors',1); 
//로그인 여부 체크를 시행합니다.
function is_login(){

    global $connect;

    if (isset($_SESSION['userid']) && !empty($_SESSION['userid']) ){

        $stmt = oci_parse($connect,"select CUS_ID from customer where username='$userid'");
        
        oci_execute($stmt);
        $count = $stmt->rowcount();

        if ($count == 1){
       
            return true; //로그인 상태
        }else{
            //사용자 테이블에 없는 사람일때
            return false;
        }
    }else{

        return false; //로그인 안된 상태
    }
	
	oci_free_statement($stid);
	oci_close($connect);
}

?>


