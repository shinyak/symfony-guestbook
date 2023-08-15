<?php

namespace App\Controller;

use App\Form\HogeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SampleController extends AbstractController
{
    #[Route('/sample', name: 'app_sample')]
    public function index(Request $request): Response
    {
        $hoge_form = $this->createForm(HogeType::class);
        $hoge_form->handleRequest($request);

        return $this->render('sample/index.html.twig', [
            'controller_name' => 'SampleController',
            'hoge_form' => $hoge_form,
            'post_data' => $request->request->all()
        ]);
    }
}
