<?php


class VueBoutique
{

    public function categories($categories) {
        ?>
        <div class="main-box">
            <h1 class="main-title">Boutique</h1>

            <div class="main-subbox">
                <?php
                foreach ($categories as $category) {
                    ?>

                    <div>
                        <h2><?=$category['categorie_shop_name'];?></h2>
                    </div>

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

            <div class="main-subbox">
                <?php
                foreach ($items as $item) {
                    ?>

                    <div>
                        <h2><?=$item['item_shop_name'];?></h2>
                    </div>

                    <?php
                }
                ?>
            </div>

        </div>
        <?php
    }

}