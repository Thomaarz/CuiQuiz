<?php


class VueBoutique
{

    public function categories($categories) {
        ?>
        <div class="main-box">
            <h1 class="main-title">Boutique</h1>

            <div class="main-subbox shop-mainbox">
                <?php
                foreach ($categories as $category) {
                    ?>

                    <a href="index.php?module=boutique&category=<?=$category['categorie_shop_id'];?>" class="shop-box">
                        <h1 class="blue"><?=$category['categorie_shop_name'];?></h1>
                        <img alt="<?=$category['categorie_shop_name'];?>" src="images/shop/<?=$category['categorie_shop_image'];?>" class="shop-image">
                        <p><?=$category['categorie_shop_description'];?></p>
                        <strong class="blue-button-small">Clique ici</strong>
                    </a>

                    <?php
                }
                ?>
            </div>

        </div>
        <?php
    }

    public function items($items) {
        ?>
        <div class="main-box">
            <h1 class="main-title">Boutique</h1>

            <div class="main-subbox shop-mainbox">
                <?php
                foreach ($items as $item) {
                    ?>

                    <a href="index.php?module=boutique&category=<?=$item['categorie_shop_id'];?>" class="shop-box">
                        <h1 class="blue"><?=$item['item_shop_name'];?></h1>
                        <img alt="<?=$item['item_shop_name'];?>" src="images/shop/<?=$item['item_shop_image'];?>" class="shop-image">
                        <p><?=$item['item_shop_description'];?></p>
                        <strong class="blue-button-small"><?=$item['item_shop_price'];?> Coins</strong>
                    </a>

                    <?php
                }
                ?>
            </div>

        </div>
        <?php
    }

}