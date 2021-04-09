<?php

namespace App\Form;

use App\Entity\RgpdViolation;
use App\Entity\RgpdAccess;
use App\Entity\TypeStatut;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Tier;
use App\Repository\TypeStatutRepository;
use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\TierRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RgpdViolationType extends AbstractType
{
	public function __construct(TypeStatutRepository $TypeStatutRepository,
								PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository
	 						 	)
    {
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
        $this->TierRepository = $TierRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    if($options['create']=='yes'){
		    $builder
		        ->add('responsable', EntityType::class, [
		            'class' => People::class,
		            'placeholder' => 'Sélectionner',
		            'required'   => false,
		            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
		            'choice_label' => function (People $people) {
						return $people->getFirstname() . ' ' . $people->getLastname();
						},
					'data' => $this->PeopleRepository->findOneById($options['userPeople']),
					])
				;
        	}else{
	        	
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
				;
        	}
        $builder
            ->add('designation')
            ->add('typenotification')
            ->add('numerocnil')
            ->add('description')
            ->add('consequence')
            ->add('CreatedAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => false,
				])
            ->add('PublishedAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => false,
				])
            ->add('ClosedAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => false,
				])
            ->add('commentaire')
            ->add('mesuresecu')
            ->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('declarant', EntityType::class, [
	        'placeholder' => 'Sélectionner le déclarant',
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
			->add('traitement', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
			])
            ->add('contributeur', EntityType::class, [
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
			 ->add('statut', EntityType::class, [
            'class' => TypeStatut::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => 'Sélectionner',
			'choices' => $this->TypeStatutRepository->findByCustomer($options['userCustomer']),			
			])
			->add('tiers', EntityType::class, [
            'class' => Tier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
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
            'data_class' => RgpdViolation::class,
            'userCustomer' => null,
            'userPeople' => null,
            'create' => null,
        ]);
    }
}
