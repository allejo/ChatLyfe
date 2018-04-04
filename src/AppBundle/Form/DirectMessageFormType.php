<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectMessageFormType extends MessageFormType
{
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\DirectMessage'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_direct_message_form_type';
    }
}
