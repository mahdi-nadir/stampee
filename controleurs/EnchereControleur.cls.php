<?php
class EnchereControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        /* if(isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('enchere/tout');
        } */
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index()
    {
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();

    }

    public function tout()
    {
        $this->gabarit->affecter('encheres', $this->modele->tout());
    }

    public function nouveau()
    {

    }

    public function ajouter() {
        // Ajouter la nouvelle catégorie (dont les valeurs sont reçues par POST) dans la BD
        $this->modele->ajouter($_POST, $_SESSION['utilisateur']->uti_id);
        // Rediriger vers l'affichage des catégories
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    public function retirer() {
        $this->modele->retirer($_POST['enc_id']);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    public function changer() {
        $this->modele->changer($_POST);
        Utilitaire::nouvelleRoute('enchere/tout');
    }
}
