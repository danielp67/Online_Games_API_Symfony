<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Games;
use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/game/{id}", name="postComment", methods={"POST"})
     */
    public function postComment(GamesRepository $GamesRepository, $id)
    {
        $request = Request::createFromGlobals();
        $content = $request->getContent();
        $content = json_decode($content);
        $comment = new Comments();
        //$com = $GamesRepository->findBy(['id' =>$id]);
        $game = $this->getDoctrine()->getRepository(Games::class)->find($id);
      
        $entityManager = $this->getDoctrine()->getManager();
        $comment = new Comments();
        $comment->setAuthor($content->author);
        $comment->setComment($content->comment);
        $comment->setRate($content->rate);
        $date = new DateTime($content->createAt);
        $comment->setCreateAt($date);

        $game->addComment($comment);
        // dd($comment);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($comment);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        
        //dd($com);
        return $response = JsonResponse::fromJsonString('{"validation" : "true"}');
    }
}
