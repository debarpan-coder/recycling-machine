<?php
include("header.html");
require("dbcon.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $customer=$_POST["customer_id"];
    $item_id=$_POST["item"];
    $count=$_POST["quantity"];
    $sql="SELECT `id` FROM `customer` WHERE `customer_id` = '".$customer."'";
    $res=mysqli_query($con,$sql);
    if($res->num_rows>0){
        $data=mysqli_fetch_row($res);
        $customer_id=$data[0];
        $sql="INSERT INTO `transaction`(`customer_id`, `item_id`, `count`) VALUES ('".$customer_id."','".$item_id."','".$count."')";
        try {
            $res=mysqli_query($con,$sql);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }else{
        $sql="INSERT INTO `customer`(`customer_id`) VALUES ('".$customer."')";
        $res=mysqli_query($con,$sql);
        $sql="SELECT `id` FROM `customer` WHERE `customer_id` = '".$customer."'";
        $res=mysqli_query($con,$sql);
        if($res->num_rows>0){
            $data=mysqli_fetch_row($res);
            $customer_id=$data[0];
            $sql="INSERT INTO `transaction`(`customer_id`, `item_id`, `count`) VALUES ('".$customer_id."','".$item_id."','".$count."')";
            try {
                $res=mysqli_query($con,$sql);
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
    }
    ?>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h1>Receipt for Customer ID: <?php echo $customer?></h1>
        <ul>
            <?php 
            $sql="select i.item_type, i.size, i.deposit_value, sum(t.count) from item i, transaction t WHERE i.id=t.item_id and t.customer_id=".$customer_id." GROUP by i.item_type, i.size";
            $total=0;
            $res=mysqli_query($con,$sql);
            if($res->num_rows>0){
                while($data=mysqli_fetch_row($res)){
                    $total+=$data[2]*$data[3];
                    echo "<li>".$data[0]."(".$data[1].") : ".$data[3]."</li>";
                }
            }?>
        </ul>
        <h3>Total Value: ₹<?php echo $total?></h3>
        <a href="/recycling-machine/">Return More Items</a>
        <a href="summary.php">View Daily Summary</a>
    </div>
    
    <?php 
}else{
    header("Location:/RecMachine/");
}
include("footer.html");
?>