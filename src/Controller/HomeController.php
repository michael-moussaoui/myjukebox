<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\Category;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController


{

    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine ): Response
    {
        // on récupère toutes les catégories
        $categories = $doctrine->getRepository(Category::class)->findAll();
        // on récupère toutes les musiques
        $musics = $doctrine->getRepository(Music::class)->findAll();

        $funkMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'funk musique']);
        $zoukMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'zouk musique']);
        $discoMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'disco musique']);
        $rockMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'rock musique']);
        $reggaeMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'reggae musique']);
        $popMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'pop musique']);
        $hipHopMusics = $doctrine->getRepository(Music::class)->findBy(['genre' => 'hip-hop musique']);
       

        

        

        return $this->render('home/index.html.twig',[
             'categories' => $categories,
             'musics' => $musics,
             'funkMusics' => $funkMusics,
             'discoMusics' => $discoMusics,
             'rockMusics' => $rockMusics,
             'reggaeMusics' => $reggaeMusics,
             'popMusics' => $popMusics,
             'hipHopMusics' => $hipHopMusics,
            
        ]);
    }


    #[Route('/play/{songId}', name: 'app_play')]

    public function play($songId): Response
    {
         // on récupère toutes les musiques
         $musics = $this->getDoctrine()
         ->getRepository(Music::class)
         ->findAll();
           //dd($musics);

        // Récupère les informations sur la chanson à partir de la base de données
        $song = $this->getDoctrine()
            ->getRepository(Music::class)
            ->find($songId);
                //dd($song);

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
  

 
     
    #[Route('/favoris/ add/{id}', name: 'add_favoris')]
    public function ajoutFavoris(Music $music):response
    {
        if(!$music){
            throw new NotFoundHttpException('Pas d\'musique trouvée');
        }
        $music->addFavori($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($music);
        $em->flush();
        return $this->redirectToRoute('app_home');
        
    }

    /**
     * @Route("/favoris/retrait/{id}", name="retrait_favoris")
     */
    #[Route('/favoris/ remove/{id}', name: 'remove_favoris')]
    public function retraitFavoris(Music $music):response
    {
        if(!$music){
            throw new NotFoundHttpException('Pas d\'annonce trouvée');
        }
        $music->removeFavori($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($music);
        $em->flush();
        return $this->redirectToRoute('app_home');
        // return new response;
    }

  


}
