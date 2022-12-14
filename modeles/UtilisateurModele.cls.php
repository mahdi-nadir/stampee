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

    public function contacter($suj, $msg, $utilisateur)
    {
        $this->creer("  INSERT INTO `message` 
                        VALUES (0, :msg_sujet, :msg_contenu, NOW(), $utilisateur, 1)", 
                            [
                                "msg_sujet"     => $suj, 
                                "msg_contenu"     => $msg
                            ]);
    }
}