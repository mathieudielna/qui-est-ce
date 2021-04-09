<?php

namespace App\Form;

use App\Entity\Flux;
use App\Entity\Activite;
use App\Entity\People;
use App\Entity\TypeStatutrgpd;
use App\Entity\Application;
use App\Entity\Metier;
use App\Entity\Tier;
use App\Entity\ObjetMetier;
use App\Entity\TypePeriodicite;
use App\Entity\TypeSupport;
use App\Entity\TypeDirection;
use App\Entity\TypePriorite;
use App\Entity\TypeDuree;
use App\Entity\TypeActeur;
use App\Entity\TypeDcpjuridique;
use App\Entity\TypeDcpsensible;
use App\Entity\TypeDcpsecu;
use App\Entity\OuiNon;
use App\Entity\Action;
use App\Entity\TypeTraitementrgpd;
use App\Entity\User;
use App\Entity\Risque;
use App\Entity\TypeConformite;


use App\Repository\PeopleRepository;
use App\Repository\MetierRepository;
use App\Repository\ActiviteRepository;
use App\Repository\ApplicationRepository;
use App\Repository\TierRepository;
use App\Repository\OuiNonRepository;
use App\Repository\ObjetMetierRepository;
use App\Repository\TypePrioriteRepository;
use App\Repository\TypeDcpjuridiqueRepository;
use App\Repository\TypeDcpsensibleRepository;
use App\Repository\TypeDcpsecuRepository;
use App\Repository\TypeDirectionRepository;
use App\Repository\TypeDureeRepository;
use App\Repository\TypeStatutrgpdRepository;
use App\Repository\TypeSupportRepository;
use App\Repository\TypePeriodiciteRepository;
use App\Repository\TypeActeurRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeTraitementrgpdRepository;
use App\Repository\UserRepository;
use App\Repository\RisqueRepository;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class FluxType extends AbstractType
{
	 public function __construct(PeopleRepository $PeopleRepository, 
	 							 ActiviteRepository $ActiviteRepository, 
	 							 MetierRepository $MetierRepository,
	 							 ApplicationRepository $ApplicationRepository, 
	 							 TierRepository $TierRepository, 
	 							 OuiNonRepository $OuiNonRepository, 
	 							 ObjetMetierRepository $ObjetMetierRepository,
	 							 TypeDcpjuridiqueRepository $TypeDcpjuridiqueRepository, 
	 							 TypeDcpsensibleRepository $TypeDcpsensibleRepository,
	 							 TypeDcpsecuRepository $TypeDcpsecuRepository,
	 							 TypeDirectionRepository $TypeDirectionRepository, 
	 							 TypeDureeRepository $TypeDureeRepository, 
	 							 TypeStatutrgpdRepository $TypeStatutrgpdRepository, 
	 							 TypeSupportRepository $TypeSupportRepository, 
	 							 TypePeriodiciteRepository $TypePeriodiciteRepository,
	 							 TypeActeurRepository $TypeActeurRepository, 
	 							 TypePrioriteRepository $TypePrioriteRepository,
	 							 TypeTraitementrgpdRepository $TypeTraitementrgpdRepository,
	 							 ActionRepository $ActionRepository,
								 UserRepository $UserRepository,
								 RisqueRepository $RisqueRepository
	 							 )
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->ActiviteRepository = $ActiviteRepository;
        $this->MetierRepository = $MetierRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->TierRepository = $TierRepository;
        $this->OuiNonRepository = $OuiNonRepository;
        $this->ObjetMetierRepository = $ObjetMetierRepository;
        $this->TypeDcpjuridiqueRepository = $TypeDcpjuridiqueRepository;
        $this->TypeDcpsensibleRepository = $TypeDcpsensibleRepository;
        $this->TypeDcpsecuRepository = $TypeDcpsecuRepository;
        $this->TypeDirectionRepository = $TypeDirectionRepository;
        $this->TypeDureeRepository = $TypeDureeRepository;
        $this->TypeStatutrgpdRepository = $TypeStatutrgpdRepository;
        $this->TypeSupportRepository = $TypeSupportRepository;
        $this->TypePeriodiciteRepository = $TypePeriodiciteRepository;
        $this->TypePrioriteRepository = $TypePrioriteRepository;
        $this->TypeActeurRepository = $TypeActeurRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeTraitementrgpdRepository = $TypeTraitementrgpdRepository;
		$this->UserRepository = $UserRepository;
		$this->RisqueRepository = $RisqueRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('responsable', EntityType::class, [
				'class' => People::class,
				'placeholder' => 'Sélectionner',
				'required'   => true,
				'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
				'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
					},
				])

			->add('peoples', EntityType::class, [
				'class' => People::class,
				'choice_label' => 'designation',
				'multiple' => 'true',
				'placeholder' => 'Sélectionner',
				'required'   => false,
				'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
				'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
					}
				])
			->add('designation', TextType::class, [
				'attr' => ['class' => 'form-control-lg'],
				])
            ->add('description')
            ->add('commentaire')
            ->add('finalite')
            ->add('sstraitant')
            ->add('fluxConnectActivites', CollectionType::class, [
            'entry_type' => FluxConnectActiviteType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'delete_empty' => true,
            'by_reference' => false,
			])
            ->add('statutrgpd', EntityType::class, [
	        'class' => TypeStatutrgpd::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'placeholder' => 'Non connu',
			'choices' => $this->TypeStatutrgpdRepository->findByCustomer($options['userCustomer']),
			])
            
			->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner',
			'required'   => true,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
			->add('redacteur', EntityType::class, [
				'class' => People::class,
				'placeholder' => 'Sélectionner',
				'required'   => true,
				'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
				'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
					}
				])
			->add('applications', EntityType::class, [
            'class' => Application::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Application $application) {
				return 'APP-'.$application->getId() . ' ' . $application->getDesignation();
				}
			])
			->add('actions', EntityType::class, [
            'class' => Action::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Action $action) {
				return 'ACT-'.$action->getId() . ' ' . $action->getDesignation();
				}
			])
			->add('destin', EntityType::class, [
            'class' => Metier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
			])
			->add('destext', EntityType::class, [
            'class' => Tier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'choices' => $this->TierRepository->findByCustomer($options['userCustomer']),
			'required'   => false,
			])
			->add('expin', EntityType::class, [
            'class' => Metier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
			])
			->add('expout', EntityType::class, [
            'class' => Tier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'choices' => $this->TierRepository->findByCustomer($options['userCustomer']),
			'required'   => false,
			])

			->add('objetmetiers', EntityType::class, [
            'class' => ObjetMetier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->ObjetMetierRepository->findByCustomer($options['userCustomer']),
			])
			->add('risques', EntityType::class, [
			'class' => Risque::class,
			'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'by_reference' => false,
			'required'   => false,
			'choices' => $this->RisqueRepository->findByCustomer($options['userCustomer']),
			])
			->add('supports', EntityType::class, [
            'class' => TypeSupport::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypeSupportRepository->findByCustomer($options['userCustomer']),
			])
			->add('periodicites', EntityType::class, [
            'class' => TypePeriodicite::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypePeriodiciteRepository->findByCustomer($options['userCustomer']),
			])
			->add('dureeconservation', EntityType::class, [
	        'class' => TypeDuree::class,
            'choice_label' => 'designation',
            'expanded' => false,
			'required'   => false,
			'placeholder' => 'Sélectionner',
			'choices' => $this->TypeDureeRepository->findByCustomer($options['userCustomer']),
			])
			->add('transferthorsue', EntityType::class, [
	        'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'placeholder' => 'Non connu',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('personneconcerne', EntityType::class, [
            'class' => TypeActeur::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypeActeurRepository->findByCustomer($options['userCustomer']),
			])
			->add('dcpjuridique', EntityType::class, [
            'class' => TypeDcpjuridique::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypeDcpjuridiqueRepository->findByCustomer($options['userCustomer']),
			])
			->add('dcpsensible', EntityType::class, [
            'class' => TypeDcpsensible::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypeDcpsensibleRepository->findByCustomer($options['userCustomer']),
			])
			->add('typetraitementrgpds', EntityType::class, [
            'class' => TypeTraitementrgpd::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypeTraitementrgpdRepository->findByCustomer($options['userCustomer']),
			])

			->add('accordcollecte', EntityType::class, [
	        'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'placeholder' => 'Non connu',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('accordutilisation', EntityType::class, [
	        'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'placeholder' => 'Non connu',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('dcpsstraitant', EntityType::class, [
	        'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'placeholder' => 'Non connu',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('dpia', EntityType::class, [
	        'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'placeholder' => 'Non connu',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
		
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flux::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
