<?php

namespace App\Form;

use App\Data\FilterData;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterAgencyCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('agency', CheckboxType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('company', CheckboxType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('categories', EntityType::class, [
                'choice_label' => 'label',
                'class' => Category::class,
                'label' => false,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'categoryForm'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterData::class,
            'method' =>  'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
