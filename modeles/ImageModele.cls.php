<?php
class EnchereModele extends AccesBd
{

    /* public function tout()
    {
        return $this->lireTout('SELECT * FROM image');
    } */

    /* public function ajouter($images)
    {
        //extract($images);
        $this->creer(
            "INSERT INTO image VALUES (NULL, $images, NULL)",
            [
                ':img_principale' => $img_principale
            ]);
    } */

    /*public function retirer($encId)
    {
        $this->supprimer("DELETE FROM encegorie WHERE enc_id=:enc_id"
            , ['enc_id' => $encId]);
    }

    public function changer($encegorie)
    {
        extract($encegorie);
        $this->modifier("UPDATE encegorie 
                            SET enc_nom=:enc_nom, enc_type=:enc_type
                        WHERE enc_id=:enc_id"
            , ['enc_id' => $enc_id, 'enc_nom' => $enc_nom, 'enc_type'=> $enc_type]);
    }*/
} 
