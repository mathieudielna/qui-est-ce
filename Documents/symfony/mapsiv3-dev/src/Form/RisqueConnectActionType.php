<?php

namespace App\Form;

use App\Entity\Action;
use App\Entity\Risque;
use App\Entity\People;

use App\Repository\ActionRepository;
use App\Repository\RisqueRepository;
use App\Repository\PeopleRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RisqueConnectActionType extends AbstractType
{
	public function __construct(ActionRepository $ActionRepository,PeopleRepository $PeopleRepository)
    {
        $this->ActionRepository = $ActionRepository;
        $this->PeopleRepository = $PeopleRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppConnectActivite::class,
            'userCustomer' => null,
        ]);
    }
}
