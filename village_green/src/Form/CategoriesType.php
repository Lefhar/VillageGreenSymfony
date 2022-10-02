<?php

namespace App\Form;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,['label'=>'Nom'])
            ->add('picture',FileType::class,['label'=>'Photo','mapped' => false, 'required'=>false,'attr'=>['accept'=>'image/*', 'class'=>'form-control-file'],'data_class' => null])
           // ->add('souscat',null,['label'=>'Séléctionner la catégorie parent','attr'=>['class'=>'custom-select']])
            ->add('souscat', EntityType::class, [
                'class' => Categories::class,
                'query_builder' => function (CategoriesRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.souscat  IS NULL')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'label'=>'Catégories','attr'=>['class'=>'custom-select']])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
