<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Action;
use App\Entity\Axe;
use App\Entity\Metier;
use App\Entity\People;
use App\Entity\Tier;
use App\Entity\Risque;

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

class ProjetType extends AbstractType
{
	public function __construct(ActionRepository $ActionRepository,
								AxeRepository $AxeRepository,
								MetierRepository $MetierRepository,
								PeopleRepository $PeopleRepository,
								TierRepository $TierRepository,
								RisqueRepository $RisqueRepository
	 						 )
    {
        
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
            ->add('prerequis')
            ->add('code')
            ->add('axe', EntityType::class, [
	        'class' => Axe::class,
            'expanded' => false,
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'choices' => $this->AxeRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Axe $axe) {
				return ''.$axe->getTitle() . ' - ' . $axe->getDesignation();
				}
			])
			->add('metier', EntityType::class, [
	        'class' => Metier::class,
            'expanded' => false,
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Metier $metier) {
				return ''.$metier->getCode() . ' - ' . $metier->getDesignation();
				}
			])
			->add('responsable', EntityType::class, [
	        'placeholder' => 'Sélectionner le responsable',
            'class' => People::class,
			'required'   => true,
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
			->add('actions', EntityType::class, [
            'class' => Action::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'attr' => [
				'class' => "select2",
			],
			'choices' => $this->ActionRepository->findBy([
		        'customer' => $options['userCustomer'],
				 'archive' => null
		    ]),
	
			'choice_label' => function (Action $action) {
				return 'AC-'.$action->getId() . ' ' . $action->getDesignation();
				}
			])
			->add('risques', EntityType::class, [
            'class' => Risque::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->RisqueRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Risque $risque) {
				return 'R-'.$risque->getId() . ' ' . $risque->getDesignation();
				}
			])
			->add('contributeur', EntityType::class, [
	        'class' => Metier::class,
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'multiple' => 'true',
            'by_reference' => false,
            'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Metier $metier) {
				return ''.$metier->getCode() . ' - ' . $metier->getDesignation();
				}
			])
			->add('tier', EntityType::class, [
            'class' => Tier::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->TierRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Tier $tier) {
				return 'T-'.$tier->getId() . ' ' . $tier->getDesignation();
				}
			])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
            'userCustomer' => null,
			'userPeople' => null
        ]);
    }
}
