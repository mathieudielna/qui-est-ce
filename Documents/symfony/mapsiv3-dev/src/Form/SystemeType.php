<?php

namespace App\Form;

use App\Entity\Systeme;
use App\Entity\Application;
use App\Entity\Criticite;
use App\Entity\People;
use App\Entity\TypeSysteme;
use App\Entity\Site;
use App\Entity\OuiNon;
use App\Entity\TypePlateforme;
use App\Entity\OnOff;
use App\Entity\TypeOs;
use App\Entity\PcaEvenement;

use App\Form\ApplicationType;

use App\Repository\PeopleRepository;
use App\Repository\ApplicationRepository;
use App\Repository\TypeSystemeRepository;
use App\Repository\TypePlateformeRepository;
use App\Repository\OuiNonRepository;
use App\Repository\OnOffRepository;
use App\Repository\SiteRepository;
use App\Repository\CriticiteRepository;
use App\Repository\SystemeRepository;
use App\Repository\PcaEvenementRepository;
use App\Repository\TypeOsRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SystemeType extends AbstractType
{
	 public function __construct(PeopleRepository $PeopleRepository, 
	 							 ApplicationRepository $ApplicationRepository, 
	 							 TypeSystemeRepository $TypeSystemeRepository, 
	 							 TypePlateformeRepository $TypePlateformeRepository,
	 							 OuiNonRepository $OuiNonRepository,
	 							 SiteRepository $SiteRepository,
	 							 OnOffRepository $OnOffRepository,
	 							 SystemeRepository $SystemeRepository,
	 							 CriticiteRepository $CriticiteRepository,
	 							 PcaEvenementRepository $PcaEvenementRepository,
	 							 TypeOsRepository $TypeOsRepository
	 							 )
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->TypeSystemeRepository = $TypeSystemeRepository;
        $this->TypePlateformeRepository = $TypePlateformeRepository;
        $this->OuiNonRepository = $OuiNonRepository;
        $this->SiteRepository = $SiteRepository;
        $this->OnOffRepository = $OnOffRepository;
        $this->SystemeRepository = $SystemeRepository;
        $this->CriticiteRepository = $CriticiteRepository;
        $this->PcaEvenementRepository = $PcaEvenementRepository;
        $this->TypeOsRepository = $TypeOsRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('role')
            ->add('modele')
            ->add('processeur')
            ->add('ram')
            ->add('os', EntityType::class, [
            'class' => TypeOs::class,
            'choice_label' => 'designation',
            'placeholder' => 'Choose an option',
            'expanded' => false,
            'required'   => false,
			'choices' => $this->TypeOsRepository->findByCustomer($options['userCustomer']),
			])
            ->add('partitionnement')
            ->add('raid')
            ->add('commentaire')
            ->add('applications', EntityType::class, [
            'class' => Application::class,
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
			'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Application $application) {
				return 'APP-'.$application->getId() . ' ' . $application->getDesignation();
				}
			])
			->add('systemeconnexes', EntityType::class, [
            'class' => Systeme::class,
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
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
			->add('PcaEvenements', EntityType::class, [
            'class' => PcaEvenement::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
			'choices' => $this->PcaEvenementRepository->findByCustomer($options['userCustomer']),
			])
			->add('dima', EntityType::class, [
            'class' => Criticite::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
            ->add('pdma', EntityType::class, [
            'class' => Criticite::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('responsable', EntityType::class, [
            'placeholder' => 'Sélectionner le responsable',
            'attr' => [
                'class' => "select2",
            ],
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
			 ->add('suppleant', EntityType::class, [
            'placeholder' => 'Sélectionner le suppleant',
            'attr' => [
                'class' => "select2",
            ],
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
            ])
            ->add('peoples', EntityType::class, [
            'class' => People::class,
            'multiple' => 'true',
            'attr' => [
                'class' => "select2",
            ],
            'placeholder' => 'Choose an option',
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                }
            ])
			 ->add('typesysteme', EntityType::class, [
            'class' => TypeSysteme::class,
            'choice_label' => 'designation',
            'required'   => true,
            'placeholder' => 'Sélectionner un type',
            'choices' => $this->TypeSystemeRepository->findByCustomer($options['userCustomer']),
			])
			->add('storages', EntityType::class, [
            'class' => Systeme::class,
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->SystemeRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Systeme $systeme) {
				return 'SYS-'.$systeme->getId() . ' ' . $systeme->getDesignation();
				}
			])
		
			
			->add('host', EntityType::class, [
            'class' => Systeme::class,
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->SystemeRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Systeme $systeme) {
				return 'SYS-'.$systeme->getId() . ' ' . $systeme->getDesignation();
				}
			])
			
			->add('plateforme', EntityType::class, [
            'class' => TypePlateforme::class,
            'choice_label' => 'designation',
            'required'   => false,
            'placeholder' => 'Sélectionner un type',
            'choices' => $this->TypePlateformeRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('localisation', EntityType::class, [
            'class' => Site::class,
            'choice_label' => 'designation',
            'required'   => false,
            'placeholder' => 'Sélectionner un site',
            'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Site $site) {
				return 'SIT-'.$site->getId() . ' ' . $site->getDesignation();
				}
			])
			->add('secours', EntityType::class, [
            'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('srvhote', EntityType::class, [
            'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('replicat', EntityType::class, [
            'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
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
            'data_class' => Systeme::class,
            'userCustomer' => null,
        ]);
    }
}
