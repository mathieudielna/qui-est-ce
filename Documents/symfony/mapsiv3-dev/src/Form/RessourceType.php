<?php

namespace App\Form;

use App\Entity\Ressource;
use App\Entity\Site;
use App\Entity\People;

use App\Repository\PeopleRepository;
use App\Repository\SiteRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RessourceType extends AbstractType
{
	public function __construct(SiteRepository $SiteRepository,PeopleRepository $PeopleRepository)
    {
        $this->SiteRepository = $SiteRepository;
        $this->PeopleRepository = $PeopleRepository;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('commentaire')
            ->add('site', EntityType::class, [
            'class' => Site::class,
            'choice_label' => 'designation',
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
            'placeholder' => 'Sélectionner un site',
            'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Site $site) {
				return 'SIT-'.$site->getId() . ' ' . $site->getDesignation();
				}
            ])
            ->add('responsable', EntityType::class, [
            'placeholder' => 'Sélectionner le responsable',
            'class' => People::class,
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                }
            ])
            ->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner le suppléant',
            'required'   => false,
            'attr' => [
                'class' => "select2",
            ],
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
            'attr' => [
                'class' => "select2",
            ],
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
            'data_class' => Ressource::class,
            'userCustomer' => null,
        ]);
    }
}
