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
        return $this->lireUn("  SELECT * 
                                FROM enchere
                                JOIN mise
                                ON enc_id = mis_enc_id_ce
                                JOIN timbre 
                                ON enc_id = tim_enc_id_ce
                                JOIN `image`
                                ON img_tim_id_ce = tim_id
                                WHERE enc_id = $enc_id");
    }

    public function mise($encId)
    {
        return $this->lireTout("    SELECT MAX(mis_depose) 
                                    FROM mise
                                    JOIN enchere
                                    ON enc_id = mis_enc_id_ce
                                    WHERE enc_id = $encId");
    }

    public function ajouter($enchere, $utiId, $name)
    {
        extract($enchere);
        $encId = $this->creer(
            "INSERT INTO enchere 
            VALUES (0, :enc_dateDebut, :enc_dateFin, :enc_prixDepart, :enc_prixDepart+1, $utiId)",
            [
                'enc_dateDebut' => $enc_dateDebut,
                'enc_dateFin' => $enc_dateFin,
                'enc_prixDepart' => $enc_prixDepart
            ]);

        $timId = $this->creer("INSERT INTO timbre 
            VALUES (0, :tim_nom, :tim_couleur, :tim_ville, :tim_pays, :tim_dateCreation, :tim_description, :tim_dimensions, :tim_condition, :tim_certification, $encId)",
            [
                'tim_nom' => $tim_nom,
                'tim_couleur' => $tim_couleur,
                'tim_ville' => $tim_ville,
                'tim_pays' => $tim_pays,
                'tim_dateCreation' => $tim_dateCreation,
                'tim_description' => $tim_description,
                'tim_dimensions' => $tim_dimensions,
                'tim_condition' => $tim_condition,
                'tim_certification' => $tim_certification
            ]);

            $imgId = $this->creer("INSERT INTO `image` 
            VALUES (0, :img_path, $timId)",
            [
                'img_path' => $name
            ]);
            
            $this->creer("INSERT INTO mise
            VALUES (0, :enc_prixDepart+1, $encId, $utiId);",
            [
                'enc_prixDepart' => $enc_prixDepart
            ]);
    }

    public function retirer($encId)
    {
        $this->supprimer("DELETE FROM `image`
                        WHERE img_tim_id_ce = $encId;
                        DELETE FROM timbre
                        WHERE tim_enc_id_ce = $encId;
                        DELETE FROM enchere 
                        WHERE enc_id = $encId");
    }

    public function changer($infos, $name)
    {
        extract($infos);
        $this->modifier("UPDATE enchere 
                        SET enc_dateDebut = :enc_dateDebut, enc_dateFin = :enc_dateFin, enc_prixDepart = :enc_prixDepart, enc_prixActuel = :enc_prixDepart+1
                        WHERE enc_id = :enc_id;
                        
                        UPDATE timbre
                        SET tim_nom = :tim_nom, tim_couleur = :tim_couleur, tim_ville = :tim_ville, tim_pays = :tim_pays, tim_dateCreation = :tim_dateCreation, tim_description = :tim_description, tim_dimensions = :tim_dimensions, tim_condition = :tim_condition, tim_certification = :tim_certification
                        WHERE tim_enc_id_ce = :enc_id;

                        UPDATE `image`
                        SET img_path = :img_path
                        WHERE img_tim_id_ce = :enc_id",
                        [
                            ':enc_dateDebut' => $enc_dateDebut,
                            ':enc_dateFin' => $enc_dateFin,
                            ':enc_prixDepart' => $enc_prixDepart,
                            ':enc_id' => $enc_id,
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
                } 
