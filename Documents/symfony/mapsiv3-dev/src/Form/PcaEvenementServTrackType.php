<?php

namespace App\Form;

use App\Entity\PcaEvenementServTrack;
use App\Entity\PcaEvenement;
use App\Entity\Systeme;
use App\Entity\Criticite;
use App\Entity\TypeStatutPca;

use App\Repository\SystemeRepository;
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

class PcaEvenementServTrackType extends AbstractType
{
	public function __construct(SystemeRepository $ApplicationRepository, 
								PcaEvenementRepository $PcaEvenementRepository,
								CriticiteRepository $CriticiteRepository,
								TypeStatutPcaRepository $TypeStatutPcaRepository)
    {
        $this->SystemeRepository = $ApplicationRepository;
        $this->PcaEvenementRepository = $PcaEvenementRepository;
        $this->CriticiteRepository = $CriticiteRepository;
        $this->TypeStatutPcaRepository = $TypeStatutPcaRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('systeme', EntityType::class, [
            'class' => Systeme::class,
            'choice_label' => 'designation',
            'required'   => true,
            'placeholder' => 'Sélectionner un systeme',
            'attr' => ['class' => 'appfield'],
            'choices' => $this->SystemeRepository->findByCustomer($options['userCustomer']),
			])
			 ->add('dima', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'Sélectionner le DIMA',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
            ->add('pdma', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'Sélectionner le PDMA',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
			->add('statut', EntityType::class, [
            'class' => TypeStatutPca::class,
            'placeholder' => 'Sélectionner le statut',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->TypeStatutPcaRepository->findByCustomer($options['userCustomer']),
			])
			->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PcaEvenementServTrack::class,
                'userCustomer' => null,
        ]);
    }
}
