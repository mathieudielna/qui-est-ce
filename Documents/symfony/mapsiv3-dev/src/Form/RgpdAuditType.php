<?php

namespace App\Form;

use App\Entity\RgpdAudit;
use App\Entity\RgpdViolation;
use App\Entity\RgpdAccess;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Action;
use App\Entity\TypeStatut;
use App\Entity\Tier;
use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeStatutRepository;
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

class RgpdAuditType extends AbstractType
{
	public function __construct(PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository,
								ActionRepository $ActionRepository,
								TypeStatutRepository $TypeStatutRepository
	 						 	)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->TierRepository = $TierRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('CreatedAt', DateType::class, [
			    'widget' => 'single_text'
				])
            ->add('PublishedAt', DateType::class, [
			    'widget' => 'single_text'
				])
            ->add('ClosedAt', DateType::class, [
			    'widget' => 'single_text'
				])
            ->add('resultat')
            ->add('resultatlight')
            ->add('commentaire')
            ->add('traitement', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
			])
            ->add('responsable', EntityType::class, [
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
			->add('actions', EntityType::class, [
            'class' => Action::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'required'   => false,
			'by_reference' => false,
			'choices' => $this->ActionRepository->findBy([
		        'customer' => $options['userCustomer'],
				 'archive' => null
		    ]),
			'choice_label' => function (Action $action) {
				return 'AC-'.$action->getId() . ' ' . $action->getDesignation();
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
            'data_class' => RgpdAudit::class,
            'userCustomer' => null,
        ]);
    }
}
