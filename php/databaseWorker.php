<?php
    $host = "###########";
    $username = "#########";
    $user_pass = "###########";
    $valArray = array();
    
    $c = oci_pconnect($username, $user_pass, $host);
    $s = oci_parse($c, "SELECT * FROM PORTFOLIO_DATA");
    oci_execute($s);
    $res = NULL;
    $nrows = oci_fetch_all($s, $res);
    
    $tempArray = array_values($res);
    for ($i = 0; $i < $nrows; $i++)
    {
        $valArray += [$tempArray[1][$i] => $tempArray[0][$i]]; # name -> id
        $valArray += [$tempArray[0][$i] * 2 => $tempArray[2][$i]]; # id -> visits
        $valArray += [$tempArray[0][$i] * 2 + 1 => $tempArray[3][$i]]; # id -> downloads
    }

    $tempArray = array();
    oci_close($c);


    /*
        function testConnection()
        {
            $c = oci_pconnect($GLOBALS['username'],$GLOBALS['user_pass'], $GLOBALS['host']);
            $s = oci_parse($c, "SELECT * FROM PORTFOLIO_DATA");
            oci_execute($s);
            $res = NULL;
            $nrows = oci_fetch_all($s, $res);
            json_encode($res, JSON_NUMERIC_CHECK);
            echo "$nrows rows fetched <br>\n";
            var_dump($res);
        }
    */

    function dumpArray()
    {
        var_dump($GLOBALS['valArray']);
    }

    function getID($string)
    {
        $IDFind = 0;
        if(array_key_exists($string, $GLOBALS['valArray']))
        {
            $IDFind = $GLOBALS['valArray'][$string];
        }
        else
        {
            $c = oci_pconnect($GLOBALS['username'],$GLOBALS['user_pass'], $GLOBALS['host']);
            $sql = "INSERT INTO Portfolio_Data(card_name)
                    VALUES (:namePassThrough)";

            $s = oci_parse($c,$sql);
            oci_bind_by_name($s, ':namePassThrough', $string);

            oci_execute($s);

            $n = oci_parse($c, "SELECT * FROM Portfolio_Data");
            oci_execute($n);

            $res = NULL;
            $nrows = oci_fetch_all($s, $res);
            
            $tempArray = array_values($res);
            for ($i = 0; $i < $nrows; $i++)
            {
                $GLOBALS['valArray'] += [$tempArray[1][$i] => $tempArray[0][$i]]; # name -> id
                $GLOBALS['valArray'] += [$tempArray[0][$i] * 2 => $tempArray[2][$i]]; # id -> visits
                $GLOBALS['valArray'] += [$tempArray[0][$i] * 2 + 1 => $tempArray[3][$i]]; # id -> downloads
            }
            $tempArray = array();
            $IDFind = $GLOBALS['valArray'][$string];
            oci_close($c);
        }
        return $IDFind;
    }
    function getDownloads($ID)
    {
        $downloads = $GLOBALS['valArray'][$ID * 2 + 1];
        return $downloads;
    }
    function getVisits($ID)
    {
        $visits = $GLOBALS['valArray'][$ID * 2];
        return $visits;
    }
    
?>