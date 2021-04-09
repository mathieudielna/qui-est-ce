<?php

namespace App\Form;

use App\Entity\People;
use App\Entity\TypeSupport;
use App\Entity\TypeOm;
use App\Entity\OuiNon;
use App\Entity\Application;
use App\Entity\Flux;
use App\Entity\ObjetMetier;
use App\Entity\Data;
use App\Entity\TypePrevention;
use App\Entity\TypeStatutrgpd;


use App\Repository\PeopleRepository;
use App\Repository\TypeSupportRepository;
use App\Repository\TypeOmRepository;
use App\Repository\OuiNonRepository;
use App\Repository\ApplicationRepository;
use App\Repository\FluxRepository;
use App\Repository\DataRepository;
use App\Repository\TypePreventionRepository;
use App\Repository\TypeStatutrgpdRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ObjetMetierType extends AbstractType
{
	public function __construct(PeopleRepository $PeopleRepository,
								OuiNonRepository $OuiNonRepository,
								TypeSupportRepository $TypeSupportRepository,
								TypeOmRepository $TypeOmRepository,
								ApplicationRepository $ApplicationRepository,
								FluxRepository $FluxRepository,
								DataRepository $DataRepository,
								TypePreventionRepository $TypePreventionRepository,
								TypeStatutrgpdRepository $TypeStatutrgpdRepository
	 						 	)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->TypeSupportRepository = $TypeSupportRepository;
        $this->OuiNonRepository = $OuiNonRepository;
        $this->TypeOmRepository = $TypeOmRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->FluxRepository = $FluxRepository;
        $this->DataRepository = $DataRepository;
        $this->TypePreventionRepository = $TypePreventionRepository;
        $this->TypeStatutrgpdRepository = $TypeStatutrgpdRepository;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    

		$builder
			->add('responsable', EntityType::class, [
				'class' => People::class,
				'placeholder' => 'Sélectionner',
				'required'   => false,
				'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
				'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
					},
				])
            ->add('designation')
			->add('description')
			->add('commentaire')
            ->add('dcp', EntityType::class, [
            'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
			'required'   => false,
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('dcpsensible', EntityType::class, [
			'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
			'required'   => false,
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('statutrgpd', EntityType::class, [
            'class' => TypeStatutrgpd::class,
            'choice_label' => 'designation',
            'expanded' => true,
			'required'   => false,
			'choices' => $this->TypeStatutrgpdRepository->findByCustomer($options['userCustomer']),
			])
			->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner',
			'required'   => false,
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
			->add('peoples', EntityType::class, [
			'class' => People::class,
			'multiple' => 'true',
			'placeholder' => 'Contributeurs',
			'required'   => false,
			'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				},
			])
			 ->add('type', EntityType::class, [
            'class' => TypeOm::class,
            'choice_label' => 'designation',
            'required'   => false,
			'placeholder' => 'Sélectionner',
            'choices' => $this->TypeOmRepository->findByCustomer($options['userCustomer']),
			])
			->add('mesuresprev', EntityType::class, [
            'class' => TypePrevention::class,
			'choice_label' => 'designation',
            'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
            'choices' => $this->TypePreventionRepository->findByCustomer($options['userCustomer']),
			])
			->add('typesupport', EntityType::class, [
            'class' => TypeSupport::class,
            'choice_label' => 'designation',
            'required'   => false,
			'placeholder' => 'Sélectionner',
            'choices' => $this->TypeSupportRepository->findByCustomer($options['userCustomer']),
			])
			->add('applications', EntityType::class, [
            'class' => Application::class,
            'choice_label' => function (Application $application) {
				return 'App-'.$application->getId() . ' ' . $application->getDesignation();
				},
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			])
			->add('datas', EntityType::class, [
            'class' => Data::class,
            'choice_label' => function (Data $data) {
				return 'DATA-'.$data->getId() . ' ' . $data->getDesignation();
				},
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->DataRepository->findByCustomer($options['userCustomer']),
			])
			
			->add('fluxes', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => function (Flux $flux) {
				return 'Flux-'.$flux->getId() . ' ' . $flux->getDesignation();
				},
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
			])
			
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ObjetMetier::class,
			'userCustomer' => null,
            'userPeople' => null
		]);
    }
}
