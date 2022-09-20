<?php
class EnchereModele extends AccesBd
{

    public function tout()
    {
        return $this->lireTout('SELECT * 
                                FROM enchere
                                JOIN timbre 
                                ON enc_id = tim_enc_id_ce
                                JOIN `image`
                                ON img_tim_id_ce = tim_id
                            ');
    }

    public function un($enc_id)
    {
        /* extract($id); */
        return $this->lireUn("  SELECT * 
                                FROM enchere
                                JOIN timbre 
                                ON enc_id = tim_enc_id_ce
                                JOIN `image`
                                ON img_tim_id_ce = tim_id
                                WHERE enc_id = $enc_id");
    }

    public function utilisateur($utiId)
    {
        return $this->lireTout("SELECT * FROM utilisateur WHERE uti_id = $utiId");
    }

    public function ajouter($enchere, $utiId, $name)
    {
        extract($enchere);
        $this->creer(
            "INSERT INTO enchere 
            VALUES (0, :enc_dateDebut, :enc_dateFin, :enc_prixDepart, :enc_prixDepart+1, $utiId);

            INSERT INTO timbre 
            VALUES (NULL, :tim_nom, :tim_couleur, :tim_ville, :tim_pays, :tim_dateCreation, :tim_description, :tim_dimensions, :tim_condition, :tim_certification, last_insert_id());

            INSERT INTO `image` 
            VALUES (NULL, :img_path, last_insert_id())",
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
                ':img_path' => $name
            ]);
    }

   /*  public function retirer($utiId, $name)
    {
        $this->supprimer("DELETE FROM enchere 
                        WHERE enc_uti_id_ce = $utiId",

                        "DELETE FROM timbre
                        WHERE tim_enc_id_ce = enc_id",
                        
                        "DELETE FROM `image`
                        WHERE img_tim_id_ce = tim_id");
    } */

    /*public function changer($enchere)
    {
        extract($enchere);
        $this->modifier("UPDATE enchere 
                            SET enc_nom=:enc_nom, enc_type=:enc_type
                        WHERE enc_id=:enc_id"
            , ['enc_id' => $enc_id, 'enc_nom' => $enc_nom, 'enc_type'=> $enc_type]);
    }*/
} 
