<?php

namespace App\Form;

use App\Entity\Tier;
use App\Entity\TypeTier;
use App\Entity\TypeScore;
use App\Entity\People;
use App\Repository\PeopleRepository;


use App\Repository\TypeTierRepository;
use App\Repository\TypeScoreRepository;

use App\Form\EventListener\AddEntityChoiceSubscriber;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class TierType extends AbstractType
{
	public function __construct(TypeTierRepository $TypeTierRepository,TypeScoreRepository $TypeScoreRepository,PeopleRepository $PeopleRepository)
    {
        $this->TypeTierRepository = $TypeTierRepository;
        $this->TypeScoreRepository = $TypeScoreRepository;
        $this->PeopleRepository = $PeopleRepository;
    }
	
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('scoringjustif')
            ->add('commentaire')
            ->add('adresse', null, [
                'attr' => [
                    'placeholder' => 'Adresse',
                ],
            ])
            ->add('codepostal', null, [
                'attr' => [
                    'placeholder' => 'Code Postal',
                ],
            ])
            ->add('ville', null, [
                'attr' => [
                    'placeholder' => 'Ville',
                ],
            ])
            ->add('pays', null, [
                'attr' => [
                    'placeholder' => 'Pays',
                ],
            ])
            ->add('type', EntityType::class, [
            'class' => TypeTier::class,
            'choice_label' => 'designation',
            'required'   => false,
            'placeholder' => 'Sélectionner',
            'choices' => $this->TypeTierRepository->findByCustomer($options['userCustomer']),
            'attr' => [
                'class' => "select2",
            ],
            ])
            ->add('score', EntityType::class, [
                'class' => TypeScore::class,
                'choice_label' => 'designation',
                'required'   => false,
                'placeholder' => 'Sélectionner',
                'choices' => $this->TypeScoreRepository->findByCustomer($options['userCustomer']),
                'attr' => [
                    'class' => "select2",
                ],
                ])
            ->add('responsable', EntityType::class, [
                'placeholder' => 'Sélectionner le responsable',
                'class' => People::class,
                'required'   => false,
                'attr' => [
                    'class' => "select2",
                ],
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner le suppléant',
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                }
            ])
            ->add('peoples', EntityType::class, [
                'class' => People::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'attr' => [
                    'class' => "select2",
                ],
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tier::class,
            'userCustomer' => null,

        ]);
    }
}



