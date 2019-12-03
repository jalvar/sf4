<?php

namespace App\Controller;

use App\Entity\Artist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    /**
     * @Route("/", name="homepage")
     */
    public function index(EntityManagerInterface $em){
        $artist = (new Artist())
            ->setName('Francois')
            ->setDescription('Description');

        $em->persist($artist);
        //$em->remove($);
        //$em->flush();

        return $this->render('index.html.twig');
    }
}
