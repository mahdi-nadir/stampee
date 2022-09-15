<?php
class TimbreControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        /* if(isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('timbre/un');
        } */
    }

    public function index()
    {
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();
    }

    public function un()
    {
        /* $this->gabarit->affecter('timbre', $this->modele->un($_GET['id'])); */
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    /* public function index()
    {
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();

    } */

    /* public function tout()
    {
        $this->gabarit->affecter('timbres', $this->modele->tout());
        // Nous avons aussi besoin des catégories...
        $this->gabarit->affecter('encheres', $this->modele->toutesCategories());
    }

    public function ajouter() {
        // Ajouter le nouveau plat (dont les valeurs sont reçues par POST) dans la BD
        $this->modele->ajouter($_POST);
        // Rediriger vers l'affichage des plats
        Utilitaire::nouvelleRoute('timbre/tout');
    }

    public function retirer() {
        $this->modele->retirer($_POST['pla_id']);
        Utilitaire::nouvelleRoute('timbre/tout');
    }

    public function changer() {
        $this->modele->changer($_POST);
        Utilitaire::nouvelleRoute('timbre/tout');
    } */
}
