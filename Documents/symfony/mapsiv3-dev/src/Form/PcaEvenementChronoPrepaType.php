<?php
namespace App\Form;

use App\Entity\PcaEvenementChronoPrepa;
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

class PcaEvenementChronoPrepaType extends AbstractType
{
    public function __construct(PeopleRepository $PeopleRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
    }
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tache')
            ->add('TargetedAt')
            ->add('comment')
            ->add('responsable', EntityType::class, [
		        'placeholder' => 'Sélectionner le responsable',
	            'class' => People::class,
	            'required'   => false,
	            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
	            'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
				},
				'attr' => ['class' => 'select2field']
			])
            ->add('customer', EntityType::class, [
                'class' => MapsiCustomer::class,
                'choice_label' => 'id',
                'data' => $options['userCustomer'],
                ])	
            ->add('pcaevenement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PcaEvenementChronoPrepa::class,
            'userCustomer' => null
        ]);
    }
}
