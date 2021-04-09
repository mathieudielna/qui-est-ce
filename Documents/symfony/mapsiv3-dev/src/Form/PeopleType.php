<?php
namespace App\Form;

use App\Entity\People;
use App\Entity\Application;
use App\Entity\Activite;
use App\Entity\Metier;
use App\Entity\Site;
use App\Entity\Action;


use App\Repository\MetierRepository;
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

class PeopleType extends AbstractType
{
    

     public function __construct(MetierRepository $metierRepository,
     								SiteRepository $SiteRepository,
     								PeopleRepository $PeopleRepository,
     								ActionRepository $ActionRepository)
    {
        $this->metierRepository = $metierRepository;
        $this->SiteRepository = $SiteRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->ActionRepository = $ActionRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('role')
            ->add('email')
            ->add('cellular')
            ->add('commentaire')
            ->add('n1', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Sélectionner le supérieur',
            'required'   => false,
			'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
            ->add('metier', EntityType::class, [
            'class' => Metier::class,
            'choice_label' => 'designation',
            'placeholder' => 'Sélectionner le métier',
            'required'   => false,
			'choices' => $this->metierRepository->findByCustomer($options['userCustomer']),
			])
			->add('site', EntityType::class, [
            'class' => Site::class,
            'choice_label' => 'designation',
            'placeholder' => 'Sélectionner le site de rattachement',
            'required'   => false,
			'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
			])
			->add('actionsresponsable', EntityType::class, [
            'class' => Action::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner',
			'by_reference' => false,
			'required'   => false,
			'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Action $action) {
				return 'ACT-'.$action->getId() . ' ' . $action->getDesignation();
				}
			])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => People::class,
            'userCustomer' => null,
        ]);
    }
}
