<?php

namespace App\Form;

use App\Entity\Axe;
use App\Entity\TypeAxevolet;
use App\Entity\Action;
use App\Entity\People;

use App\Repository\PeopleRepository;
use App\Repository\TypeAxevoletRepository;
use App\Repository\ActionRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AxeType extends AbstractType
{
	private $TypeAxevoletRepository;
	
	 public function __construct(TypeAxevoletRepository $TypeAxevoletRepository,
	 							ActionRepository $ActionRepository,
	 							PeopleRepository $PeopleRepository)
    {
        $this->TypeAxevoletRepository = $TypeAxevoletRepository;
        $this->ActionRepository = $ActionRepository;
        $this->PeopleRepository = $PeopleRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('designation')
            ->add('description')
            ->add('commentaire')
            ->add('actionstrats', CollectionType::class, [
            'entry_type' => ActionstratType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'delete_empty' => true,
			'attr' => [
                   'class' => "actionstrats",
               ],
            'by_reference' => false,
			])
			

			
				
			->add('volet', EntityType::class, [
            'class' => TypeAxevolet::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'placeholder' => 'Sélectionner le type',
            'required'   => false,
			'choices' => $this->TypeAxevoletRepository->findByCustomer($options['userCustomer']),
			])
			
			->add('responsable', EntityType::class, [
	        'placeholder' => 'Sélectionner le responsable',
            'class' => People::class,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Axe::class,
            'userCustomer' => null,
        ]);
    }
}
