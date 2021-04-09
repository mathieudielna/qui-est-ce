<?php
namespace App\Form;

use App\Entity\Application;
use App\Entity\TypeAppli;
use App\Entity\People;
use App\Entity\Activite;
use App\Entity\Systeme;
use App\Entity\Ressource;
use App\Entity\Action;
use App\Entity\ObjetMetier;
use App\Entity\Flux;
use App\Entity\OnOff;

use App\Form\ActiviteType;
use App\Form\ActionType;

use App\Repository\PeopleRepository;
use App\Repository\ActionRepository;
use App\Repository\ActiviteRepository;
use App\Repository\SystemeRepository;
use App\Repository\TypeAppliRepository;
use App\Repository\RessourceRepository;
use App\Repository\ApplicationRepository;
use App\Repository\ObjetMetierRepository;
use App\Repository\FluxRepository;
use App\Repository\OnOffRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ApplicationType extends AbstractType
{
	
	 public function __construct(PeopleRepository $PeopleRepository, 
	 							 ActiviteRepository $ActiviteRepository, 
	 							 SystemeRepository $SystemeRepository, 
	 							 TypeAppliRepository $TypeAppliRepository,
	 							 RessourceRepository $RessourceRepository,
	 							 ApplicationRepository $ApplicationRepository,
	 							 ActionRepository $ActionRepository,
	 							 ObjetMetierRepository $ObjetMetierRepository,
	 							 FluxRepository $FluxRepository,
	 							 OnOffRepository $OnOffRepository
	 							 )
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->ActiviteRepository = $ActiviteRepository;
        $this->SystemeRepository = $SystemeRepository;
        $this->TypeAppliRepository = $TypeAppliRepository;
        $this->RessourceRepository = $RessourceRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->ActionRepository = $ActionRepository;
        $this->ObjetMetierRepository = $ObjetMetierRepository;
        $this->FluxRepository = $FluxRepository;
        $this->OnOffRepository = $OnOffRepository;
    }
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		->add('designation', null, [
            'attr' => ['class' => 'title-input','placeholder' => 'Désignation'],
            ])
            ->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une description courte de l\'application',
                    'class' => 'fiche'
                )
                ])
			->add('commentaire')
            ->add('responsable')
            ->add('editeur')
            ->add('appConnectActivites', CollectionType::class, [
            'entry_type' => AppConnectActiviteType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'attr' => [
                   'class' => "appConnectActivites",
               ],
            'by_reference' => false,
			])
            ->add('responsable', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner le responsable',
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
			'attr' => [
                'class' => "select2",
            ],
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('typeappli', EntityType::class, [
            'class' => TypeAppli::class,
            'required'   => true,
            'choices' => $this->TypeAppliRepository->findByCustomer($options['userCustomer']),
			'placeholder' => 'Sélectionner le type',
			'attr' => [
                'class' => "select2",
            ],
            'choice_label' => 'designation'
			])
			->add('prerequisite')
            
            ->add('applicationlink', EntityType::class, [
            'class' => Application::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner une application',
			'required'   => false,
			'by_reference' => false,
			'attr' => [
                'class' => "select2",
            ],
			'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Application $application) {
				return 'APP-'.$application->getId() . ' ' . $application->getDesignation();
				}
			])
			->add('systemes', EntityType::class, [
            'class' => Systeme::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'attr' => [
                'class' => "select2",
            ],
			'choices' => $this->SystemeRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Systeme $systeme) {
				return 'SYS-'.$systeme->getId() . ' ' . $systeme->getDesignation();
				}
			])
			
			->add('ressources', EntityType::class, [
            'class' => Ressource::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'attr' => [
                'class' => "select2",
            ],
			'choices' => $this->RessourceRepository->findByCustomer($options['userCustomer']),
			])
			
			->add('fluxes', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'attr' => [
                'class' => "select2",
            ],
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
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
			'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Action $action) {
				return 'ACT-'.$action->getId() . ' ' . $action->getDesignation();
				}
			])
			
			->add('objetMetiers', EntityType::class, [
            'class' => ObjetMetier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'attr' => [
                'class' => "select2",
            ],
			'choices' => $this->ObjetMetierRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (ObjetMetier $ObjetMetier) {
				return 'OM-'.$ObjetMetier->getId() . ' ' . $ObjetMetier->getDesignation();
				}

			])
			->add('statutrun', EntityType::class, [
            'class' => OnOff::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->OnOffRepository->findByCustomer($options['userCustomer']),
			])
			
			;
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
            'userCustomer' => null,

        ]);
    }
}
