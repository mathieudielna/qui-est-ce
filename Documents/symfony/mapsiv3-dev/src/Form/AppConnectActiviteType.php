<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Criticite;
use App\Entity\Application;
use App\Entity\AppConnectActivite;

use App\Repository\ActiviteRepository;
use App\Repository\CriticiteRepository;
use App\Repository\AppConnectActiviteRepository;
use App\Repository\ApplicationRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AppConnectActiviteType extends AbstractType
{
	public function __construct(ActiviteRepository $ActiviteRepository,
							    CriticiteRepository $CriticiteRepository,
							    AppConnectActiviteRepository $AppConnectActiviteRepository,
							    ApplicationRepository $ApplicationRepository)
    {
        $this->ActiviteRepository = $ActiviteRepository;
        $this->CriticiteRepository = $CriticiteRepository;
        $this->AppConnectActiviteRepository = $AppConnectActiviteRepository;
        $this->ApplicationRepository = $ApplicationRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('application', EntityType::class, [
            'class' => Application::class,
            'choice_label' => 'designation',
            'required'   => true,
            'placeholder' => 'Application',
            'attr' => ['class' => 'select22'],
            'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			]) 
            ->add('activite', EntityType::class, [
            'class' => Activite::class,
            'required'   => true,
            'placeholder' => 'Activité',
            'choices' => $this->ActiviteRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Activite $activite) {
				return 'A-'.$activite->getId() . ' ' . $activite->getDesignation();
				}
			]) 
            ->add('dima', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'DIMA',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
            ->add('pdma', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'PDMA',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
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
