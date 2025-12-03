<?php 
include "header.php";

// STEP 2: multidimensional associative array
$products = [
    "Paracetamol 500mg"      => ["price"=>4.50, "stock"=>120],
    "Amoxicillin 250mg"      => ["price"=>7.50, "stock"=>35],
    "Ibuprofen 400mg"        => ["price"=>8.50, "stock"=>18],
    "Cetirizine 10mg"        => ["price"=>16.35, "stock"=>95],
    "ORS Powder"             => ["price"=>18.30, "stock"=>40],

    // ADDED 5 MORE PRODUCTS
    "Vitamin C 500mg"        => ["price"=>5.75, "stock"=>150],
    "Mefenamic Acid 500mg"   => ["price"=>7.80, "stock"=>12],
    "Alcohol 70%"            => ["price"=>32.00, "stock"=>50],
    "Salbutamol Syrup"       => ["price"=>45.00, "stock"=>20],
    "Multivitamins Syrup"    => ["price"=>60.00, "stock"=>8]
];

//STEP 3: global tax variable
$taxRate = 12;

//STEP 4: reorder function
function get_reorder_message(int $stock): string {
    return $stock < 10 ? "Yes" : "No";  // ternary (Step 5)
}

//STEP 6/7: total value function
function get_total_value(float $price, int $qty): float {
    return $price * $qty;
}

//STEP 8/9: tax due function
function get_tax_due(float $price, int $qty, int $tax = 0): float {
    return ($price * $qty) * ($tax / 100);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>MedExpress Stock Function Demo</title>

    <style>
        body{
            font-family: Arial;
            background: #e8f6f9;
            margin: 0;
            padding: 20px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th{
            background: #9bd3d8;
            padding: 10px;
            color: #03484d;
        }

        td{
            padding: 10px;
            border-bottom: 1px solid #cfeaed;
        }

        h2{
            color: #156e75;
            margin-top: 25px;
        }

        .container{
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<div class="container">

<h2>Product Inventory Control </h2>

<table>
    <tr>
        <th>Product Name</th>
        <th>Stock</th>
        <th>Reorder?</th>
        <th>Total Value (₱)</th>
        <th>Tax Due (₱)</th>
    </tr>

    <?php
    //STEP 10 to 16: foreach loop displaying all data
    foreach($products as $product_name => $data){
        $stock = $data["stock"];
        $price = $data["price"];

        echo "<tr>";

        // STEP 11: product name
        echo "<td>$product_name</td>";

        // STEP 12: stock level
        echo "<td>$stock</td>";

        // STEP 13: reorder message
        echo "<td>".get_reorder_message($stock)."</td>";

        // STEP 14: total value
        echo "<td>₱".number_format(get_total_value($price,$stock),2)."</td>";

        // STEP 15: tax due
        echo "<td>₱".number_format(get_tax_due($price,$stock,$taxRate),2)."</td>";

        echo "</tr>";
    }
    ?>

</table>

</div>
<?php include "footer.php"; ?>

</body>
</html>
