<?php

namespace App\Controller;

use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game/{id}", name="getGame", methods={"GET","HEAD"})
     */
    public function getGame(GamesRepository $GamesRepository,CommentsRepository $CommentsRepository, $id)
    {
        $game = $GamesRepository->findBy(['id' =>$id]);

        $comments = $CommentsRepository->findBy(['gameId' =>$id]);

        $data =array('game'=>$game,'comments'=> $comments);
        return $this->json($data);
    }

    /**
     * @Route("/games/{id}", name="getGames", methods={"GET","HEAD"})
     */
    public function getGames(CommentsRepository $CommentsRepository, $id)
    {
        $data = $CommentsRepository->findBy(['gameId' =>$id]);

        return $this->json($data);
    }
}
