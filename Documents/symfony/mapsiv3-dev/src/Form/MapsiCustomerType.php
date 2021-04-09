<?php
namespace App\Form;

use App\Entity\MapsiCustomer;

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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\PropertyAccess\PropertyPath;

class MapsiCustomerType extends AbstractType
{
    public function __construct(PeopleRepository $PeopleRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', null, [
                'attr' => ['class' => 'title-input','placeholder' => 'Désignation'],
                ])
            ->add('sigle', null, [
                'attr' => ['placeholder' => 'Sigle'],
                ])
            ->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une description des activités de l\'entreprise',
                    'class' => 'fiche'
                )
                ])
            ->add('commentaire', null, [
                'attr' => array(
                    'placeholder' => 'Commentaire',
                    'class' => 'fiche'
                )
                ])
            ->add('adresse1', null, [
                'attr' => ['placeholder' => 'Adresse 1'],
                ])
            ->add('adresse2', null, [
                'attr' => ['placeholder' => 'Adresse 2'],
                ])
            ->add('adresse3', null, [
                'attr' => ['placeholder' => 'Adresse 3'],
                ])
            ->add('codepostal', null, [
                'attr' => ['placeholder' => 'Code postal'],
                ])
            ->add('ville', null, [
                'attr' => ['placeholder' => 'Ville'],
                ])
            ->add('www')
            ->add('Messagestart')
            ->add('dpo', EntityType::class, [
                'placeholder' => 'Sélectionner le collaborateur',
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
            ->add('rse', EntityType::class, [
                'placeholder' => 'Sélectionner le collaborateur',
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
            ->add('responsable', EntityType::class, [
                'placeholder' => 'Sélectionner le collaborateur',
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
            ->add('imageFile', VichImageType::class, [
	            'required' => false,
	            'allow_delete' => true,
	            'download_uri' => true,
	            'image_uri' => true,
	            'download_label' => 'Télécharger',
				])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MapsiCustomer::class,
            'userCustomer' => null
        ]);
    }
}
