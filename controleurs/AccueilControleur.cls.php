<?php
class AccueilControleur extends Controleur
{
    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        /* if(isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('enchere/tout');
        } */
    }

    /*
    * ****************************************************************************************
    * ************************************  affichage  **************************************
    * ****************************************************************************************
    */
    
    /**
     * index: affiche la liste des enchères
     *
     * @return void
     */
    public function index()
    {
        $this->gabarit->affecter('encheres', $this->modele->tout());
    }
}
