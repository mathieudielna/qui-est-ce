<?php

namespace App\Form;

use App\Entity\Metier;
use App\Entity\People;

use App\Repository\PeopleRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MetierType extends AbstractType
{
	
	 public function __construct(PeopleRepository $PeopleRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('commentaire')
            ->add('code')
            ->add('directeur', EntityType::class, [
                'placeholder' => 'Sélectionner le directeur',
                'class' => People::class,
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('suppleant', EntityType::class, [
                'placeholder' => 'Sélectionner le suppleannt',
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
			'placeholder' => 'Choose an option',
			'required'   => false,
			'by_reference' => false,
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
            'data_class' => Metier::class,
            'userCustomer' => null,
        ]);
    }
}
