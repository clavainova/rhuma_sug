<h2>Panier</h2>

<section>

    <?php
    //need to calculate cumulative price for total section
    require "classes/basket.php";
    require "classes/produit.php";
    include "checkout_management/checkoutFunctions.php";

    $totalPrice = 0; //to keep track of total price
    $totalQuantity = 0; //to track the total quantity
    $totalWeight = 0; //to track the total weight of the order so we can calculate postage
    $basket = new Basket();
    $items = $basket->getBasket();

    //this isn't working
    if (isset($_SESSION["error"])) :
    ?>
        <div class="error">
            <?php
            print(ERRORS[$_SESSION["error"]]);
            ?>
        </div>
    <?php
        //unset error
        unset($_SESSION['error']);
    endif;

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
                    <h1><?php print($product->__get("name")); ?></h1>
                    <p>PPU: <br>
                        Quantité: <?php print($item[1]); //quantity in cookie not db 
                                    $totalQuantity += $item[1]; //increment total quantity
                                    ?><br>
                        Prix: <?php print($product->__get("price") . "€");
                                $totalPrice += ($product->__get("price") * $item[1]); //increment total with price*quantity 
                                $totalWeight += ($product->__get("weight") * $item[1]); //increment total weight with quantity
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
    <h3>Quantity:</h3>
    <p><?php print($totalQuantity); ?></p>
    <h3>Items:</h3>
    <p><?php print($totalPrice . ".00€"); ?></p>
    <h3>Postage (to EU):</h3>
    <p><?php
        print(calculatePostage($totalWeight));
        if (is_numeric(calculatePostage($totalWeight))) { //add a euro sign, but only if it's a number
            print("€");
        } ?></p>
    <h3 class="underline">Total:</h3>
    <p class="underline"><?php
                            if (!is_numeric(calculatePostage($totalWeight))) {
                                print($totalPrice . "€ + quote needed for postage");
                            } else {
                                print((calculatePostage($totalWeight) + $totalPrice) . "€");
                            } ?><br><br></p>
    <form style="text-align:right;" action="basket_management/destroyBasket.php" method="POST">
        <input class="standalone-button-a" type="submit" name="submit" value="empty entire basket" />
    </form>
    <form action="http://localhost/RhumaSug/index.php?page=checkout" method="POST">
        <input class="standalone-button-b" type="submit" name="submit" value="proceed to checkout" />
    </form>
</div>

</article>