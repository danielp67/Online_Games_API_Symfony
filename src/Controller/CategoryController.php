<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function getCategories(CategoryRepository $CategoryRepository)
    {   
        $data = $CategoryRepository->findAll();
        
        return $this->json($data);
    }

        /**
     * @Route("/category/{id}", name="selectedCategory")
     */
    public function getCategory(CategoryRepository $CategoryRepository, $id)
    {   
        //$game = $GamesRepository->findBy(['category_id' =>$id]);

        $game = $this->getDoctrine()->getRepository(Category::class)->find($id);
      
      //  dd($game->getGames());
        return $this->json($game->getGames());
    }

    
}
