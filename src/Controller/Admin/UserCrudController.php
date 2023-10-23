<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextBlockField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('password')
            ->hideOnIndex()
            ->onlyOnDetail()
            ->setFormTypeOption('disabled', true)
            ->formatValue(function ($value, $entity) {
                //Ici, lorsque le MDP hashé apparait sur le backoffice il est aussi tot remplacé par *******
                return '********';
            });

        yield TextField::new('surname');
        yield TextField::new('name');
        yield TextField::new('username');

    }
}
