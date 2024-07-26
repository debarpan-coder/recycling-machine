<?php
include("header.html");
require("dbcon.php");
?>
<div class="container my-3">

    <h1 class="text-danger text-center">Recycling Machine</h1>
    <form action="receipt.php" method="post">
        <div class="mb-3">
            <label for="customerId" class="form-label fs-5 fw-bold">Enter Customer ID</label>
            <input type="text" name="customer_id" class="form-control" id="customerId" required>
        </div>
        <?php
        $sql="select * from item";
        $res=mysqli_query($con,$sql);
        if($res){
            ?>
            <div class="mb-3">
                <label for="itemList" class="form-label fs-5 fw-bold" require>Select Items to Return</label>
                <select class="form-select" id="itemList" aria-label="Default select example" name="item">
            <?php
            while ($d=mysqli_fetch_row($res)){
            ?>
                    <option value="<?php echo$d[0] ?>"><?php printf($d[1]) ?> (<?php echo$d[2] ?>)</option>
            <?php
            }
            ?>
                </select>
            </div>
            <?php
        }
        ?>
        <div class="mb-3">
            <label for="quantity" class="form-label fs-5 fw-bold">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control"  required>
        </div>
        <button class="btn btn-primary" type="submit">Return Items</button>
    </form>
    <br>
    <a href="summary.php">View Daily Summary</a>
</div>
<?php
include("footer.html");
?>
