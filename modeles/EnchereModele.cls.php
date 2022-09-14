<?php
class EnchereModele extends AccesBd
{

    public function tout()
    {
        return $this->lireTout('SELECT * FROM enchere');
    }

    public function ajouter($enchere, $utiId)
    {
        extract($enchere);
        $this->creer(
            "INSERT INTO enchere VALUES (0, :enc_dateDebut, :enc_dateFin, :enc_prixDepart, :enc_prixDepart+1, 0, $utiId); INSERT INTO timbre VALUES (NULL, :tim_nom, :tim_couleur, :tim_ville, :tim_pays, :tim_dateCreation, :tim_description, :tim_dimensions, :tim_condition, :tim_certification, last_insert_id()); INSERT INTO image VALUES (NULL, :img_principale, last_insert_id())",
            [
                ':enc_dateDebut' => $enc_dateDebut,
                ':enc_dateFin' => $enc_dateFin,
                ':enc_prixDepart' => $enc_prixDepart,
                ':tim_nom' => $tim_nom,
                ':tim_couleur' => $tim_couleur,
                ':tim_ville' => $tim_ville,
                ':tim_pays' => $tim_pays,
                ':tim_dateCreation' => $tim_dateCreation,
                ':tim_description' => $tim_description,
                ':tim_dimensions' => $tim_dimensions,
                ':tim_condition' => $tim_condition,
                ':tim_certification' => $tim_certification,
                ':img_principale' => $img_principale
            ]);
    }

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
