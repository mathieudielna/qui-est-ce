<?php

namespace App\Form;

use App\Entity\Controle;
use App\Entity\People;


use App\Repository\PeopleRepository;


use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ControleType extends AbstractType
{
	public function __construct(
		PeopleRepository $PeopleRepository
	 )
    {
        $this->PeopleRepository = $PeopleRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')

            ->add('commentaire')
            
            ->add('auteur', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner l\'auteur',
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('responsable', EntityType::class, [
                'placeholder' => 'Sélectionner le suppleant',
                'class' => People::class,
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
                ->add('suppleant', EntityType::class, [
                    'placeholder' => 'Sélectionner le suppleant',
                    'class' => People::class,
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
            'data_class' => Controle::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
