<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Modèle du véhicule',
                'attr' => ['placeholder' => 'Tapez le nom du modèle'],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Courte description',
                'attr' => ['placeholder' => 'Tapez une description courte'],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du véhicule',
                'attr' => ['placeholder' => 'Tapez le prix du véhicule en €'],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'Photo du véhicule',
                'attr' => ['placeholder' => 'Tapez une URL d\'image'],
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                'choice_label' => function (Category $category) {
                    return ($category->getName());
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
