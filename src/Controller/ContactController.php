<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepositoryInterface;
use Flasher\Prime\FlasherInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index")
     */
    public function index(
        Request $request,
        ContactRepositoryInterface $contactRepository,
        PaginatorInterface $paginator,
        FlasherInterface $flasher
    ): Response {
        //vytváření formuláře a zachycení requestu
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        // pokud bude form request tak se ověří validace
        if ($form->isSubmitted() && $form->isValid()) {
            // uloží se formuláře pomocí repa
            $contactRepository->add($form->getData());
            $flasher->addSuccess('Přidáno');
            return $this->redirectToRoute('contact_index');
        }
        //Vytvořím paginaci
        $query = $contactRepository->getPaginate();
        $contacts = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render(
            'contact/index.html.twig',
            [
                'form'     => $form->createView(),
                'contacts' => $contacts
            ]
        );
    }

    /**
     * @Route("/{last_name}", name="contact_edit")
     */
    public function edit(Contact $contact, Request $request, ContactRepositoryInterface $contactRepository, FlasherInterface $flasher): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        // pokud bude form request tak se ověří validace
        if ($form->isSubmitted() && $form->isValid()) {
            // uloží se formuláře pomocí repa
            $contactRepository->edit($form->getData());
            $flasher->addSuccess('Editováno');
            return $this->redirectToRoute('contact_index');
        }
        return $this->render(
            'contact/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Contact $contact
     * @param ContactRepositoryInterface $contactRepository
     * @return RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @Route("/contact/{id}/remove", name="contact_remove")
     */
    public function remove(Contact $contact , ContactRepositoryInterface $contactRepository, FlasherInterface $flasher): RedirectResponse
    {
        $contactRepository->remove($contact);
        $flasher->addSuccess('Smazáno');
        return $this->redirectToRoute('contact_index');
    }


}
