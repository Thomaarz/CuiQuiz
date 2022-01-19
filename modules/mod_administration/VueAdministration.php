<?php


class VueAdministration
{

    public function createActus() {
        ?>

        <div class="main-box">
            <div class="admin-line">
                <div class="admin-top">
                    <div class="admin-left">
                        <h1 class="orange-button admin-title">Nouvelle actualite</h1>
                    </div>
                    <div class="admin-right">
                        <h2></h2>
                    </div>
                </div>
                <div class="admin-bottom">
                    <form class="admin-form" method="post" autocomplete="off">
                        <div class="line">
                            <h2 class="blue-button">Titre</h2>
                            <input class="form-input" name="title" placeholder="Titre" type="text" required>
                        </div>
                        <div class="line">
                            <h2 class="blue-button">Description</h2>
                            <textarea class="form-input" id="input-actus-lore" name="lore" placeholder="Description" type="text" rows="10" required></textarea>
                        </div>

                        <input class="blue-button" type="submit" name="form-news-create" value="Creer">
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    public function updateActus($actus) {
        ?>

        <div class="main-box">
            <div class="admin-line">
                <div class="admin-top">
                    <div class="admin-left">
                        <h1 class="orange-button admin-title">Modification actualite</h1>
                    </div>
                    <div class="admin-right">
                        <h2></h2>
                    </div>
                </div>
                <div class="admin-bottom">
                    <form class="admin-form" method="post" autocomplete="off">
                        <div class="line">
                            <h2 class="blue-button">Titre</h2>
                            <input class="form-input" name="title" value="<?=$actus['actus_title'];?>" type="text" required>
                        </div>
                        <div class="line">
                            <h2 class="blue-button">Description</h2>
                            <textarea class="form-input" id="input-actus-lore" name="lore" rows="10" required><?=$actus['actus_lore'];?></textarea>
                        </div>

                        <input class="blue-button" type="submit" name="form-news-update" value="Mettre a jour">
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    public function deleteActus($actus) {
        ?>

        <div class="main-box">
            <div class="admin-line">
                <div class="admin-top">
                    <div class="admin-left">
                        <h1 class="orange-button admin-title">Suppression actualite</h1>
                    </div>
                    <div class="admin-right">
                        <h2></h2>
                    </div>
                </div>
                <div class="admin-bottom">
                    <form class="admin-form" method="post" autocomplete="off">
                        <div class="line">
                            <h2 class="blue-button">Titre</h2>
                            <input class="form-input" name="title" value="<?=$actus['actus_title'];?>" type="text" required readonly>
                        </div>
                        <div class="line">
                            <h2 class="blue-button">Description</h2>
                            <textarea class="form-input" id="input-actus-lore" name="lore" rows="10" required readonly><?=$actus['actus_lore'];?></textarea>
                        </div>

                        <input class="blue-button" type="submit" name="form-news-delete" value="Supprimer">
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    public function createSuccess() {
        ?>

        <div class="success-message">
            <p class="big-2">
                Nouvelle article ajouté !
            </p>
        </div>

        <?php
    }

    public function updateActusSuccess() {
        ?>

        <div class="success-message">
            <p class="big-2">
                L'article a été mis à jour
            </p>
        </div>

        <?php
    }

    public function deleteActusSuccess() {
        ?>

        <div class="success-message">
            <p class="big-2">
                L'article a été supprimé
            </p>
        </div>

        <?php
    }

    public function invalidFile() {
        ?>

        <div class="error-message">
            <p class="big-2">
                Erreur du chargement de l'image
            </p>
        </div>

        <?php
    }
}