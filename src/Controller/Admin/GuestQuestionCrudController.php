<?php

namespace App\Controller\Admin;

use Symfony\Component\VarDumper\VarDumper;
use App\Entity\User;
use App\Entity\GuestQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GuestQuestionCrudController extends AbstractCrudController
{


    //Methode permettant d'associer le contrôleur à l'entité 
    // correspondante et de gérer les opérations CRUD pour cette entité.
    public static function getEntityFqcn(): string
    {
        return GuestQuestion::class;
    }

    //Methode de configuration des champs
    public function configureFields(string $pageName): iterable
    {

        // Cette premiere configuration de champ utilise AssociationFiel pour associer deux entités entre elle afin de recuperer les propriétés Name et Surname
        yield AssociationField::new('user')->formatValue(function ($value, $entity) {
            if ($entity instanceof GuestQuestion) {
                $user = $entity->getUser();

                if ($user instanceof User) {
                    // Récupére le nom de famille et prenom de l'utilisateur
                    $surname = $user->getSurname();
                    $name = $user->getName();

                    // Concaténe le nom de famille et le prénom
                    $fullName = $surname . ' ' . $name;

                    // Retourne le nom complet à afficher
                    return $fullName;
                }
            }

            // Valeur par défaut si la valeur n'est pas valide
            return '';
        });

        yield IntegerField::new('pax');
        yield IntegerField::new('night');
        yield TextareaField::new('allergie');
        yield TextareaField::new('regime');
    }
}
