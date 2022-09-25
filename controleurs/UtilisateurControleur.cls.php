<?php
class UtilisateurControleur extends Controleur
{
    function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        /* if(isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('accueil/index');
        } */
    }

    public function index()
    {
        Utilitaire::nouvelleRoute('utilisateur/connect');

    }

    public function nouveau()
    {

    }

    public function connect()
    {

    }

    public function contact()
    {
        $this->gabarit->affecter('user', $this->modele->un($_SESSION['utilisateur']->uti_courriel));
    }

    public function ajouter()
    {
        $this->modele->ajouter( $_POST );
        Utilitaire::nouvelleRoute('utilisateur/connect');
    }

    public function connexion()
    {
        $courriel = $_POST['uti_courriel'];
        $mdp = $_POST['uti_mdp'];
        
        $utilisateur = $this->modele->un($courriel);
        

        /* $erreur = false;
        if(!$utilisateur || !password_verify($mdp, $utilisateur->uti_mdp)) {
            $erreur = "Combinaison courriel/mot de passe erronée";
        } */

        if($utilisateur) {
            $_SESSION['utilisateur'] = $utilisateur;
            Utilitaire::nouvelleRoute('accueil/index');
        }
        /* else {
            $this->gabarit->affecter('erreur', $erreur);
            $this->gabarit->affecterActionParDefaut('index');
            $this->index([]);
        } */
    }

    public function deconnexion()
    {
        unset($_SESSION['utilisateur']);
        Utilitaire::nouvelleRoute('accueil/index');
    }

    public function contacter()
    {
        $this->modele->contacter($_POST['msg_sujet'], $_POST['msg_contenu'], $_SESSION['utilisateur']->uti_id);

        // echo "<script>alert('ok')</script>";
        $to = "testmaisonneuve@gmail.com";
        $subject = $_POST['msg_sujet'];
        $message = $_POST['msg_contenu'];
        $headers = "From: " . $_SESSION['utilisateur']->uti_courriel . "\r\n" . "Content-type: text/html; charset=utf-8" . "\r\n";
        mail($to, $subject, $message, $headers);
        
        Utilitaire::nouvelleRoute('enchere/tout');
    }
}
