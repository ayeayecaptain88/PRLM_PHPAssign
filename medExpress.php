<?php
include "header.php"; // header include

$storeName = "MedExpress";
$discountRate = 0.10;
$lowStockLimit = 20;

// variables
$searchResult = "";
$restockMessage = "";
$restockHistory = array();

// array
$inventory = array(
    array("name"=>"Paracetamol 500mg", "type"=>"Tablet", "stock"=>120, "price"=>4.50),
    array("name"=>"Amoxicillin 250mg", "type"=>"Capsule", "stock"=>35, "price"=>7.50),
    array("name"=>"Ibuprofen 400mg", "type"=>"Tablet", "stock"=>18, "price"=>8.50),
    array("name"=>"Cetirizine 10mg", "type"=>"Tablet", "stock"=>95, "price"=>16.35),
    array("name"=>"Oral Rehydration Salts", "type"=>"Powder", "stock"=>40, "price"=>18.30),
    array("name"=>"Omeprazole 20mg", "type"=>"Capsule", "stock"=>12, "price"=>26.50),
    array("name"=>"Hydrogen Peroxide", "type"=>"Liquid", "stock"=>60, "price"=>40.25),
    array("name"=>"Betadine 10%", "type"=>"Liquid", "stock"=>15, "price"=>249.75),
    array("name"=>"Loperamide 2mg", "type"=>"Capsule", "stock"=>22, "price"=>19.25),
    array("name"=>"Azithromycin 500mg", "type"=>"Tablet", "stock"=>8, "price"=>60.50)
);

// if, ifelse, and foreach statements
if ($_POST) {
    if (array_key_exists('searchBtn', $_POST) && $_POST['searchBtn']=="Search") {
        $keyword = $_POST['keyword'];
        $found = false;
        foreach($inventory as $item){
            if ($item['name'] == $keyword) {
                $searchResult = $item['name'] . " | Stock: " . $item['stock'];
                $found = true;
            }
        }
        if (!$found) $searchResult = "No medicine found";
    }
    
    if (array_key_exists('restockBtn', $_POST) && $_POST['restockBtn']=="Add") {
        $itemName = $_POST['itemName'];
        $addStock = $_POST['addStock'];
        for ($i=0; $i<count($inventory); $i++){
            if ($inventory[$i]['name'] == $itemName){
                $inventory[$i]['stock'] += $addStock;
                $restockMessage = $inventory[$i]['name']." now has ".$inventory[$i]['stock']." items.";
                $restockHistory[] = array("name"=>$inventory[$i]['name'], "added"=>$addStock);
            }
        }
    }
}

