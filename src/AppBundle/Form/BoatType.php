<?php

namespace AppBundle\Form;

use AppBundle\Entity\Boat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('boatId', TextType::class)
            ->add('name', TextType::class)
            ->add('price', TextType::class)
            ->add('guests', TextType::class)
            ->add('cabins', TextType::class)
            ->add('bathrooms', TextType::class)
            ->add('length', TextType::class)
            ->add('about', TextType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Boat::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boat';
    }
}