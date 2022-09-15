<?php
class ImageControleur extends Controleur
{
     public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        // if(isset($_SESSION['utilisateur'])) {
        //     Utilitaire::nouvelleRoute('enchere/tout');
        // } 
    }

    public function index()
    {
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();

    }

    public function tout()
    {
        $this->gabarit->affecter('images', $this->modele->tout());
    }

    public function nouveau()
    {

    } 

    public function ajouter() {
        /* if (isset($_POST['submit'])) {
        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $query = "INSERT INTO image (img_id, img_principale, img_enc_id_ce) VALUES (NULL, '$fileNameNew', 12345)";
        $result = mysqli_query($conn, $query);
        if(move_uploaded_file($fichier, "ressources/css/accueil/img/$name")) {
            echo "fichier copié";
        } */
        $this->modele->ajouter($_POST);
        Utilitaire::nouvelleRoute('image/nouveau');
    }

    /* public function retirer() {
        $this->modele->retirer($_POST['enc_id']);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    public function changer() {
        $this->modele->changer($_POST);
        Utilitaire::nouvelleRoute('enchere/tout');
    }

    public function changerPrix() {
        $this->modele->changer($_POST);
        Utilitaire::nouvelleRoute('enchere/tout');
    } */
}
