<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artist", name="artist_")
 */
class ArtistController extends AbstractController{
    /**
     * @Route("-list", name="list")
     */
    public function index(){
        return $this->render('artists/list.html.twig');
    }
}
