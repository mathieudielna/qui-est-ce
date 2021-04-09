<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Projet;
use App\Entity\Action;
use App\Entity\Axe;
use App\Entity\Metier;
use App\Entity\People;
use App\Entity\Tier;
use App\Entity\Risque;

use App\Repository\ProjetRepository;
use App\Repository\ActionRepository;
use App\Repository\AxeRepository;
use App\Repository\MetierRepository;
use App\Repository\PeopleRepository;
use App\Repository\TierRepository;
use App\Repository\RisqueRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProgramType extends AbstractType
{
	public function __construct(ProjetRepository $ProjetRepository,
								ActionRepository $ActionRepository,
								AxeRepository $AxeRepository,
								MetierRepository $MetierRepository,
								PeopleRepository $PeopleRepository,
								TierRepository $TierRepository,
								RisqueRepository $RisqueRepository
	 						 )
    {
        
        $this->ProjetRepository = $ProjetRepository;
        $this->ActionRepository = $ActionRepository;
        $this->AxeRepository = $AxeRepository;
        $this->MetierRepository = $MetierRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->TierRepository = $TierRepository;
        $this->RisqueRepository = $RisqueRepository;

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('commentaire')
            ->add('code')
			->add('metier', EntityType::class, [
	        'class' => Metier::class,
            'expanded' => false,
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
            'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Metier $metier) {
				return ''.$metier->getCode() . ' - ' . $metier->getDesignation();
				}
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
                'multiple' => 'true',
                'placeholder' => 'Sélectionner les contributeurs',
                'required'   => false,
                'attr' => [
                    'class' => "select2",
                ],
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
            ])
			->add('projets', EntityType::class, [
            'class' => Projet::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
			'by_reference' => false,
			'choices' => $this->ProjetRepository->findBy([
		        'customer' => $options['userCustomer']
		    ]),
			'choice_label' => function (Projet $projet) {
				return 'PROJ-'.$projet->getId() . ' ' . $projet->getDesignation();
				}
			])
			->add('topprogram', CheckboxType::class, [
			    'label'    => 'Top Programme',
			    'required' => false,
				 ])
			

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
