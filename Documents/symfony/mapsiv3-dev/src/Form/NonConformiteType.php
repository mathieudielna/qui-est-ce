<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Flux;
use App\Entity\TypeDirection;
use App\Entity\FluxConnectActivite;
use App\Entity\TypeNonConformite;
use App\Entity\NonConformite;

use App\Repository\TypeDirectionRepository;
use App\Repository\FluxRepository;
use App\Repository\ActiviteRepository;
use App\Repository\TypeSeveriteRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class NonConformiteType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('ptattention')
            ->add('severite', EntityType::class, [
                'class' => TypeNonConformite::class,
                'choice_label' => 'designation',
                'expanded' => false,
                'required'   => false,
                'placeholder' => 'Sélectionner',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NonConformite::class,
            'userCustomer' => null,
        ]);
    }
}



