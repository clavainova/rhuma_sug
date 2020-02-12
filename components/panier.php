<h2>Panier</h2>

<form action="basket_management/destroyBasket.php" method="POST">
    <input type="submit" name="submit" value="empty entire basket" />
</form>

<section>

    <?php
    //need to calculate cumulative price for total section

    require "classes/basket.php";
    require "classes/produit.php";
    $totalPrice = 0; //to keep track of total price
    $totalQuantity = 0; //to track the total quantity
    $basket = new Basket();
    $items = $basket->getBasket();
    // var_dump($_COOKIE["basket"]);

    if (!$items) :
    ?>
        <article>
            <div>
                <h1>No items currently in basket</h1>
            </div>
        </article>
        <?php
    else :
        foreach ($items as $item) :
            $product = fetchSpecificProduct($item[0]); //fetch the product by ID from the database to get all the data
        ?>
            <article>
                <img src="<?php print("assets/img/" . $product->__get("img_url")); ?>">
                <div>
                    <h1><?php print($product->__get("name")); ?>"</h1>
                    <p>PPU: <br>
                        Quantité: <?php print($item[1]); //quantity in cookie not db 
                                    $totalQuantity += $item[1]; //increment total quantity
                                    ?><br>
                        Prix: <?php print($product->__get("price") . "€");
                                $totalPrice += ($product->__get("price") * $item[1]); //increment total with price*quantity 
                                ?></p>
                    <form action="basket_management/removeFromBasket.php" method="POST">
                        <input style="display:none;" type="text" id="id" name="id" value="<?php print($item[0]); ?>" />
                        <input style="display:none;" type="text" id="quantity" name="quantity" value="<?php print($item[1]); ?>" />
                        <input type="submit" name="submit" value="supprimer" />
                    </form>
                </div>
            </article>
    <?php
        endforeach;
    endif;
    ?>
</section>

<div class="highlightbox">
    <h3>Postage:</h3>
    <p>0€00</p>
    <h3>Quantity:</h3>
    <?php print($totalQuantity); ?>
    <h3>Items:</h3>
    <p><?php print($totalPrice . ".00€"); ?></p>
    <h3 class="underline">Total:</h3>
    <p class="underline"></p>
    <button>→</button>
</div>

</article>