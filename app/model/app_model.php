<?php

class AppModel   {
    public  $con;
    public $numeTabel = '';

    function  __construct () {
        $dbcon = pg_connect("host=localhost port=5432 dbname=proiect_flavian user=flavian password=flaviu2013");
        $this->con = $dbcon;
    }

    function find($type = 'all',$condition = array()) {
        $info = array();
        switch ($type) {
            case 'all' :
                $rez = pg_query( $this->con,"SELECT * FROM ".$this->numeTabel);
                while ($row = pg_fetch_row($rez)) {
                    $info[] = $row;
                }
            break;
        }

        return $info;
    } 


}

?>