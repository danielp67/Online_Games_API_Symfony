<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Games;
use App\Entity\Studio;
use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
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
        $theImage = 'C:/wamp64/www/tp14_symphony_cli/data/img/'.$img;
        $response = new Response();
        $response->headers->set('content-type','image/png');
        $response->setContent(file_get_contents($theImage));
        return $response;
    }


    /**
     * @Route("/game/new", name="addGames", methods={"POST"})
     */
    public function addGame(GamesRepository $GamesRepository)
    {
        $request = Request::createFromGlobals();
        
        $content = $request->request->get('data');
       // $content = $request->getContent();
        $content = json_decode($content);

        $game = new Games();
        $game->setName($content->name);

        $studio = $this->getDoctrine()->getRepository(Studio::class)->find($content->studioId);
        $game->setStudioId($studio);

        for($i = 0; $i < sizeof($content->category); $i++){

            $category = $this->getDoctrine()->getRepository(Category::class)->find($content->category[$i]);
            $game->addCategoryId($category);
        }

       $entityManager = $this->getDoctrine()->getManager();

       // $game->setName($request->request->get('name'));
        $game->setReleaseAt($content->releaseAt);
        $game->setPlateformes($content->plateformes);
        $game->setCopiesSold($content->copiesSold);
        $game->setRank($content->rank);
        $game->setRate($content->rate);
       
       // dd($game);

        $file = $request->files->get('file');
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $date = new DateTime();
        $new = $date->getTimestamp();
        $fileName = $new.'.'.$file->guessExtension();
        $file->move('C:/wamp64/www/tp14_symphony_cli/data/img', $fileName);

        $game->setImg($fileName);
        
        $entityManager->persist($game);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $response = new Response();
        //$response->headers->set('content-type','image/png');

        $response->headers->set('content-type','text/html');
       // $response->setContent(file_get_contents($request->files->get('file')));
        $response->setContent($this->json($content));

        return $response;
    }



}


/*

{
"name": "Red Dead Redemption II",
"img": "C:/fakepath/dropzone.jpg",
"plateformes": "PlayStation 4, Xbox One, Microsoft Windows",
"releaseAt": 2018,
"copiesSold": "32 millions",
"rank": 10,
"rate": 5,
"studioId": 5,
"category": "Aventure"
}
*/