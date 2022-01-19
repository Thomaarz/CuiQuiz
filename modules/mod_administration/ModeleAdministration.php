<?php


class ModeleAdministration extends Connection
{

    public function getNews($actus_id) {
        $prepare = self::$db->prepare("SELECT * FROM actus WHERE actus_id = ?;");
        $prepare->execute(array($actus_id));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function insertNews($sender, $title, $lore) {
        $prepare = self::$db->prepare("INSERT INTO actus (actus_sender, actus_title, actus_lore) VALUES (?, ?, ?);");
        $prepare->execute(array($sender, $title, $lore));
    }

    public function updateNews($id, $title, $lore) {
        $prepare = self::$db->prepare("UPDATE actus SET actus_title = ?, actus_lore = ? WHERE actus_id = ?");
        $prepare->execute(array($title, $lore, $id));
    }

    public function deleteNews($id) {
        $prepare = self::$db->prepare("DELETE FROM actus WHERE actus_id = ?");
        $prepare->execute(array($id));
    }
}