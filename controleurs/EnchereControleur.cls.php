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
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();
    }
    
    /**
     * tout: affiche la liste des enchères
     *
     * @return void
     */
    public function tout()
    {
        $this->gabarit->affecter('encheres', $this->modele->tout());
    }
    
    /**
     * detail: affiche une enchère
     *
     * @param  mixed $enc_id
     * @return void
     */
    public function detail($params)
    {
        $this->gabarit->affecter('enchere', $this->modele->un($params[0]));
        $this->gabarit->affecter('enchGagnant', $this->modele->enchGagnant($params[0]));
        if (isset($_SESSION['utilisateur'])) {
            $this->gabarit->affecter('favori', $this->modele->getFavori($params[0], $_SESSION['utilisateur']->uti_id));
        }
    }

        
    /**
     * nouveau: affiche le formulaire de création d'une enchère
     *
     * @return void
     */
    public function nouveau()
    {
    }

    
    /**
     * mise: affiche le formulaire de la mise pour une enchère
     *
     * @param  mixed $params
     * @return void
     */
    public function mise($params)
    {
        // $this->gabarit->affecter('mises', $this->modele->mise($params[0]));
        $this->gabarit->affecter('enchere', $this->modele->un($params[0]));
    }

        
    /**
     * modification: affiche le formulaire de modification d'une enchère
     *
     * @param  mixed $params
     * @return void
     */
    public function modification($params)
    {
        $this->gabarit->affecter('ench', $this->modele->un($params[0]));
    }
    
    /**
     * favoris: affiche la liste des enchères favoris d'un utilisateur
     *
     * @return void
     */
    public function favoris()
    {
        $this->gabarit->affecter('favoris', $this->modele->getAllFavoris($_SESSION['utilisateur']->uti_id));
    }

    public function listemises()
    {
        $this->gabarit->affecter('mises', $this->modele->mise($_POST['enc_id']));
        $this->gabarit->affecter('enchere', $this->modele->un($_POST['enc_id']));
    }





    /*
    * ****************************************************************************************
    * ************************************  actions  **************************************
    * ****************************************************************************************
    */





    /**
     * ajouter: ajoute une enchère
     *
     * @return void
     */
    public function ajouter() {
        if (isset($_POST['submitNv'])) {
            $name = $_FILES['image']['name'];
            $fichier = $_FILES['image']['tmp_name'];
    
            if(move_uploaded_file($fichier, "ressources/css/accueil/immg/$name")) {
                echo "fichier copié";
            }
        }
        
        $this->modele->ajouter($_POST, $_SESSION['utilisateur']->uti_id, $name);
        Utilitaire::nouvelleRoute('enchere/tout');
    }


    /**
     * retirer: supprime une enchère
     *
     * @param  mixed $params
     * @return void
     */
    public function retirer() {
        $sql = $this->modele->retirer($_POST['enc_id']);
        Utilitaire::nouvelleRoute('enchere/tout');
    }


    /**
     * modifier: modifie une enchère
     *
     * @param  mixed $params
     * @return void
     */
    public function changer() {
        if (isset($_POST['submitNv'])) {
            $name = $_FILES['image']['name'];
            $fichier = $_FILES['image']['tmp_name'];
    
            if(move_uploaded_file($fichier, "ressources/css/accueil/immg/$name")) {
                echo "fichier copié";
            }
        }

        $this->modele->changer($_POST, $name);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    /**
     * addMise: ajoute une mise
     *
     * @param  mixed $params
     * @return void
     */
    public function addMise() {
        $this->modele->addMise($_POST['enc_id'], $_POST['mise'], $_SESSION['utilisateur']->uti_id);
        Utilitaire::nouvelleRoute('enchere/tout');
}


    /**
     * addFavori: ajoute une enchère aux favoris
     *
     * @param  mixed $params
     * @return void
     */
    public function addFavori() {
        $this->modele->addFavori($_POST['enc_id'], $_SESSION['utilisateur']->uti_id);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    /**
     * delFavori: supprime une enchère des favoris
     *
     * @param  mixed $params
     * @return void
     */
    public function delFavori() {
        $this->modele->delFavori($_POST['enc_id'], $_SESSION['utilisateur']->uti_id);
        Utilitaire::nouvelleRoute("enchere/tout");
    }
}
