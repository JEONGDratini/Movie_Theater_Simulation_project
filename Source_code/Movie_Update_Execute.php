<?php
include('dbcon.php');

if(isset($_POST['Update_Movie_number']) && isset($_POST['Update_Movie_name'])){
    $Update_Movie_number=$_POST['Update_Movie_number'];
    $Update_Movie_name=$_POST['Update_Movie_name'];
    $Movie_Num = $_SESSION['movie_num'];

    if($Update_Movie_number > 0 && $Update_Movie_number < 4){
        if (isset($_SESSION['is_admin']) && isset($Update_Movie_name)){//어드민이고 movienum이 세팅되어있다면
 
        
            $sql = "UPDATE MOVIE SET MOVIE_TITLE = '$Update_Movie_name' WHERE MOVIE_NUM = $Update_Movie_number";
    
            $stid = oci_parse($connect, $sql);
            oci_execute($stid);
        
            echo "<script>alert('-영화정보 수정 성공-');</script>";
    
            oci_free_statement($stid);
            oci_close($connect);
        }
    
        header("Location: admin.php");
    }
    else{
        echo "<script>alert('- 정보수정실패-\\r\\n $Update_Movie_number 번 영화가 존재하지 않습니다.');</script>";
        header("Location: admin.php");
    }
}
?>