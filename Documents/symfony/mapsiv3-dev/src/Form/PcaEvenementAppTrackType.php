<?php

namespace App\Form;

use App\Entity\PcaEvenementAppTrack;
use App\Entity\PcaEvenement;
use App\Entity\Application;
use App\Entity\Criticite;
use App\Entity\TypeStatutPca;

use App\Repository\ApplicationRepository;
use App\Repository\PcaEvenementRepository;
use App\Repository\CriticiteRepository;
use App\Repository\TypeStatutPcaRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PcaEvenementAppTrackType extends AbstractType
{
	public function __construct(ApplicationRepository $ApplicationRepository, 
								PcaEvenementRepository $PcaEvenementRepository,
								CriticiteRepository $CriticiteRepository,
								TypeStatutPcaRepository $TypeStatutPcaRepository)
    {
        $this->ApplicationRepository = $ApplicationRepository;
        $this->PcaEvenementRepository = $PcaEvenementRepository;
        $this->CriticiteRepository = $CriticiteRepository;
        $this->TypeStatutPcaRepository = $TypeStatutPcaRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('application', EntityType::class, [
            'class' => Application::class,
            'choice_label' => 'designation',
            'required'   => true,
            'placeholder' => 'Sélectionner une application',
            'attr' => ['class' => 'appfield'],
            'choices' => $this->ApplicationRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('dima', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'Sélectionner le DIMA',
            'choice_label' => 'designation',
            'required'   => false,
            'attr' => ['class' => 'appfield'],
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
            ->add('pdma', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'Sélectionner le PDMA',
            'choice_label' => 'designation',
            'required'   => false,
            'attr' => ['class' => 'appfield'],
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
			->add('statut', EntityType::class, [
            'class' => TypeStatutPca::class,
            'placeholder' => 'Sélectionner le statut',
            'choice_label' => 'designation',
            'required'   => false,
            'attr' => ['class' => 'appfield'],
			'choices' => $this->TypeStatutPcaRepository->findByCustomer($options['userCustomer']),
			])
			->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PcaEvenementAppTrack::class,
                'userCustomer' => null,
        ]);
    }
}
