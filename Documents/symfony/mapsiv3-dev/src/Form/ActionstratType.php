<?php
namespace App\Form;

use App\Entity\Actionstrat;
use App\Entity\Action;

use App\Repository\ActionRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ActionstratType extends AbstractType
{
	public function __construct(ActionRepository $ActionRepository
	 						 )
    {
        $this->ActionRepository = $ActionRepository;
    }
		
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('code')
            ->add('actions', EntityType::class, [
            'class' => Action::class,
			'multiple' => 'true',
			'placeholder' => 'Sélectionner une action',
			'required'   => false,
			'by_reference' => false,
			'attr' => ['class' => 'actfield'],
            'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Action $action) {
				return 'ACT-'.$action->getId() . ' ' . $action->getDesignation() . ' ' . $action->getProgression().' %';
				}
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actionstrat::class,
            'userCustomer' => null,
        ]);
    }
}
