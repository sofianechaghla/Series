<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home ()
    {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route("/test", name="main_test")
     */
    public function test()
    {
        $serie = [
          "title" => "<h1>Game of Thrones</h1><script>window.location.href = 'https://lingscars.com'</script>",
          "year" => 2000,
        ];

        return $this->render('main/test.html.twig', [
            "mySerie" => $serie,
            "autreVar" => 412412
        ]);
    }
}



