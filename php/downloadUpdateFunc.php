<?php
    $host = "#######";
    $username = "########";
    $user_pass = "########";
    
    $ID = isset($_POST['ID']) ? $_POST['ID'] : -1;

    if($ID != -1)
    {
        $c = oci_pconnect($username,$user_pass, $host);
        $sql = "UPDATE Portfolio_Data
                SET downloads = downloads + 1
                WHERE $ID"; 

        $s = oci_parse($c,$sql);
        oci_execute($s);
        oci_close($c);
    }
?>
