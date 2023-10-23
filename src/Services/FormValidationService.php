<?php
// src/Services/FormValidationService.php

namespace App\Services;

use Symfony\Component\Form\FormInterface;

class FormValidationService
{
    public function isFormSubmittedAndValid(FormInterface $form): bool
    {
        return $form->isSubmitted() && $form->isValid();
    }
}
