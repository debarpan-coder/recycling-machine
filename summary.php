<?php
include("header.html");
require("dbcon.php");
?>
<div class="container d-flex flex-column justify-content-center align-items-center">
    <h1>Daily Summary</h1>
    <h3>Total Items Returned:</h3>
    <?php
    $total=0;
    $sql="SELECT i.item_type,i.size,sum(t.count) from item i, transaction t WHERE t.item_id=i.id GROUP by i.item_type, i.size";
    $res=mysqli_query($con,$sql);
    if($res->num_rows >0){
        echo "<ul>";
        while($data=mysqli_fetch_row($res)){
            $total+=$data[2];
            echo "<li>".$data[0]."(".$data[1].") : ".$data[2]."</li>";
        }
        echo "</ul>";
    }
    ?>
    <h3>Total Number of Items: <?php echo $total?></h3>
    <a href="/RecMachine/">Return More Items</a>
</div>
<?php
include("footer.html");
?>
