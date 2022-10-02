<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Products;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NoRequiredExtension;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,['label'=>'Nom'])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'tinymce'], 'required'=>false,
            ])
            ->add('photo',FileType::class,['mapped' => false, 'required'=>false,'attr'=>['accept'=>'image/*' , 'class'=>'form-control-file'],'data_class' => null])
            ->add('label')
            ->add('ref')
            ->add('price',null,['label'=>'Prix'])
            ->add('status',ChoiceType::class,[
                'choices' => [
                    'Disponible'=> 1,
                    'Bloqué'=>0
                ],'attr'=>['class'=>'custom-select']
            ])

            ->add('stock',null,['attr'=>['min'=>0]])
            //->add('catprod',null,['label'=>'Catégories','attr'=>['class'=>'custom-select']])

            ->add('emp',null,['label'=>'Employé','attr'=>['class'=>'custom-select']])
//            ->add('catprod', ChoiceType::class, array(
//
//                'choices' => CategoriesRepository::findSousCat()
//            ))
        ->add('catprod', EntityType::class, [
            'class' => Categories::class,
            'query_builder' => function (CategoriesRepository $er) {
                return $er->createQueryBuilder('c')
                    ->andWhere('c.souscat  IS NOT NULL')
                    ->orderBy('c.name', 'ASC');
            },
            'choice_label' => 'name',
                'label'=>'Catégories','attr'=>['class'=>'custom-select']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
