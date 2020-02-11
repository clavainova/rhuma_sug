<h2>Panier</h2>

<section>

    <?php
    //need to calculate cumulative price for total section

    require "classes/basket.php";
    $basket = new Basket();
    $items = $basket->getBasket();

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
        ?>
            <article>
                <img src="">
                <div>
                    <h1><?php print($item[0]); ?></h1>
                    <p>PPU: <br>
                        Quantité: <?php print($item[1]); ?><br>
                        Prix: <br><br>
                        <a>supprimer</a></p>
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
    <h3>Items:</h3>
    <p>10€00</p>
    <h3 class="underline">Total:</h3>
    <p class="underline">10€00</p>
    <button>→</button>
</div>

</article>