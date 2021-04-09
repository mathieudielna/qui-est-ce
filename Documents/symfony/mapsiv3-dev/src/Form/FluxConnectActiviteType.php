<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Flux;
use App\Entity\TypeDirection;
use App\Entity\FluxConnectActivite;

use App\Repository\TypeDirectionRepository;
use App\Repository\FluxRepository;
use App\Repository\ActiviteRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FluxConnectActiviteType extends AbstractType
{
	public function __construct(TypeDirectionRepository $TypeDirectionRepository,
							    FluxRepository $FluxRepository,
							    ActiviteRepository $ActiviteRepository)
    {
        $this->TypeDirectionRepository = $TypeDirectionRepository;
        $this->FluxRepository = $FluxRepository;
        $this->ActiviteRepository = $ActiviteRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flux', EntityType::class, [
            'class' => Flux::class,
            'choice_label' => 'designation',
            'required'   => true,
            'attr' => ['class' => 'select22a'],
            'placeholder' => 'Flux / Traitement',
            'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
			])
			
			->add('activite', EntityType::class, [
            'class' => Activite::class,
            'choice_label' => 'designation',
            'required'   => true,
            'attr' => ['class' => 'select22'],
            'placeholder' => 'Activité',
            'choice_label' => function (Activite $activite) {
						return 'AC-'.$activite->getId() . ' ' . $activite->getDesignation();
						},
            'choices' => $this->ActiviteRepository->findByCustomer($options['userCustomer']),
            ])  
            
            ->add('direction', EntityType::class, [
            'class' => TypeDirection::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => true,
            'attr' => ['class' => 'select22'],
            'placeholder' => 'Direction',
            'choices' => $this->TypeDirectionRepository->findByCustomer($options['userCustomer']),			
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FluxConnectActivite::class,
            'userCustomer' => null,
        ]);
    }
}


