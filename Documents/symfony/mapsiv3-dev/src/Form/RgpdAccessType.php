<?php

namespace App\Form;

use App\Entity\RgpdAccess;
use App\Entity\TypeStatut;
use App\Entity\People;
use App\Entity\Flux;
use App\Repository\TypeStatutRepository;
use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RgpdAccessType extends AbstractType
{
	public function __construct(TypeStatutRepository $TypeStatutRepository,
								PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository
	 						 	)
    {
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
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
						}
				])
				;
        $builder
            ->add('designation')
            ->add('nom')
            ->add('email')
            ->add('commentaire')
            ->add('description')
            ->add('ClosedAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => false,
				])
            ->add('statut', EntityType::class, [
            'class' => TypeStatut::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => 'Sélectionner',
			'choices' => $this->TypeStatutRepository->findByCustomer($options['userCustomer']),			
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
			->add('traitement', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
			])
			->add('pilotes', EntityType::class, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RgpdAccess::class,
            'userCustomer' => null,
            'userPeople' => null,
            'create' => null,
        ]);
    }
}
