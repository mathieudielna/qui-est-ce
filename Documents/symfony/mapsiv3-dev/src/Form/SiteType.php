<?php

namespace App\Form;

use App\Entity\Site;
use App\Entity\TypeSite;
use App\Entity\People;
use App\Entity\Action;

use App\Repository\TypeSiteRepository;
use App\Repository\PeopleRepository;
use App\Repository\SiteRepository;
use App\Repository\ActionRepository;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SiteType extends AbstractType
{
	
	 public function __construct(TypeSiteRepository $TypeSiteRepository, PeopleRepository $PeopleRepository, SiteRepository $SiteRepository, ActionRepository $ActionRepository)
    {
        $this->TypeSiteRepository = $TypeSiteRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->SiteRepository = $SiteRepository;
        $this->ActionRepository = $ActionRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('telstandard')
            ->add('adresse')
            ->add('codepostal')
            ->add('ville')
            ->add('latlng')
            ->add('commentaire')
            ->add('typedesite', EntityType::class, [
            'class' => TypeSite::class,
            'choice_label' => 'designation',
            'required'   => false,
            'placeholder' => 'Sélectionner le type de site',
			'choices' => $this->TypeSiteRepository->findByCustomer($options['userCustomer']),
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
			->add('sitesecours', EntityType::class, [
            'class' => Site::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
			'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
			])
			->add('actions', EntityType::class, [
            'class' => Action::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Choose an option',
			'required'   => false,
			'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
			'by_reference' => false,
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
            'data_class' => Site::class,
            'userCustomer' => null,
        ]);
    }
}
