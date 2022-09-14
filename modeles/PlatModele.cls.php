<?php
class TimbreModele extends AccesBd
{
    /**
     * Cherche tout les enregistrements de la table timbre
     */
    public function tout()
    {
        return $this->lireTout('SELECT * FROM plat ORDER BY pla_cat_id_ce ASC, pla_id ASC');
    }

    /**
     * Chercher les encheres de types 'timbre'
     */
    public function toutesCategories() {
        return $this->lireTout("SELECT * FROM categorie WHERE cat_type='plat'");
    }

    public function ajouter($plat)
    {
        extract($plat);
        $this->creer(
            "INSERT INTO plat VALUES (0, :pla_nom, :pla_detail, :pla_portion, :pla_prix, :pla_cat_id_ce)"
            , [
                "pla_nom"       => $pla_nom, 
                "pla_detail"    => $pla_detail,
                "pla_prix"      => $pla_prix,
                "pla_portion"   => $pla_portion,
                "pla_cat_id_ce" => $pla_cat_id_ce
            ]);
    }

    public function retirer($plaId)
    {
        $this->supprimer("DELETE FROM plat WHERE pla_id=:pla_id"
            , ['pla_id' => $plaId]);
    }

    public function changer($plat)
    {
        extract($plat);
        $this->modifier("UPDATE plat 
                            SET 
                                pla_nom = :pla_nom,
                                pla_detail = :pla_detail,
                                pla_portion = :pla_portion,
                                pla_prix = :pla_prix,
                                pla_cat_id_ce = :pla_cat_id_ce
                        WHERE pla_id=:pla_id"
            , [
                "pla_id"        => $pla_id,
                "pla_nom"       => $pla_nom, 
                "pla_detail"    => $pla_detail,
                "pla_prix"      => $pla_prix,
                "pla_portion"   => $pla_portion,
                "pla_cat_id_ce" => $pla_cat_id_ce
            ]);
    }
}
