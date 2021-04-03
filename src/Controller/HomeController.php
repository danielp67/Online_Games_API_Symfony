<?php

namespace App\Controller;

use App\Repository\GamesRepository;
use App\Repository\StudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home", methods={"GET"})
     */
    public function getGames(GamesRepository $gamesRepository): JsonResponse
    {   
        $data = $gamesRepository->findAll();

        return $this->json($data);
    }
}
