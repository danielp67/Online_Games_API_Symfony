<?php

namespace App\Controller;

use App\Entity\Games;
use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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


    /**
     * @Route("/game/img/{id}", name="getImgGame", methods={"GET","HEAD"})
     */
    public function getImgGame(GamesRepository $GamesRepository, $id)
    {
        $data = $this->getDoctrine()->getRepository(Games::class)->find($id);
        $img = $data->getImg();
        $theImage = 'C:/wamp64/www/tp14_symphony_cli/data/'.$img;
        $response = new Response();
        $response->headers->set('content-type','image/png');
        $response->setContent(file_get_contents($theImage));
        return $response;
    }
}
