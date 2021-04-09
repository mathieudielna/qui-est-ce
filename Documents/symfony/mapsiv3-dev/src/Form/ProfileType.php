<?php

namespace App\Form;

use App\Entity\UserAccount;
use App\Entity\User;
use App\Entity\TypeRole;
use App\Entity\MapsiCustomer;
use App\Entity\People;
use App\Form\ProfileType;

use App\Repository\PeopleRepository;
use App\Repository\UserRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserAccountType extends AbstractType
{
	public function __construct(PeopleRepository $PeopleRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('landing')
            ->add('description')
            ->add('people', EntityType::class, [
	        'placeholder' => 'Sélectionner le collaborateur',
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('userRoles', EntityType::class, [
                'class' => TypeRole::class,
                'choice_label' => 'designation',
                'multiple' => 'false',
                'placeholder' => 'Choose an option',
                'required'   => true,
                'expanded'    => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'userCustomer' => null
        ]);
    }
}