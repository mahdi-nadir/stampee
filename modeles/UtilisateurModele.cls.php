<?php
class UtilisateurModele extends AccesBd
{
    /**
     * 
     */
    public function un($courriel)
    {
        return $this->lireUn("SELECT * FROM utilisateur 
                                WHERE uti_courriel=:email"
                        , ['email'=>$courriel]);
    }

    public function ajouter($utilisateur)
    {
        extract($utilisateur);
        $this->creer("INSERT INTO utilisateur (uti_id, uti_nom, uti_courriel, uti_mdp,uti_pays, uti_role) 
                        VALUES (NULL, :nom, :courriel, :mdp, :pays, DEFAULT)", [
                                "nom"       => $uti_nom, 
                                "courriel"  => $uti_courriel, 
                                "mdp"       => password_hash($uti_mdp, PASSWORD_DEFAULT), 
                                "pays"      => $uti_pays
                            ]);
    }
}