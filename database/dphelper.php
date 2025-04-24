<?php
require_once ('config.php');

//insert, update, delete, select
function execute($sql) {
    //open connection
    $conn = mysqli_connect(HOST, DATABASE, USERNAME, PASSWORD);
    mysqli_set_charset('utf-8');
    
    //query
    mysqli_query($conn, $sql);

    //close connection
    mysqli_close($conn);
}

//Sql: select -> lay du lieu dau ra (select danh sach ban ghi)
function executeResult($sql, $isSingle = false) {
    $data = null;
    //open connection
    $conn = mysqli_connect(HOST, DATABASE, USERNAME, PASSWORD);
    mysqli_set_charset('utf-8');
    
    //query
    $resultset = mysqli_query($conn, $sql);
    if ($isSingle){
        $data = mysqli_fetch_array($resultset, 1);
    } else{
        while (($row = mysqli_fetch_array($resultset, 1)) != null) {
            $data[] = $row;
        }
    }

    //close connection
    mysqli_close($conn);
    
    return $data;
}