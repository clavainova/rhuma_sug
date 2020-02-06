<article>


    <?php
    //load each product into the page from the database
    $pdo = getConnection();
    //if there's no connection show error
    if ($pdo == false) {
        redirect("http://localhost/RhumaSug/index.php?page=settings");
    }
    $products = fetchData($pdo, "Products");
    //var_dump($products);
    foreach ($products as $value) :
    ?>
        <div>
            <img src="assets/img/<?php print($value["img_url"]); ?>">
            <h1><?php print($value["product_name"]); ?></h1>
            <p><?php print($value["product_description"]); ?></p>
            <p><?php print($value["unit_price"]); ?>€</p>
            <button>Ajoutez au panier</button>
        </div>
    <?php
    endforeach;
    ?>
</article>