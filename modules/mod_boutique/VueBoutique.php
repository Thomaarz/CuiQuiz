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

                    <a href="index.php?module=boutique&action=buy&item=<?=$item['item_shop_id'];?>" class="shop-box">
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

    public function recap($item) {
        ?>
        <div class="main-box">
            <h1 class="main-title">Boutique - Recapitulatif</h1>

            <div class="main-subbox">
                <form method="post">
                    <div class="line">
                        <label for="category" class="line-key blue-button">Categorie</label>
                        <input name="category" class="line-value" type="text" value="<?=$item['categorie_shop_name'];?>" readonly>
                    </div>
                    <div class="line">
                        <label for="name" class="line-key blue-button">Contenue</label>
                        <input name="name" class="line-value" type="text" value="<?=$item['item_shop_name'];?>" readonly>
                    </div>
                    <div class="line">
                        <label for="price" class="line-key blue-button">Prix</label>
                        <input name="price" class="line-value" type="number" value="<?=$item['item_shop_price'];?>" readonly>
                    </div>
                    <input name="item_id" class="line-value hide" type="number" value="<?=$item['item_shop_id'];?>" readonly>
                    <input type="submit" name="form-recap" value="Acheter" class="blue-button">
                </form>
            </div>

        </div>
        <?php
    }

    public function noCoins() {
        ?>

        <div class="error-message">
            <p class="big-1">Pas assez de coins !</p>
        </div>

        <?php
    }

    public function buySuccess() {
        ?>

        <div class="success-message">
            <p class="big-1">Achat effectué avec succès !</p>
        </div>

        <?php
    }

}