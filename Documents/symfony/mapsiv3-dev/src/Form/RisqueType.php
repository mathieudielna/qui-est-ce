<?php

namespace App\Form;

use App\Entity\Risque;
use App\Entity\People;
use App\Entity\OuiNon;
use App\Entity\TypeRisque;
use App\Entity\Processus;
use App\Entity\Metier;
use App\Entity\Action;
use App\Entity\TypeConformite;
use App\Entity\TypeStatutRisque;

use App\Repository\PeopleRepository;
use App\Repository\OuiNonRepository;
use App\Repository\TypeRisqueRepository;
use App\Repository\MetierRepository;
use App\Repository\ProcessusRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypeStatutRisqueRepository;

use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RisqueType extends AbstractType
{
	public function __construct(PeopleRepository $PeopleRepository, 
	 							 TypeRisqueRepository $TypeRisqueRepository,
	 							 OuiNonRepository $OuiNonRepository,
	 							 MetierRepository $MetierRepository,
	 							 ProcessusRepository $ProcessusRepository,
	 							 ActionRepository $ActionRepository,
                                TypeConformiteRepository $TypeConformiteRepository,
                                TypeStatutRisqueRepository $TypeStatutRisqueRepository
	 )
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->TypeRisqueRepository = $TypeRisqueRepository;
        $this->OuiNonRepository = $OuiNonRepository;
        $this->MetierRepository = $MetierRepository;
        $this->ProcessusRepository = $ProcessusRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeConformiteRepository = $TypeConformiteRepository;
        $this->TypeStatutRisqueRepository = $TypeStatutRisqueRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('commentaire')
            ->add('description', null, [
                'attr' => [
                         'class' => 'ckeditor',
                     ]
            ])
            ->add('probabilite')
            ->add('probabilitecible')
            ->add('controle')
            ->add('reduction', null, [
                'attr' => [
                         'class' => 'ckeditor',
                     ]
            ])
            ->add('impact')
            ->add('impactcible')
			->add('evaluation', null, [
                'attr' => [
                         'class' => 'ckeditor',
                     ]
            ])
			->add('actions', EntityType::class, [
            'class' => Action::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Attacher les actions',
			'required'   => false,
			'by_reference' => false,
            'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
            ])
            ->add('statut', EntityType::class, [
                'class' => TypeStatutRisque::class,
                'choice_label' => 'designation',
                'expanded' => false,
                'required'   => false,
                'placeholder' => 'Sélectionner',
                'choices' => $this->TypeStatutRisqueRepository->findByCustomer($options['userCustomer']),			
            ])
            ->add('score', null, [
                'attr' => [
                         'placeholder' => 'Score',
                     ]
            ])
            ->add('scorecible', null, [
                'attr' => [
                         'placeholder' => 'Score',
                     ]
            ])
			
			->add('typeconformite', EntityType::class, [
            'class' => TypeConformite::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
			'by_reference' => false,
            'choices' => $this->TypeConformiteRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (TypeConformite $typeconformite) {
				return ''.$typeconformite->getId() . ' ' . $typeconformite->getDesignation();
				}
			])
			->add('acceptation', EntityType::class, [
            'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('typerisque', EntityType::class, [
            'class' => TypeRisque::class,
            'choice_label' => 'designation',
            'expanded' => true,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->TypeRisqueRepository->findByCustomer($options['userCustomer']),
			])
	
			->add('processuses', EntityType::class, [
            'class' => Processus::class,
            'multiple' => 'true',
            'required'   => false,
            'placeholder' => 'Choose an option',
			'choices' => $this->ProcessusRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Processus $processus) {
				return 'P-'.$processus->getId() . ' ' . $processus->getDesignation();
				}
			])
			->add('metiers', EntityType::class, [
            'class' => Metier::class,
            'multiple' => 'true',
            'required'   => false,
            'placeholder' => 'Choose an option',
			'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Metier $metier) {
				return 'M-'.$metier->getId() . ' ' . $metier->getDesignation();
				}
			])
            ->add('responsable', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner le suppléant',
            'required'   => false,
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

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Risque::class,
            'userCustomer' => null,
            'userPeople' => null

        ]);
    }
}
