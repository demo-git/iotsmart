<?php
/**
 * Created by PhpStorm.
 * User: jérémy
 * Date: 15/11/2016
 * Time: 20:03
 */

namespace FrontBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserConnectedObjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options["data"]->getTokenData() == null) {
            $builder->add('connectedObject', EntityType::class, array(
                'class' => 'FrontBundle:ConnectedObject',
                'choice_label' => 'name',
            ));
        }
        $builder->add('connectionString');

    }

    public function getBlockPrefix()
    {
        return 'front_user_connected_object_new';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}