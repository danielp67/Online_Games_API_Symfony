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
     * @Route("/comment/{id}", name="getComment", methods={"GET"})
     */
    public function getComment(CommentsRepository $commentsRepository, $id): JsonResponse
    {
        $comment = $commentsRepository->findBy(['id' =>$id]);

        return $this->json($comment);
    }

    /**
     * @Route("/comment/new/{gameId}", name="addComment", methods={"POST"})
     */
    public function addComment(GamesRepository $gamesRepository, $gameId): JsonResponse
    {
        $request = Request::createFromGlobals();
        $content = $request->getContent();
        $content = json_decode($content);
        $game = $gamesRepository->find($gameId);

        $entityManager = $this->getDoctrine()->getManager();
        $comment = new Comments();
        $comment->setAuthor($content->author);
        $comment->setComment($content->comment);
        $comment->setRate(floatval($content->rate));
        $date = new DateTime($content->createAt);
        $comment->setCreateAt($date);

        $game->addComment($comment);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($comment);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        return $response = JsonResponse::fromJsonString('{"post" : "true"}');
    }




    /**
     * @Route("/comment/{id}", name="updateComment", methods={"PUT"})
     */
    public function updateComment(CommentsRepository $commentsRepository, $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $commentsRepository->find($id);

        if (!$comment) {
            throw $this->createNotFoundException(
                'No comment found for id '.$id
            );
        }
        
        $request = Request::createFromGlobals();
        $content = $request->getContent();
        $content = json_decode($content);

        $comment->setComment($content->comment);
        $comment->setRate($content->rate);
        $entityManager->persist($comment);
        $entityManager->flush();
    
       return $response = JsonResponse::fromJsonString('{"update" : "true"}');
    }

    /**
     * @Route("/comment/{id}", name="deleteComment", methods={"DELETE"})
     */
    public function deleteComment(CommentsRepository $commentsRepository, $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $commentsRepository->find($id);

        $entityManager->remove($comment);
        $entityManager->flush();

        return $response = JsonResponse::fromJsonString('{"delete" : "true"}');
    }


}
