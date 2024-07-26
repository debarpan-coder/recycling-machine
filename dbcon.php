<?php
$hostname = "localhost";
$usernmae="root";
$password="";
$db="recycling_machine";

try {
    $con = mysqli_connect($hostname,$usernmae,$password,$db);
    // echo "Connected";
} catch (Exception $e) {
    //throw $th;
    echo $e->getCode();
}

function run_select_query_for_checking($con,$sql){
    try{
        $res=mysqli_query($con,$sql);
        if($res->num_rows>0){
            return true;
        }else{
            return false;
        }
    } catch(Exception $e) {
        return $e->getCode();
    }
}

?>