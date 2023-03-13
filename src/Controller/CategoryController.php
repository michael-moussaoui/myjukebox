<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{

    private $entityManager;


    #[Route('/category', name: 'app_category', methods:'GET')]
    public function show(  ManagerRegistry $doctrine): JsonResponse
    {
         
        // on récupère toutes les catégories
        $categories = $doctrine->getRepository(Category::class)->findAll();
        
        $datas = [];
        foreach($categories as $key => $category) {
            $datas[$key]['category'] = $category->getCategory();
            $datas[$key]['picture'] = $category->getPicture();
        }
        
         return new JsonResponse($datas);

        
    }

     #[Route('/category/${categoryId}', name: 'app_categorySong', methods:'GET')]
     
        public function play($categoryId): Response
        {
           
            // Récupère les informations sur la chanson à partir de la base de données
            $categoryById = $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($categoryById);
                
    
            // Vérifier si la chanson existe
            if (!$song) {
                throw $this->createNotFoundException('Musique non trouvée');
            }
             // Récupérer le contenu audio de la chanson
            $audio = $song->getSong();
          
            
            
    
            // Renvoie la vue Twig pour la page de lecture de la chanson
            return $this->render('play/index.html.twig', [
                'song' => $song,
                'audio' => $audio,
                'musics' =>$musics,
    
            ]);
        }
        #[IsGranted('ROLE_USER')]
        #[Route('/favoris', name: 'app_favoris')]
        public function myFavoris():response 
        {
            $user = $this->getUser();
            $favoris = $user->getFavoris();
             return $this->render('favoris/index.html.twig',[
                
                'favoris' => $favoris
                ]
             );
        }

        
     }


    
   


