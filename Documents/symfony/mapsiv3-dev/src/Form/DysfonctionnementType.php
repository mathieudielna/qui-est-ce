<?php

namespace App\Form;

use App\Entity\Dysfonctionnement;
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

class DysfonctionnementType extends AbstractType
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
            ->add('responsable', EntityType::class, [
                'class' => People::class,
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
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
            ->add('declarant', EntityType::class, [
	        'placeholder' => 'Sélectionner le déclarant',
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
			->add('traitements', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
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
            'data_class' => Dysfonctionnement::class,
            'userCustomer' => null,
            'userPeople' => null,
            'create' => null,
        ]);
    }
}
