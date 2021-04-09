<?php
namespace App\Form;

use App\Entity\Action;
use App\Entity\People;
use App\Entity\Application;
use App\Entity\TypeConformite;
use App\Entity\TypePriorite;
use App\Entity\TypeStatut;
use App\Entity\TypeAction;
use App\Entity\Site;
use App\Entity\Axe;
use App\Entity\Processus;
use App\Entity\Flux;
use App\Entity\Risque;
use App\Entity\Projet;
use App\Entity\JalonConnectAction;
use App\Entity\TypePhase;

use App\Repository\PeopleRepository;
use App\Repository\ApplicationRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypePrioriteRepository;
use App\Repository\TypeActionRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\SiteRepository;
use App\Repository\AxeRepository;
use App\Repository\ProcessusRepository;
use App\Repository\RisqueRepository;
use App\Repository\ProjetRepository;
use App\Repository\JalonConnectActionRepository;
use App\Repository\TypePhaseRepository;
use App\Repository\FluxRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ActionType extends AbstractType
{
	 public function __construct(PeopleRepository $PeopleRepository,
	 							 TypeConformiteRepository $TypeConformiteRepository,
	 							 TypePrioriteRepository $TypePrioriteRepository,
	 							 ProjetRepository $ProjetRepository,
	 							 TypeStatutRepository $TypeStatutRepository,
	 							 SiteRepository $SiteRepository,
	 							 AxeRepository $AxeRepository,
	 							 RisqueRepository $RisqueRepository,
	 							 ProcessusRepository $ProcessusRepository,
	 							 TypePhaseRepository $TypePhaseRepository,
	 							 ApplicationRepository $ApplicationRepository,
	 							 FluxRepository $FluxRepository,
								 JalonConnectActionRepository $JalonConnectActionRepository
	 							 )
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->TypeConformiteRepository = $TypeConformiteRepository;
        $this->TypePrioriteRepository = $TypePrioriteRepository;
		$this->ProjetRepository = $ProjetRepository;
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->SiteRepository = $SiteRepository;
        $this->AxeRepository = $AxeRepository;
        $this->RisqueRepository = $RisqueRepository;
        $this->ProcessusRepository = $ProcessusRepository;
        $this->TypePhaseRepository = $TypePhaseRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->FluxRepository = $FluxRepository;
		$this->JalonConnectActionRepository = $JalonConnectActionRepository;

    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
			->add('description')
			->add('statutaction')
            // ->add('budget', null, [
			//     'attr' => array('readonly' => true)
			// ])
            // ->add('etp', null, [
			//     'attr' => array('readonly' => true)
			// ])
            ->add('reference', null, [
				    'required'   => false,
				    'empty_data' => 'N/C',
				])          
            // ->add('datedebut', DateType::class, [
			//     'widget' => 'single_text',
			//     'attr' => array('readonly' => true)
			// 	])
            // ->add('datefin', DateType::class, [
			//     'widget' => 'single_text',
			//     'attr' => array('readonly' => true)
			// 	])
            // ->add('datefinrevue', DateType::class, [
			//     'widget' => 'single_text',
			//     'required'   => false,
			//     'attr' => array('readonly' => true)
			// 	])
            // ->add('datefinreelle', DateType::class, [
			//     'widget' => 'single_text',
			//     'required'   => false,
			//     'attr' => array('readonly' => true)
			// 	])
            // ->add('progression', null, [
			//     'attr' => array('readonly' => true)
			// 	])
            ->add('domaineprojet')
            ->add('commentaire')
            ->add('responsable', EntityType::class, [
	        'placeholder' => 'Sélectionner le responsable',
            'class' => People::class,
			'required'   => true,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner le suppléant',
			'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
			->add('sites', EntityType::class, [
            'class' => Site::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
			])
			
			 ->add('typeconformite', EntityType::class, [
            'class' => TypeConformite::class,
			'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->TypeConformiteRepository->findByCustomer($options['userCustomer']),
			])
			->add('phase', EntityType::class, [
            'class' => TypePhase::class,
            'choice_label' => 'designation',
			'expanded' => false,
			'placeholder' => 'Sélectionner',
			
			'required'   => false,
			'choices' => $this->TypePhaseRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('axes', EntityType::class, [
            'class' => Axe::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->AxeRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Axe $axe) {
				return ''.$axe->getTitle() . ' ' . $axe->getDesignation();
				}
			])
			->add('processuses', EntityType::class, [
            'class' => Processus::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			
			'required'   => false,
			'choices' => $this->ProcessusRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Processus $processus) {
				return 'P-'.$processus->getId() . ' ' . $processus->getDesignation();
				}
			])
			->add('fluxes', EntityType::class, [
            'class' => Flux::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			
			'required'   => false,
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Flux $flux) {
				return 'FLU-'.$flux->getId() . ' ' . $flux->getDesignation();
				}
			])
			->add('risques', EntityType::class, [
            'class' => Risque::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			
			'required'   => false,
			'choices' => $this->RisqueRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Risque $risque) {
				return 'R-'.$risque->getId() . ' ' . $risque->getDesignation();
				}
			])
			->add('priorite', EntityType::class, [
	        'class' => TypePriorite::class,
			'choice_label' => 'designation',
			
            'expanded' => false,
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'choices' => $this->TypePrioriteRepository->findByCustomer($options['userCustomer']),
			])
			->add('projet', EntityType::class, [
	        'class' => Projet::class,
            'expanded' => false,
			'placeholder' => 'Associer à un projet',	
            'required'   => true,
            'choices' => $this->ProjetRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Projet $projet) {
				return 'PROJ-'.$projet->getId() . ' ' . $projet->getDesignation();
				}
			])
			->add('people', EntityType::class, [
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
			
			->add('jalonConnectActions', CollectionType::class, [
            'entry_type' => JalonConnectActionType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'delete_empty' => true,
			'attr' => [
                   'class' => "jalonConnectActions",
               ],
            'by_reference' => false,
			])

			->add('applications', EntityType::class, [
            'class' => Application::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',			
			'required'   => false,
			'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			])

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
            'userCustomer' => null,
			'userPeople' => null
        ]);
    }
}
