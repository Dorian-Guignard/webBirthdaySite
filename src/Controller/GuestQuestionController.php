<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\GuestQuestion;
use App\Form\GuestQuestionType;
use App\Services\UserDataCheckService;
use App\Services\AuthenticationService;
use App\Services\FormValidationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GuestQuestionController extends AbstractController
{
    /**
     * @Route("/guest/question", name="app_guest_question")
     * 
     */
    public function index(FormValidationService $formValidationService, Security $security, Request $request, AuthenticationService $authenticationService, EntityManagerInterface $entityManager, UserDataCheckService $userDataCheckService): Response
    {

        // Empèche un utilisateur de se connecter au formulaire si des données du formulaire sont présentes en BDD
        if ($userDataCheckService->hasUserData()) {

            return $this->redirectToRoute('app_user');
        }

        //Utilise le service AuthenticationService pour verifier si un utilisateur est connecté
        $isAuthenticated = $authenticationService->isAuthenticated();

        //Création d'une nouvelle instance de la classe GuestQuestion
        $guestQuestion = new GuestQuestion();

        // Cette ligne récupère l'utilisateur connecté à partir du service Security et le stocke dans la variable $user
        $user = $security->getUser();

        //Ceci récupére l'identifiant de l'utilisateur connecté
        $userConnected = $user->getUserIdentifier();

        //Cette ligne associe l'utilisateur connecté à l'objet $guestQuestion en utilisant la méthode setUser()
        $guestQuestion->setUser($user);

        //Cette ligne récupère l'objet User associé à la question d'invité en utilisant la méthode getUser().
        $userObject = $guestQuestion->getUser();

        //mise à jour du nom d'utilisateur de l'objet User avec la valeur de $userConnected. Cela modifie le nom d'utilisateur de l'utilisateur associé à la question d'invité.
        $userUpdateUsername = $userObject->setUsername($userConnected);

        //création du formulaire à partir de la classe GuestQuestionType et de l'objet $guestQuestion. Le formulaire sera utilisé pour la saisie des données dans la vue.
        $form = $this->createForm(GuestQuestionType::class, $guestQuestion);

        //Cette ligne traite la requête HTTP en utilisant le formulaire. Elle relie les données soumises dans la requête aux champs du formulaire.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement des données du formulaire

            //Persist et Flush les données
            $entityManager->persist($guestQuestion, $userUpdateUsername);
            $entityManager->flush();

            //Cette méthode vérifie si le formulaire a été soumis et est valide. Elle renvoie true si c'est le cas, sinon elle renvoie false. Le résultat est stocké dans la variable $isFormSubmittedAndValid.
            $isFormSubmittedAndValid = $formValidationService->isFormSubmittedAndValid($form);

            // Redirigez vers une autre page après la soumission du formulaire
            return $this->redirectToRoute('app_user', ['isFormSubmittedAndValid' => $isFormSubmittedAndValid,]);
        }


        return $this->render('guest_question/index.html.twig', [
            'controller_name' => 'GuestQuestionController',
            'username' => $userConnected,
            'isAuthenticated' => $isAuthenticated,
            'form' => $form->createView()

        ]);
    }
}
