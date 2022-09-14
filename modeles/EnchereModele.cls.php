<?php
class EnchereModele extends AccesBd
{
    /**
     * Cherche tout les enregistrements de la table enchere
     */
    public function tout()
    {
        return $this->lireTout('SELECT * FROM enchere');
    }

    public function ajouter($enchere, $utiId)
    {
        extract($enchere);
        $this->creer(
            "INSERT INTO enchere VALUES (0, :enc_dateDebut, :enc_dateFin, :enc_prixDepart, 500, 0, $utiId)",
            [
                ':enc_dateDebut' => $enc_dateDebut,
                ':enc_dateFin' => $enc_dateFin,
                ':enc_prixDepart' => $enc_prixDepart
                
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
