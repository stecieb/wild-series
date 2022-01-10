<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Entity\Program;

/**
* @Route("/category", name="category_")
*/

class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
             ->getRepository(Category::class)
             ->findAll();

         return $this->render(
             'category/index.html.twig',
            ['categories' => $categories]
         );
     }

    /**
    * Getting a category by id
    *
    * @Route("/show/{categoryName}", name="show")
    * @return Response
    */
    public function show(int $id):Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['id' => $id]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : '.$id.' found in category\'s table.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}
