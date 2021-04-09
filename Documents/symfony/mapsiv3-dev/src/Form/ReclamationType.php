<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\AspectEnv;
use App\Entity\Audit;
use App\Entity\RgpdAudit;
use App\Entity\RgpdViolation;
use App\Entity\RgpdAccess;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Activite;
use App\Entity\Site;
use App\Entity\Action;
use App\Entity\Impact;
use App\Entity\TypeAudit;
use App\Entity\Processus;
use App\Entity\TypeAspectEnv;
use App\Entity\TypeConformite;
use App\Entity\TypeReclamation;
use App\Entity\OuiNon;

use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\TierRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\ActiviteRepository;
use App\Repository\SiteRepository;
use App\Repository\ProcessusRepository;
use App\Repository\TypeReclamationRepository;
use App\Repository\OuiNonRepository;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ReclamationType extends AbstractType
{
    public function __construct(PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository,
								ActionRepository $ActionRepository,
                                TypeStatutRepository $TypeStatutRepository,
                                TypeConformiteRepository $TypeConformiteRepository,
                                ActiviteRepository $ActiviteRepository,
                                SiteRepository $SiteRepository,
                                ProcessusRepository $ProcessusRepository,
                                TypeReclamationRepository $TypeReclamationRepository,
                                OuiNonRepository $OuiNonRepository
	 						 	)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->TierRepository = $TierRepository;
        $this->ActiviteRepository = $ActiviteRepository;
        $this->SiteRepository = $SiteRepository;
        $this->ProcessusRepository = $ProcessusRepository;
        $this->TypeConformiteRepository = $TypeConformiteRepository;
        $this->TypeReclamationRepository = $TypeReclamationRepository;
        $this->OuiNonRepository = $OuiNonRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('commentaire')

            ->add('declarantnom')
            ->add('declaranttel')
            ->add('declarantemail')
           
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
                'placeholder' => 'Sélectionner le suppleant',
                'class' => People::class,
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('redacteur', EntityType::class, [
                'placeholder' => 'Sélectionner le rédacteur',
                'class' => People::class,
                'required'   => false,
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
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('sites', EntityType::class, [
                'class' => Site::class,
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'by_reference' => false,
                'choices' => $this->SiteRepository->findBy([
                    'customer' => $options['userCustomer']
                ]),
                'choice_label' => function (Site $site) {
                    return 'SIT-'.$site->getId() . ' ' . $site->getDesignation();
                    }
                ])
            ->add('typeconformite', EntityType::class, [
                'class' => TypeConformite::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'choices' => $this->TypeConformiteRepository->findByCustomer($options['userCustomer']),
                ])
            ->add('typereclamations', EntityType::class, [
                'class' => TypeReclamation::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'choices' => $this->TypeReclamationRepository->findByCustomer($options['userCustomer']),
                ])
            ->add('actions', EntityType::class, [
                'class' => Action::class,
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'by_reference' => false,
                'choices' => $this->ActionRepository->findBy([
                    'customer' => $options['userCustomer'],
                    'archive' => null
                ]),
                'choice_label' => function (Action $action) {
                    return 'AC-'.$action->getId() . ' ' . $action->getDesignation();
                    }
                ])
            ->add('processuses', EntityType::class, [
                'class' => Processus::class,
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'by_reference' => false,
                'choices' => $this->ProcessusRepository->findBy([
                    'customer' => $options['userCustomer']
                ]),
                'choice_label' => function (Processus $processus) {
                    return 'SIT-'.$processus->getId() . ' ' . $processus->getDesignation();
                    }
                ])
            ->add('anonyme', EntityType::class, [
                'class' => OuiNon::class,
                'choice_label' => 'designation',
                'expanded' => true,
                'required'   => false,
                'placeholder' => 'Non connu',
                'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
                ])
            ->add('information', EntityType::class, [
                'class' => OuiNon::class,
                'choice_label' => 'designation',
                'expanded' => true,
                'required'   => false,
                'placeholder' => 'Non connu',
                'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
            'userCustomer' => null,
            'userPeople' => null,
        ]);
    }
}
