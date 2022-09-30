<?php
class AccueilModele extends AccesBd
{

    /**
     * affichage des enchères
     *
     * @return void
     */
    public function tout()
    {
        return $this->lireTout('SELECT * 
                                FROM enchere
                                JOIN timbre 
                                ON enc_id = tim_enc_id_ce
                                JOIN `image`
                                ON img_tim_id_ce = tim_id
                                GROUP BY enc_id
                                ORDER BY enc_dateFin
                            ');
    }
}