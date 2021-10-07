<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PhotoController extends AbstractController
{
    /**
     * @Route(path="/photo/create", name="photo_create", methods={"GET", "POST"})
     */
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $photo = new Photo();
        $photoform = $this->createForm(PhotoType::class, $photo);
        $photoform->handleRequest($request);

        if ($photoform->isSubmitted()) {
            //Faire qq chose avec les données
            $entityManager->persist($photo);
            $entityManager->flush();

            return $this->redirectToRoute('photo_detail', ['id' => $photo->getId()]);
        }

        return $this->render('photo/create.html.twig', ['photoForm' => $photoform->createView()]);
    }

    /**
     * @Route(path="/photo/delete{id}", requirements={"id":"\d+"}, name="photo_delete", methods={"GET"})
     */
    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $photo= $entityManager->getRepository('App:Photo')->find($request->get('id'));
        $entityManager->remove($photo);
        $entityManager->flush();

        //Message de validation
        $this->addFlash('success', 'Cet élément a bien été retiré de la liste !');
        return $this->redirectToRoute('photo_photolist');
    }

    /**
     * @Route(path="/photo/photolist", name="photo_photolist", methods={"GET"})
     */
    public function photolist(Request $request, EntityManagerInterface $entityManager)
    {
        // Récupération de la page
        $page = $request->get('page', 1);

        // Récupération des souhaits par pagination
        $photos = $entityManager->getRepository('App:Photo')->getPhotosByDQL($page, 10);

        return $this->render('photo/photolist.html.twig', ['photos' => $photos]);
    }

    /**
     * @Route(path="/photo/detail/{id}", requirements={"id":"\d+"}, name="photo_detail", methods={"GET"})
     */
    public function detail(Request $request, EntityManagerInterface $entityManager)
    {
        // Récupération de l'identifiant
        $id = (int)$request->get('id');

        // Récupération du souhait par son id
        $photo = $entityManager->getRepository('App:Photo')->findOneBy(['id' => $id]);
        if (is_null($photo)) {
            throw $this->createNotFoundException('Photo Not Found !');
        }

        return $this->render('photo/detail.html.twig', ['photo' => $photo]);
    }

}