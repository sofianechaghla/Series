<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/series",name="serie_")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(SerieRepository $serieRepository): Response
    {
       $series = $serieRepository->findBestSeries();

        return $this->render('serie/list.html.twig', [
            "series" =>$series

        ]);
    }
    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        return $this->render('serie/details.html.twig', [
            "serie" => $serie
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request): Response
    {
        dump($request);
        return $this->render('serie/create.html.twig');
    }

    /**
     * @Route("/demo", name="em-demo")
     */
    public function demo(EntityManagerInterface $entityManager): Response
    {
        //crée uen instance de mon entité
        $serie =new Serie();

        //hydrate toutes les propriétés
        $serie->setName('if');
        $serie->setBackdrop('dfjksh');
        $serie->setPoster('dafsdf');
        $serie->setDateCreated(new \DateTime());
        $serie->setFirstAirDate(new \DateTime("-1year"));
        $serie->setLastAirDate(new  \DateTime("-6 year"));
        $serie->setGenres('drama');
        $serie->setOverview('bla bla bla');
        $serie->setPopularity(123.00);
        $serie->setVote(8.2);
        $serie->setStatus('Canceled');
        $serie->setTmdbId(32942);

        dump($serie);
        $entityManager->persist($serie);
        $entityManager->flush();

        dump($serie);

        $entityManager->remove($serie);

        //$serie->setGenres('comedy');

        $entityManager->flush();
        return $this->render('serie/create.html.twig');
    }
}
