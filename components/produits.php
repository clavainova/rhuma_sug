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
        <form class="produit" action="basket_management/addtoBasket.php" method="POST">
            <img src="assets/img/<?php print($value["img_url"]); ?>">
            <h1><?php print($value["product_name"]); ?></h1>
            <p><?php print($value["product_description"]); ?></p>
            <p><?php print($value["unit_price"]); ?>€</p>
            Quantité:
            <select name="quantity" id="quantity" value="">
                <?php
                //display a drop down menu with the number of units in stock
                for ($i = 0; $i < $value["units_in_stock"]; $i++) :
                    //add 1 to each value shown because it should start at 1 not 0
                ?>
                    <option value="<?php print($i + 1); ?>"><?php print($i + 1); ?></option>
                <?php endfor; ?>
            </select>
            <input style="display:none;" name="id" id="id" value="<?php print($value["product_id"]); ?>" />
            <input type="submit" name="submit" value="submit" />
        </form>
    <?php
    endforeach;
    ?>
</article>