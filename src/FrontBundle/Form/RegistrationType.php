<?php
/**
 * Created by PhpStorm.
 * User: jérémy
 * Date: 15/11/2016
 * Time: 20:03
 */

namespace FrontBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastName', null, array('label'=>'Nom'));
        $builder->add('firstName', null, array('label'=>'Prénom'));
    }

    public function getParent()
    {
        return RegistrationFormType::class;
    }

    public function getBlockPrefix()
    {
        return 'front_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}