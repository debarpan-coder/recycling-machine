<?php
include("header.html");
require("dbcon.php");
?>
    <h1>Daily Summary</h1>
    <h3>Total Items Returned:</h3>
    <ul>
        {% for item_type, count in total_items.items() %}
            <li>{{ item_type }}: {{ count }}</li>
        {% endfor %}
    </ul>
    <h3>Total Number of Items: {{ daily_count }}</h3>
    <a href="/RecMachine/">Return More Items</a>
<?php
include("footer.html");
?>
