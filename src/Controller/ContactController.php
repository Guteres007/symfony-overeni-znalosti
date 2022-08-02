<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index")
     */
    public function index(Request $request, ContactRepository $contactRepository): Response
    {
        //vytváření formuláře a zachycení requestu
       $form = $this->createForm(ContactType::class);
       $form->handleRequest($request);
        // pokud bude form request tak se ověří validace
       if ($form->isSubmitted() && $form->isValid() ) {
           // uloží se formuláře pomocí repa
           $contactRepository->add($form->getData());
          return  $this->redirectToRoute('contact_index');
       }
       $contacts =  $contactRepository->findAll();
       return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'contacts' => $contacts
        ]);
    }

     /**
     * @Route("/{name}", name="contact_show")
     */
    public function show(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