$totalStock = 0;
$totalValue = 0;
$lowStockItems = 0;
for ($i=0; $i<count($inventory); $i++){
    $totalStock += $inventory[$i]['stock'];
    $totalValue += $inventory[$i]['stock'] * $inventory[$i]['price']; // operators
    if ($inventory[$i]['stock'] <= $lowStockLimit) $lowStockItems++;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $storeName; ?></title>
    <style>
        body{margin:0;font-family:Arial;background:#eaf8ff;color:#063a58;}
        .wrapper{width:90%;margin:25px auto;}
        h2{color:#156e75;}
        .box{background:#fff;padding:15px;border-radius:10px;border:1px solid #b7d8ea;margin-top:20px;}
        input, select{width:95%;padding:8px;margin-top:6px;border:1px solid #9ec8dd;border-radius:6px;}
        button{margin-top:10px;padding:10px 18px;background:#9bd3d8;color:white;border:none;border-radius:6px;cursor:pointer;}
        table{width:100%;border-collapse:collapse;margin-top:15px;}
        th{background:#9bd3d8;color:#03484d;padding:10px;}
        td{padding:10px;border:1px solid #bdd7e6;background:#fff;}
        .low{background:#ffe2e2;color:#d10000;font-weight:bold;}
        .discount-tag{padding:2px 6px;background:#2e7d32;color:white;border-radius:4px;font-size:12px;}
    </style>
</head>
<body>


    <div class="wrapper">

        <h2>Search Medicine</h2>
        <div class="box">
            <form method="POST">
                <input type="text" name="keyword" placeholder="Type exact medicine name">
                <button name="searchBtn" value="Search">Search</button>
        </form>
        <?php if ($searchResult!="") echo "<p><b>$searchResult</b></p>"; ?>
    </div>

    <h2>Restock Medicine</h2>
    <div class="box">
        <form method="POST">
            <label>Select item:</label>
            <select name="itemName">
                <?php for($i=0;$i<count($inventory);$i++){ echo "<option>".$inventory[$i]['name']."</option>"; } ?>
            </select>
            <label>Add stock:</label>
            <input type="number" name="addStock" min="1">
            <button name="restockBtn" value="Add">Add</button>
        </form>
        <?php if ($restockMessage!="") echo "<p><b>$restockMessage</b></p>"; ?>
    </div>

<h2>Inventory Table</h2>
<table>
    <tr><th>Name</th><th>Type</th><th>Stock</th><th>Price</th><th>Status</th></tr>
    <?php
    for($i=0;$i<count($inventory);$i++){
        $isLow = $inventory[$i]['stock']<=$lowStockLimit;
        $finalPrice = $inventory[$i]['price'];
        if($isLow) $finalPrice = $inventory[$i]['price'] - ($inventory[$i]['price'] * $discountRate);

        echo "<tr>";
        echo "<td>".$inventory[$i]['name']."</td>";
        echo "<td>".$inventory[$i]['type']."</td>";
        echo $inventory[$i]['stock']<=0 ? "<td class='low'>OUT</td>" : ($isLow ? "<td class='low'>".$inventory[$i]['stock']."</td>" : "<td>".$inventory[$i]['stock']."</td>");
        echo "<td>₱".number_format($finalPrice,2)."</td>";
        if($inventory[$i]['stock']==0) echo "<td class='low'>OUT</td>";
        elseif($isLow) echo "<td class='low'>LOW <span class='discount-tag'>10% OFF</span></td>";
        else echo "<td>Available</td>";
        echo "</tr>";
    }
    ?>
    </table>

    <h2>Low Stock Alerts</h2>
    <table>
        <tr><th>Name</th><th>Stock</th></tr>
        <?php
        for($i=0;$i<count($inventory);$i++){
            if($inventory[$i]['stock']<=$lowStockLimit){
                echo "<tr><td>".$inventory[$i]['name']."</td><td class='low'>".$inventory[$i]['stock']."</td></tr>";
            }
        }
        ?>
    </table>

    <h2>Restock History</h2>
    <table>
        <tr><th>Name</th><th>Added Stock</th></tr>
        <?php
        for($i=0;$i<count($restockHistory);$i++){
            echo "<tr><td>".$restockHistory[$i]['name']."</td><td>".$restockHistory[$i]['added']."</td></tr>";
        }
        ?>
    </table>

    <h2>High Value Items (Price > ₱5)</h2>
    <table>
        <tr><th>Name</th><th>Price</th></tr>
        <?php
        for($i=0;$i<count($inventory);$i++){
            if($inventory[$i]['price']>5){
                echo "<tr><td>".$inventory[$i]['name']."</td><td>₱".number_format($inventory[$i]['price'],2)."</td></tr>";
            }
        }
        ?>
    </table>

    <h2>Summary</h2>
    <table>
        <tr><th>Total Stock</th><th>Total Inventory Value</th><th>Low Stock Items</th></tr>
        <tr><td><?php echo $totalStock;?></td><td>₱<?php echo number_format($totalValue,2);?></td><td><?php echo $lowStockItems;?></td></tr>
    </table>

</div>

<?php include "footer.php"; ?>
</body>
</html>
