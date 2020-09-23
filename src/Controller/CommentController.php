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
     * @Route("/comment/add/{id}", name="addComment", methods={"POST"})
     */
    public function addComment(GamesRepository $GamesRepository, $id)
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


     /**
     * @Route("/comment/delete/{id}", name="deleteComment", methods={"DELETE"})
     */
    public function deleteComment(CommentsRepository $CommentsRepository, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $this->getDoctrine()->getRepository(Comments::class)->find($id);

        $entityManager->remove($comment);
        $entityManager->flush();

       return $response = JsonResponse::fromJsonString('{"add" : "true"}');
    }

    /**
     * @Route("/comment/update/{id}", name="updateComment", methods={"POST"})
     */
    public function updateComment(CommentsRepository $CommentsRepository, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $this->getDoctrine()->getRepository(Comments::class)->find($id);

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

        $entityManager->flush();
    
       return $response = JsonResponse::fromJsonString('{"update" : "true"}');
    }

    /**
     * @Route("/comment/get/{id}", name="getComment", methods={"GET","HEAD"})
     */
    public function getComment(CommentsRepository $CommentsRepository, $id)
    {
        $data = $CommentsRepository->findBy(['id' =>$id]);

        return $this->json($data);
    }








}
