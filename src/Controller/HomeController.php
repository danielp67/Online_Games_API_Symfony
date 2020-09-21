<?php

namespace App\Controller;

use App\Repository\GamesRepository;
use App\Repository\StudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function getGames(GamesRepository $GamesRepository)
    {   
        $data = $GamesRepository->findAll();

        return $this->json($data);
    }
}
