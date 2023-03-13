<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\Category;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MusicController extends AbstractController
{
    #[Route('/music/{id}', name: 'app_music')]
    public function addFavoriteMusic(int $id, Music $music, Request $request): Response
    {

        // Récupération des données de la musique avec l'ID `id`
        // $id = $request->query->get('id');
        // $music = $this->getDoctrine()->getRepository(Music::class)->find($id);
        $music = $this->getDoctrine()->getRepository(Music::class)->find($id);
       
        // Vérifiez si la musique existe
        if (!$music) {
        throw $this->createNotFoundException('La musique n\'existe pas');
        }

        // Récupérez l'utilisateur connecté
        $user = $this->getUser();
        

        // Ajoutez la musique aux favoris de l'utilisateur
        // $user->addFavorite($favorite);

        // Enregistrez les changements dans la base de données
        // $this->getDoctrine()->getManager()->flush();

        

        //  return $response;
        return $this->render('music/index.html.twig', [
           
         ]);

        
    }

    #[Route('/categories', name: 'app_categories')]
    public function getAllCategories(): response
    {

       
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
       
       return $this->json($categories);

    }
    #[Route('/music/category/{categoryId}', name: 'app_music_by_category')]
    public function index($categoryId, EntityManagerInterface $entityManager, SerializerInterface $serializer)
{
    $musicRepository = $entityManager->getRepository(Music::class);
    $musics = $musicRepository->findBy(['category' => $categoryId]);
    $json = $serializer->serialize($musics,'json',['groups'=>'music:read']);
    //  dd($json);
    
    $response = new Response($json, 200, [
        "Content-Type" =>"application/json"
    ]);
    dd($response);
    
    return $response;
}


// #[Route('/music/category/{categoryId}', name: 'app_music_by_category')]
//     public function index($categoryId, MusicRepository $musicRepository): JsonResponse
//     {
//         $musics = $musicRepository->findBy(['category' => $categoryId]);
//         // dd($musics);

//         $musicsData = [];

//         foreach ($musics as $music) {
//         $musicsData[] = [
//                 'id' => $music->getId(),
//                 'titre' => $music->getTitle(),
//                 'artiste' => $music->getArtist(),
//                 'song'=>$music->getSong(),
//                 'categorie' => $music->getCategory()->getCategory(),
//             ];
//         }
//          dd($musicsData);

//         return new JsonResponse($musicsData);
//     }
    

}

  




