<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\TypeRole;
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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserRoleUpdateType extends AbstractType
{
	public function __construct(PeopleRepository $PeopleRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            'userCustomer' => null,
        ]);
    }
}
