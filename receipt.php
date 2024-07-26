<?php
include("header.html");
require("dbcon.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $customer=$_POST["customer_id"];
    $item_id=$_POST["item"];
    $count=$_POST["quantity"];
    $sql="SELECT `id` FROM `customer` WHERE `customer_id` = '".$customer."'";
    echo $sql;
    $res=mysqli_query($con,$sql);
    if($res->num_rows>0){
        $sql="INSERT INTO `transaction`(`customer_id`, `item_id`, `count`) VALUES ('".$customer."','".$item_id."','".$count."')";
        try {
            $res=mysqli_query($con,$sql);
        } catch (Exception $e) {
            $e->getCode();
        }
        echo "Transaction Added";
    }else{
        echo "ERROR: Customer not found";
        $sql="INSERT INTO `customer`(`customer_id`) VALUES ('".$customer."')";
        $res=mysqli_query($con,$sql);
        $sql="INSERT INTO `transaction`(`customer_id`, `item_id`, `count`) VALUES ('".$customer."','".$item_id."','".$count."')";
        echo "Transaction Added";
    }
    ?>

    <h1>Receipt for Customer ID: {{ customer_id }}</h1>
    <ul>
        {% for item_type, count in receipt_details.items() %}
        <li>{{ item_type }}: {{ count }}</li>
        {% endfor %}
    </ul>
    <h3>Total Value: ${{ total_value }}</h3>
    <a href="/RecMachine/">Return More Items</a>
    <a href="summary.php">View Daily Summary</a>
    
    <?php 
}else{
    header("Location:/RecMachine/");
}
include("footer.html");
?>