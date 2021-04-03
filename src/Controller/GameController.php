<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Games;
use App\Entity\Studio;
use App\Repository\CategoryRepository;
use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
use App\Repository\StudioRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game/{id}", name="getGame", methods={"GET"})
     */
    public function getGame(GamesRepository $GamesRepository,CommentsRepository $CommentsRepository, $id): JsonResponse
    {
        $game = $GamesRepository->findBy(['id' =>$id]);

        $comments = $CommentsRepository->findBy(['gameId' =>$id]);

        $data =array('game'=>$game,'comments'=> $comments);
        return $this->json($data);
    }

    /**
     * @Route("/game/img/{id}", name="getImgGame", methods={"GET"})
     */
    public function getImgGame(GamesRepository $GamesRepository, $id): Response
    {
        $game = $GamesRepository->find($id);
        $img = $game->getImg();

        $theImage = 'C:/wamp64/www/tp14_api_symfony/data/img/'.$img;
        $response = new Response();
        $response->headers->set('content-type','image/png');
        $response->setContent(file_get_contents($theImage));
        return $response;
    }

    /**
     * @Route("/game/new", name="addGames", methods={"POST"})
     */
    public function addGame(GamesRepository $gamesRepository,
                            StudioRepository $studioRepository,
                            CategoryRepository $categoryRepository): Response
    {
        $request = Request::createFromGlobals();
        
        $content = $request->request->get('data');
        $content = json_decode($content);

        $game = new Games();

        $studio = $studioRepository->find($content->studioId);
        $game->setStudioId($studio);

        for($i = 0; $i < sizeof($content->category); $i++){

            $category = $categoryRepository->find($content->category[$i]);
            $game->addCategoryId($category);
        }

       $entityManager = $this->getDoctrine()->getManager();

        $game->setName($content->name);
        $game->setReleaseAt($content->releaseAt);
        $game->setPlateformes($content->plateformes);
        $game->setCopiesSold($content->copiesSold);
        $game->setRank($content->rank);
        $game->setRate($content->rate);
       

        $file = $request->files->get('file');
        $date = new DateTime();
        $new = $date->getTimestamp();
        $fileName = $new.'.'.$file->guessExtension();
        $file->move('C:/wamp64/www/tp14_api_symfony/data/img', $fileName);

        $game->setImg($fileName);
        
        $entityManager->persist($game);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $response = new Response();
        $response->headers->set('content-type','text/html');
        $response->setContent($this->json($content));

        return $response;
    }



}