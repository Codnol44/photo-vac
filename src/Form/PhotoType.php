<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Pays;
use App\Entity\Photo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title', 'required' => false])
            ->add('description', TextType::class, ['label' => 'Description'])
            ->add('pays', EntityType::class,
                [
                    'class' => Pays::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c');
                    },
                    'choice_label' => 'name',
                ])
            ->add('year', IntegerType::class, ['label' => 'Year', 'required' => false])
            ->add('photo', TextType::class, ['label' => 'Photo', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
