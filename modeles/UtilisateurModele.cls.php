<?php
class UtilisateurModele extends AccesBd
{
    /**
     * 
     */
    public function tout() {
        return $this->lireTout('SELECT * FROM utilisateur');
    }

    public function un($courriel)
    {
        return $this->lireUn("SELECT * FROM utilisateur 
                                WHERE uti_courriel=:email"
                        , ['email'=>$courriel]);
    }

    public function ajouter($utilisateur)
    {
        extract($utilisateur);
        $this->creer("  INSERT INTO utilisateur 
                        VALUES (NULL, :uti_nom, :uti_courriel, :uti_mdp, :uti_pays, DEFAULT)", 
                            [
                                "uti_nom"       => $uti_nom, 
                                "uti_courriel"  => $uti_courriel, 
                                "uti_mdp"       => password_hash($uti_mdp, PASSWORD_DEFAULT), 
                                "uti_pays"      => $uti_pays
                            ]);
    }
}