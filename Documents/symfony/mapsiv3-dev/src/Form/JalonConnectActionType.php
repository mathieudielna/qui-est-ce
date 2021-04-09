<?php

namespace App\Form;
use App\Entity\Action;
use App\Entity\JalonConnectAction;
use App\Entity\MapsiCustomer;
use App\Entity\People;
use App\Entity\TypeRag;

use App\Repository\ActionRepository;
use App\Repository\JalonConnectActionRepository;
use App\Repository\MapsiCustomerRepository;
use App\Repository\PeopleRepository;
use App\Repository\TypeRagRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;


class JalonConnectActionType extends AbstractType
{
	public function __construct(PeopleRepository $PeopleRepository,
								ActionRepository $ActionRepository,
								TypeRagRepository $TypeRagRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
		$this->TypeRagRepository = $TypeRagRepository;
		$this->ActionRepository = $ActionRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jalon', null,[
            	'attr' => [
                 'placeholder' => 'Jalon'
				 ]])
			->add('commentaire', null,[
            	'attr' => [
                 'placeholder' => 'Commentaire'
				 ]])
			->add('description', null,[
				'attr' => [
				'placeholder' => 'Description'
				]])
			->add('progression', null, [
		            'constraints' => [
		                new LessThanOrEqual(['value' => 100, 'message' => "La progression doit être inférieur ou égale à 100%"]),
		            ],
		            'attr' => [
			                 'placeholder' => 'Progression',
						 ]
		        ])
            ->add('datedebut', DateType::class, [
		    	'widget' => 'single_text',
		    	'required'   => true,
				])
            ->add('date', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => true,
				])
			->add('datereelle', DateType::class, [
		    	'widget' => 'single_text',
		    	'required'   => true,
				])
			->add('daterevue', DateType::class, [
		    	'widget' => 'single_text',
		    	'required'   => true,
				])
			->add('budget', null,[
            	'attr' => [
                 'placeholder' => 'Budget'
				 ]])
			->add('etp', null,[
            	'attr' => [
                 'placeholder' => 'Charge RH'
				 ]])
			->add('fini', CheckboxType::class, [
			    'label'    => 'Jalon / livrable terminé ?',
			    'required' => false,
				 ])
			->add('topjalon', CheckboxType::class, [
			    'label'    => 'Top jalon',
			    'required' => false,
				 ])
			->add('responsable', EntityType::class, [
		        'placeholder' => 'Sélectionner le responsable',
	            'class' => People::class,
				'required'   => true,
	            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
	            'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
				}
			])
			->add('suppleant', EntityType::class, [
		        'placeholder' => 'Sélectionner le suppleant',
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
                'placeholder' => 'Sélectionner les contributeurs',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
            ])
			->add('action', EntityType::class, [
			'class' => Action::class,
			'placeholder' => 'Sélectionner',
			'required'   => true,
			'expanded' => false,
			'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),			
			'choice_label' => function (Action $action) {
				return 'AC-'.$action->getId() . ' ' . $action->getDesignation();
				}
			])
			->add('rag', EntityType::class, [
            'class' => TypeRag::class,
            'choice_label' => 'designation',
            'expanded' => false,
			'required'   => false,
            'placeholder' => 'Sélectionner',
			'choices' => $this->TypeRagRepository->findByCustomer($options['userCustomer']),			
			])
			// ->add('mcustomer', EntityType::class, [
            // 'class' => MapsiCustomer::class,
            // 'choice_label' => 'id',
			// 'data' => $options['userCustomer'],
			// ])	 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JalonConnectAction::class,
            'userCustomer' => null,
			'userPeople' => null
        ]);
    }
}
