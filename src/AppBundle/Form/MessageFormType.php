<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'attr' => [
                    'placeholder' => 'Send a message',
                ],
                'label_attr' => [
                    'class' => 'sr-only',
                ],
            ])
            ->add('send', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', [
                'label' => 'Send'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Message'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_message_form_type';
    }
}
