<?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        //error message code
?>

<html>

<body>

<?php

//orcale data base address
$db = '
(DESCRIPTION =
        (ADDRESS_LIST=
                (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
        )
        (CONNECT_DATA =
        (SID = orcl)
        )
)';

//enter user name & password

$username="db502group4";
$password="test1234";

//connect with oracle_db
$connect = oci_connect($username, $password, $db);

//oracle db connection error message
if(!$connect){
        $e = oci_error();
        trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

?>
</body>
</html><?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        //error message code
?>

<html>

<body>

<?php

//orcale data base address
$db = '
(DESCRIPTION =
        (ADDRESS_LIST=
                (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
        )
        (CONNECT_DATA =
        (SID = orcl)
        )
)';

//enter user name & password

$username="db502group4";
$password="test1234";

//connect with oracle_db
$connect = oci_connect($username, $password, $db);

//oracle db connection error message
if(!$connect){
        $e = oci_error();
        trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

if(!session_id()) {
        session_start();//세션이 시작 안돼있다면 세션시작.
    }
?>




