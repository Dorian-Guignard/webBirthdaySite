<?php

namespace App\Controller;

use App\Entity\Photos;
use Symfony\Component\Finder\Finder;
use App\Services\AuthenticationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\UserDataCheckService;

class PhotosController extends AbstractController
{
    /**
     * @Route("/photos", name="app_photos")
     */
    public function photos(UserDataCheckService $hasUserData, Request $request, EntityManagerInterface $entityManager, AuthenticationService $authenticationService, SluggerInterface $slugger): Response
    {
        $isAuthenticated = $authenticationService->isAuthenticated();
        $photoRepository = $entityManager->getRepository(Photos::class);
        // Récupére le fichier téléchargé à partir de la requête
        $file = $request->files->get('file');
        $photoName = $request->request->get('photoName');
        $latestPhoto = $photoRepository->findOneBy(['photoName' => $photoName], ['id' => 'DESC']);
        // Vérifie si un fichier a été téléchargé
        if ($file instanceof UploadedFile) {


            // Déplace le fichier vers le répertoire de destination
            $uploadsDirectory = $this->getParameter('uploads_directory');
            $fileName = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->guessExtension();
            $file->move($uploadsDirectory, $fileName);


            // Création d'une nouvelle instance de l'entité Photo
            $photo = new Photos();

            // Récupére l'utilisateur actuellement connecté (supposons que vous utilisez le composant Security de Symfony)
            $user = $this->getUser();


            // Défini les propriétés de l'entité Photo
            $photo->setFileName($fileName);
            $photo->setUser($user);
            $photo->setPhotoName($photoName);

            // Enregistre l'entité Photo en base de données
            $entityManager->persist($photo);
            $entityManager->flush();

            // Affiche un message de succès à l'utilisateur
            $this->addFlash('success', 'Le fichier a été téléchargé avec succès.');

            // Redirige vers la page photo
            return $this->redirectToRoute('app_photos');
        }
        $uploadsDirectory = $this->getParameter('uploads_directory');
        $finder = new Finder();
        $finder->files()->in($uploadsDirectory);
        $images = [];
        foreach ($finder as $file) {
            $images[] = $file->getFilename();
        }
        $images = array_reverse($images);
        // Si aucun fichier n'a été téléchargé ou s'il y a une erreur, afficher un message d'erreur
        $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier.');


        dump($latestPhoto);
        dump($_POST);
        // Rediriger ou afficher un message d'erreur à l'utilisateur
        return $this->render('photos/index.html.twig', [
            'images' => $images,
            'controller_name' => 'PhotosController',
            'isAuthenticated' => $isAuthenticated,
            'photoName' => $latestPhoto,
            'hasUserData' => $hasUserData->hasUserData(),
            'successMessage' => 'Le fichier a été téléchargé avec succès.',

        ]);
    }


    /**
     * @Route("/photos/delete/{id}", name="app_delete_photo", methods={"DELETE"})
     */
    public function deletePhoto($id, Photos $photo, EntityManagerInterface $entityManager, AuthenticationService $authenticationService): Response
    {
        // Récupérez la photo à supprimer en fonction de son ID
        $photo = $entityManager->getRepository(Photos::class)->find($id);

        if (!$photo) {
            throw $this->createNotFoundException('La photo n\'existe pas.');
        }

        // Supprimez la photo
        $entityManager->remove($photo);
        $entityManager->flush();

        // Ajoutez un message flash pour indiquer que la suppression a réussi
        $this->addFlash('success', 'La photo a été supprimée avec succès.');

        // Redirigez l'utilisateur vers la liste des photos ou toute autre page appropriée
        return $this->redirectToRoute('app_photos');
    }
}