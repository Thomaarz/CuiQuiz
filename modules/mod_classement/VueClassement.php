<?php


class VueClassement
{

    public function classement($users) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Classement</h1>

            <div>

                <?php

                $i = 1;
                foreach ($users as $user) {
                    ?>

                    <div class="classement-box">
                        <h2 class="big-3">#<?=$i++;?></h2>
                        <h2 class="big-3">[<?=$user['rank_name']?>] <?=$user['user_name']?> (<?=$user['titre_name']?>)</h2>
                        <h2 class="big-3">Niveau: <?=$user['user_level']?></h2>
                    </div>

                    <?php
                }
                ?>

            </div>

        </div>

        <?php
    }

}