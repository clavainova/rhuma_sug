<article>


    <?php
    //load each product into the page from the database
    $pdo = getConnection();
    //if there's no connection show error
    if ($pdo == false) {
        redirect("http://localhost/RhumaSug/index.php?page=settings");
    }
    $products = fetchData($pdo, "Products");
    //make a div for each product available to purchase
    foreach ($products as $value) :
    ?>
        <div>
            <img src="assets/img/<?php print($value["img_url"]); ?>">
            <h1><?php print($value["product_name"]); ?></h1>
            <p><?php print($value["product_description"]); ?></p>
            <p><?php print($value["unit_price"]); ?>€</p>
            Quantité:
            <select>
                <?php
                //display a drop down menu with the number of units in stock
                for ($i = 0; $i < $value["units_in_stock"]; $i++) {
                    //add 1 to each value shown because it should start at 1 not 0
                    print("<option value='" . ($i + 1) . "'>" . ($i + 1) . "</option>");
                }
                ?>
            </select>
            <!-- this button should somehow call addToBasket($value["product_id"], optionId) -->
            <button>Ajoutez au panier</button>
        </div>
    <?php
    endforeach;
    ?>
</article>