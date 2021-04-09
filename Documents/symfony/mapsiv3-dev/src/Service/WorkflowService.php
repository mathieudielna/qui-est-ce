<?php
namespace App\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\HttpFoundation\Response;

class WorkflowService
{
    /**
     * @var Registry
    */
    private $workflows;
    public function __construct(Registry $workflows)
    {
        $this->state_machines = $workflows;
    }

    public function workflowService($entite, $statut, $request, $manager)
    {
       
        $workflow = $this->state_machines->get($entite);
        
            if($workflow->can($entite, $statut)) {
                $manager = $entite->getDoctrine()->getManager();
                $workflow->apply($entite, $statut);
                $entite->setValidatedAt(new \DateTime());
                // $entite->setValidator($this->getUser()->getpeople());
                $entite->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
                $manager->persist($entite);
                $manager->flush();
                
            }
       
          
    }
}