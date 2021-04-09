<?php

namespace App\Form;

use App\Entity\PcaEvenement;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Action;
use App\Entity\Tier;
use App\Entity\Application;
use App\Entity\Systeme;
use App\Entity\Activite;
use App\Entity\Site;
use App\Entity\TypeStatut;
use App\Entity\TypePcaEvenement;
use App\Entity\PcaEvenementAppTrack;
use App\Entity\PcaEvenementServTrack;

use App\Repository\PcaevenementRepository;
use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\ActionRepository;
use App\Repository\TierRepository;
use App\Repository\ApplicationRepository;
use App\Repository\SystemeRepository;
use App\Repository\ActiviteRepository;
use App\Repository\SiteRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\TypePcaEvenementRepository;
use App\Repository\PcaEvenementAppTrackRepository;
use App\Repository\PcaEvenementServTrackRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PcaevenementType extends AbstractType
{
	public function __construct(ActionRepository $ActionRepository,
								ApplicationRepository $ApplicationRepository,
								PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository,
								SystemeRepository $SystemeRepository,
								SiteRepository $SiteRepository,
								TypeStatutRepository $TypeStatutRepository,
								ActiviteRepository $ActiviteRepository,
								TypePcaEvenementRepository $TypePcaEvenementRepository
	 						 	)
    {
        $this->ActionRepository = $ActionRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
        $this->TierRepository = $TierRepository;
        $this->SystemeRepository = $SystemeRepository;
        $this->ActiviteRepository = $ActiviteRepository;
        $this->SiteRepository = $SiteRepository;
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->TypePcaEvenementRepository = $TypePcaEvenementRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('objectif')
            ->add('scenario')
            ->add('commentaire')
            ->add('StartAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => false,
				])
            ->add('FinishAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => false,
				])
			
            ->add('activites', EntityType::class, [
            'class' => Activite::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->ActiviteRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Activite $activite) {
				return 'ACT-'.$activite->getId() . ' ' . $activite->getDesignation();
				}
			])
            ->add('responsable', EntityType::class, [
	        'placeholder' => 'Sélectionner le responsable',
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('suppleant', EntityType::class, [
	        'placeholder' => 'Sélectionner le déclarant',
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('contributeurs', EntityType::class, [
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
            ->add('tiers', EntityType::class, [
            'class' => Tier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TierRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Tier $tier) {
				return 'T-'.$tier->getId() . ' ' . $tier->getDesignation();
				}
			])
            ->add('sites', EntityType::class, [
            'class' => Site::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Site $site) {
				return 'SIT-'.$site->getId() . ' ' . $site->getDesignation();
				}
			])
			->add('statut', EntityType::class, [
            'class' => TypeStatut::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => 'Sélectionner',
			'choices' => $this->TypeStatutRepository->findByCustomer($options['userCustomer']),			
			])
			->add('typeevenements', EntityType::class, [
            'class' => TypePcaEvenement::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'multiple' => 'true',
            'placeholder' => 'Sélectionner',
			'choices' => $this->TypePcaEvenementRepository->findByCustomer($options['userCustomer']),			
			])
			->add('AppTrack', CollectionType::class, [
            'entry_type' => PcaEvenementAppTrackType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'attr' => [
                   'class' => "PcaEvenementAppTrack",
               ],
            'by_reference' => false,
			])
			->add('pcaEvenementServTracks', CollectionType::class, [
            'entry_type' => PcaEvenementServTrackType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'attr' => [
                   'class' => "PcaEvenementServTrack",
               ],
            'by_reference' => false,
			])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PcaEvenement::class,
            'userCustomer' => null,
        ]);
    }
}
