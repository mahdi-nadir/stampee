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

    public function index()
    {
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();

    }

    public function nouveau()
    {

    }

    public function modification($params)
    {
        $this->gabarit->affecter('ench', $this->modele->un($params[0]));
    }

    public function tout()
    {
        $this->gabarit->affecter('encheres', $this->modele->tout());
    }

    

    public function detail($params)
    {
        $this->gabarit->affecter('enchere', $this->modele->un($params[0]));
    }

    public function ajouter() {
        if (isset($_POST['submit'])) {
            $name = $_FILES['image']['name'];
            $fichier = $_FILES['image']['tmp_name'];
    
            if(move_uploaded_file($fichier, "ressources/css/accueil/immg/$name")) {
                echo "fichier copié";
            }
        }
        
        $this->modele->ajouter($_POST, $_SESSION['utilisateur']->uti_id, $name);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    public function retirer() {
        $sql = $this->modele->retirer($_POST['enc_id']);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    public function changer() {
        if (isset($_POST['submit'])) {
            $name = $_FILES['image']['name'];
            $fichier = $_FILES['image']['tmp_name'];
    
            if(move_uploaded_file($fichier, "ressources/css/accueil/immg/$name")) {
                echo "fichier copié";
            }
        }

        $this->modele->changer($_POST, $name);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    /*public function changerPrix() {
        $this->modele->changer($_POST);
        Utilitaire::nouvelleRoute('enchere/tout');
    } */
}
