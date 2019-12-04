<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ArtistRepository $artistRepository){
        // Récupérer toutes les entités
        $resultats = $artistRepository->findDjs();

        dd($resultats);

        return $this->render('index.html.twig');
    }
}
