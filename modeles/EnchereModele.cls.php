<?php
class EnchereModele extends AccesBd
{

/**
 * **********************************************************************
 * ***** AFFICHAGE ET GESTION DES ENCHERES *****
 * **********************************************************************
 */ 



    /**
     * affichage des enchères
     *
     * @return void
     */
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

        
    /**
     * affichage d'une seule enchère
     *
     * @param  mixed $enc_id
     * @return void
     */
    public function un($enc_id)
    {
        return $this->lireUn("  SELECT *
                                FROM enchere
                                JOIN utilisateur
                                ON enc_uti_id_ce = uti_id
                                JOIN timbre 
                                ON enc_id = tim_enc_id_ce
                                JOIN `image`
                                ON img_tim_id_ce = tim_id
                                WHERE enc_id = $enc_id");
    }


    /**
     * ajouter une enchère
     *
     * @param  mixed $enchere
     * @param  mixed $utiId
     * @param  mixed $name
     * @return void
     */
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

            $this->creer("INSERT INTO `image` 
            VALUES (0, :img_path, $timId)",
            [
                'img_path' => $name
            ]);
    }

    
    /**
     * retirer une enchère
     *
     * @param  mixed $encId
     * @return void
     */
    public function retirer($encId)
    {
        $this->supprimer("DELETE FROM `image`
                        WHERE img_tim_id_ce = $encId;
                        DELETE FROM timbre
                        WHERE tim_enc_id_ce = $encId;
                        DELETE FROM enchere 
                        WHERE enc_id = $encId;
                        DELETE FROM mise
                        WHERE mis_enc_id_ce = $encId;
                        DELETE FROM favoris
                        WHERE fav_enc_id_ce = $encId");
    }
    
    /**
     * changer une enchère
     *
     * @param  mixed $infos
     * @param  mixed $name
     * @return void
     */
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

/**
 * ***********************************************************************
 * ****** AFFICHAGE ET GESTION DES MISES *****
 * ***********************************************************************
 */


    /**
     * selection d'une mise 
     *
     * @param  mixed $encId
     * @return void
     */
    public function mise($encId)
    {
        return $this->lireTout("    SELECT *, TIME(mis_date) AS heure
                                    FROM mise
                                    JOIN enchere
                                    ON enc_id = mis_enc_id_ce
                                    JOIN utilisateur
                                    ON mis_uti_id_ce = uti_id
                                    WHERE enc_id  = $encId
                                    ORDER BY mis_date ASC");
    }

    public function enchGagnant($encId)
    {
        return $this->lireUn("  SELECT *, MAX(mis_montant)
                                FROM mise
                                JOIN utilisateur
                                ON mis_uti_id_ce = uti_id 
                                WHERE mis_enc_id_ce  = $encId
        
                            ");
    }

    
    /**
     * ajouter une mise
     *
     * @param  mixed $encid
     * @param  mixed $montant
     * @param  mixed $utiid
     * @return void
     */
    public function addMise($encid, $montant, $utiid) {

            $this->creer(   "INSERT INTO mise (mis_montant, mis_date, mis_enc_id_ce, mis_uti_id_ce)
                            VALUES (:mis_montant, NOW(), :mis_enc_id_ce, $utiid)",
                            array(
                                ':mis_montant' => $montant,
                                ':mis_enc_id_ce' => $encid
                            ));
            $this->modifier("UPDATE enchere
                            SET enc_prixActuel = :mis_montant
                            WHERE enc_id = :mis_enc_id_ce",
                            array(
                                ':mis_montant' => $montant,
                                ':mis_enc_id_ce' => $encid
                            ));
                        }



/**
 * **********************************************************************
 * ***** AFFICHAGE ET GESTION DES FAVORIS *****
 * **********************************************************************
 */
    
    /**
     * addFavori: ajoute une enchère dans la table favori
     *
     * @param  mixed $encid
     * @param  mixed $utiid
     * @return void
     */
    public function addFavori($encid, $utiid) {

        $this->creer(   "INSERT INTO favoris (fav_id, fav_enc_id_ce, fav_uti_id_ce)
                        VALUES (NULL, :fav_enc_id_ce, $utiid)",
                        array(
                            ':fav_enc_id_ce' => $encid
                        ));
    }
    
    /**
     * delFavori: supprime une enchère de la table favori
     *
     * @param  mixed $encid
     * @param  mixed $utiid
     * @return void
     */
    public function delFavori($encid, $utiid) {

        $this->supprimer(   "DELETE FROM favoris
                            WHERE fav_enc_id_ce = :fav_enc_id_ce AND fav_uti_id_ce = $utiid",
                            array(
                                ':fav_enc_id_ce' => $encid
                            ));
    }

    /**
     * getAllFavoris: selectionne les enchères favoris d'un utilisateur
     *
     * @param  mixed $utiid
     * @return void
     */
    public function getAllFavoris($utiid) {

        return $this->lireTout("SELECT *
                                FROM enchere
                                JOIN favoris
                                ON fav_enc_id_ce = enc_id
                                JOIN timbre 
                                ON enc_id = tim_enc_id_ce
                                JOIN `image`
                                ON img_tim_id_ce = tim_id
                                WHERE fav_uti_id_ce = $utiid
                                GROUP BY fav_id
                                ORDER BY enc_dateDebut");
    }

    /**
     * getFavori: selectionne l'enchère favorite d'un utilisateur
     *
     * @param  mixed $utiid
     * @return void
     */
    public function getFavori($encid, $utiid) {
        return $this->lireUn("SELECT *
                            FROM favoris
                            WHERE fav_uti_id_ce = $utiid
                            AND fav_enc_id_ce = $encid");
    }






/**
* **********************************************************************
* ***** RECHERCHE *****
* **********************************************************************
*/

public function rechercher($word) {
    //$mot = "%".$word."%";
    return $this->lireTout("SELECT * 
    FROM timbre
    JOIN enchere
    ON enc_id = tim_enc_id_ce
    LEFT JOIN mise 
    ON enc_id = mis_enc_id_ce
    RIGHT JOIN `image`
    ON img_tim_id_ce = tim_id
    WHERE tim_nom LIKE '%' :word '%'
    GROUP BY enc_id",
    [
        ":word" => $word
    ]);
}





/**
* **********************************************************************
* ***** MESSAGE *****
* **********************************************************************
*/

public function userSender($utiId)
    {
        return $this->lireUn("SELECT * FROM utilisateur 
                                WHERE uti_id=:id"
                            , ['id'=>$utiId]);
    }

public function msgUser($sender, $receiver, $suj, $msg)
    {
        /* $re = $this->lireUn("SELECT * FROM utilisateur 
        WHERE uti_rol_id_ce = $receiver"); */

        $this->creer("  INSERT INTO `message` 
                        VALUES (0, :msg_sujet, :msg_contenu, NOW(), $sender, $receiver)", 
                            [
                                "msg_sujet"     => $suj, 
                                "msg_contenu"     => $msg
                            ]);
    }

public function getMessage($utiId) {
    return $this->lireTout("SELECT * FROM `message`
                            JOIN utilisateur
                            ON msg_sender = uti_id
                            WHERE msg_receiver = $utiId 
                            GROUP BY msg_id");
}
}