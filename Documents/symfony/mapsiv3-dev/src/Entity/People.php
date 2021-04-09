<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 */
class People
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cellular;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="responsable")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activite", mappedBy="suppleant")
     */
    private $activitessuppleant;

        /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="responsable")
     */
    private $systemesresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="suppleant")
     */
    private $systemessuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="responsable")
     */
    private $applicationsresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="suppleant")
     */
    private $applicationssuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="responsable")
     */
    private $fluxsresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="suppleant")
     */
    private $fluxssuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="responsable")
     */
    private $sitesresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="suppleant")
     */
    private $sitessuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Processus", mappedBy="responsable")
     */
    private $processusesresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Processus", mappedBy="suppleant")
     */
    private $processusessuppleant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activite", mappedBy="peoples")
     */
    private $activitespeople;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Action", mappedBy="responsable")
     */
    private $actionsresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Action", mappedBy="suppleant")
     */
    private $actionssuppleant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", mappedBy="people")
     */
    private $actionspeople;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Risque", mappedBy="responsable")
     */
    private $risquesresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Risque", mappedBy="suppleant")
     */
    private $risquessuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="responsable")
     */
    private $objectifsresponsable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MapsiCustomer", inversedBy="people")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Metier", inversedBy="peoples")
     */
    private $metier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="peoples")
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="pilote")
     */
    private $projets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="responsable")
     */
    private $objetMetiers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="suppleant")
     */
    private $objetMetiersSuppleants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\People", inversedBy="n11")
     */
    private $n1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\People", mappedBy="n1")
     */
    private $n11;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Program", mappedBy="pilote")
     */
    private $programs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Axe", mappedBy="responsable")
     */
    private $axesresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Axe", mappedBy="suppleant")
     */
    private $axessuppleant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="people")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JalonConnectAction", mappedBy="responsable")
     */
    private $jalonresponsable;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="pilotes")
     */
    private $rgpdAccesses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="declarant")
     */
    private $rgpdViolations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="contributeur")
     */
    private $rgpdContriViolations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAudit", mappedBy="responsable")
     */
    private $rgpdAudits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flux", mappedBy="publisher")
     */
    private $fluxes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetMetier", mappedBy="publisher")
     */
    private $objetMetierspublisher;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="responsable")
     */
    private $rgpdAccessesResponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="suppleant")
     */
    private $rgpdAccessesSuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdAccess", mappedBy="publisher")
     */
    private $rgpdAccessesPublisher;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="responsable")
     */
    private $rgpdViolationsresponsable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="suppleant")
     */
    private $rgpdViolationsSuppleant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RgpdViolation", mappedBy="publisher")
     */
    private $rgpdViolationsPublisher;

    /**
     * @ORM\OneToMany(targetEntity=Anomalie::class, mappedBy="responsable")
     */
    private $anomaliesresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Anomalie::class, mappedBy="suppleant")
     */
    private $anomaliessuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Anomalie::class, mappedBy="contributeurs")
     */
    private $contributeursanomalies;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="auteur")
     */
    private $auteurcontrole;

    /**
     * @ORM\ManyToMany(targetEntity=RgpdAudit::class, mappedBy="contributeurs")
     */
    private $rgpdAuditscontributeurs;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenement::class, mappedBy="responsable")
     */
    private $pcaEvenementsResponbable;


    /**
     * @ORM\ManyToMany(targetEntity=PcaEvenement::class, mappedBy="contributeurs")
     */
    private $pcaEvenementsContributeurs;

    /**
     * @ORM\OneToMany(targetEntity=MapsiCustomer::class, mappedBy="dpo")
     */
    private $mapsiCustomersDPO;

    /**
     * @ORM\OneToMany(targetEntity=MapsiCustomer::class, mappedBy="rse")
     */
    private $mapsiCustomerRSE;

    /**
     * @ORM\OneToMany(targetEntity=MapsiCustomer::class, mappedBy="responsable")
     */
    private $mapsiCustomerResponsable;

    /**
     * @ORM\OneToMany(targetEntity=Policy::class, mappedBy="responsable")
     */
    private $policiesresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Policy::class, mappedBy="suppleant")
     */
    private $policiessuppleant;

    /**
     * @ORM\OneToMany(targetEntity=Policy::class, mappedBy="publisher")
     */
    private $policiespublisher;

    /**
     * @ORM\OneToMany(targetEntity=Risque::class, mappedBy="publisher")
     */
    private $risquespublisher;

    /**
     * @ORM\OneToMany(targetEntity=Activite::class, mappedBy="publisher")
     */
    private $publisheractivites;

    /**
     * @ORM\OneToMany(targetEntity=Processus::class, mappedBy="Publisher")
     */
    private $publishedprocessuses;

    /**
     * @ORM\OneToMany(targetEntity=Objectif::class, mappedBy="Publisher")
     */
    private $objectifspublisher;

    /**
     * @ORM\OneToMany(targetEntity=PcaEvenementChronoPrepa::class, mappedBy="responsable")
     */
    private $pcaEvenementChronoPrepas;

    /**
     * @ORM\ManyToMany(targetEntity=Flux::class, mappedBy="peoples")
     */
    private $peoplesfluxes;

    /**
     * @ORM\OneToMany(targetEntity=Metier::class, mappedBy="directeur")
     */
    private $metiersdirecteur;

    /**
     * @ORM\OneToMany(targetEntity=Metier::class, mappedBy="suppleant")
     */
    private $metierssuppleant;

    /**
     * @ORM\OneToMany(targetEntity=Metier::class, mappedBy="Publisher")
     */
    private $metierspublisher;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PublishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=People::class)
     */
    private $Publisher;

    /**
     * @ORM\OneToMany(targetEntity=Site::class, mappedBy="Publisher")
     */
    private $sitespublisher;

    /**
     * @ORM\OneToMany(targetEntity=Tier::class, mappedBy="responsable")
     */
    private $tiersresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Tier::class, mappedBy="suppleant")
     */
    private $tierssuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Tier::class, mappedBy="peoples")
     */
    private $tierspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Tier::class, mappedBy="Publisher")
     */
    private $tierspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="responsable")
     */
    private $ressourcesresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="suppleant")
     */
    private $ressourcessuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Ressource::class, mappedBy="peoples")
     */
    private $ressourcespeoples;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="Publisher")
     */
    private $ressourcespublisher;

    /**
     * @ORM\ManyToMany(targetEntity=Processus::class, mappedBy="peoples")
     */
    private $processusespeoples;

    /**
     * @ORM\ManyToMany(targetEntity=ObjetMetier::class, mappedBy="peoples")
     */
    private $objetmetierspeoples;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="peoples")
     */
    private $applicationspeoples;

    /**
     * @ORM\ManyToMany(targetEntity=Systeme::class, mappedBy="peoples")
     */
    private $systemespeoples;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="publisher")
     */
    private $applicationpublisher;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="suppleant")
     */
    private $projetsuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Projet::class, mappedBy="peoples")
     */
    private $projetspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="suppleant")
     */
    private $programsuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Program::class, mappedBy="peoples")
     */
    private $programspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Systeme::class, mappedBy="publisher")
     */
    private $systemespublisher;

    /**
     * @ORM\OneToMany(targetEntity=JalonConnectAction::class, mappedBy="publisher")
     */
    private $jalonConnectActionspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="publisher")
     */
    private $programspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="publisher")
     */
    private $projetspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Action::class, mappedBy="publisher")
     */
    private $actionspublisher;

    /**
     * @ORM\ManyToMany(targetEntity=JalonConnectAction::class, mappedBy="peoples")
     */
    private $jalonConnectActionspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Flux::class, mappedBy="validator")
     */
    private $fluxesvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Activite::class, mappedBy="validator")
     */
    private $activitesvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Processus::class, mappedBy="validator")
     */
    private $processusesvalidator;

    /**
     * @ORM\OneToMany(targetEntity=ObjetMetier::class, mappedBy="validator")
     */
    private $objetmetiersvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="validator")
     */
    private $applicationsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Systeme::class, mappedBy="validator")
     */
    private $systemesvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="responsable")
     */
    private $programsresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="validator")
     */
    private $programsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="responsable")
     */
    private $projetsreponsable;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="validator")
     */
    private $projetsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Action::class, mappedBy="validator")
     */
    private $actionsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=JalonConnectAction::class, mappedBy="suppleant")
     */
    private $jalonConnectActionssuppleant;

    /**
     * @ORM\OneToMany(targetEntity=JalonConnectAction::class, mappedBy="validator")
     */
    private $jalonConnectActionsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Audit::class, mappedBy="responsable")
     */
    private $auditsresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Audit::class, mappedBy="suppleant")
     */
    private $auditssuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Audit::class, mappedBy="Peoples")
     */
    private $auditspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Audit::class, mappedBy="validator")
     */
    private $auditsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Audit::class, mappedBy="publisher")
     */
    private $auditspublisher;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Gedmo\Slug(fields={"firstname"})
     * 
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Dysfonctionnement::class, mappedBy="declarant")
     */
    private $dysfonctionnementsdeclarant;


    /**
     * @ORM\OneToMany(targetEntity=Dysfonctionnement::class, mappedBy="responsable")
     */
    private $dysfonctionnementsresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Dysfonctionnement::class, mappedBy="suppleant")
     */
    private $dysfonctionnementssuppleant;

    /**
     * @ORM\OneToMany(targetEntity=Dysfonctionnement::class, mappedBy="publisher")
     */
    private $dysfonctionnementspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Dysfonctionnement::class, mappedBy="validator")
     */
    private $dysfonctionnementsvalidator;

    /**
     * @ORM\ManyToMany(targetEntity=Dysfonctionnement::class, mappedBy="peoples")
     */
    private $dysfonctionnementspeoples;

    /**
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="responsable")
     */
    private $aspectEnvsresponsable;

    /**
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="suppleant")
     */
    private $aspectEnvssuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=AspectEnv::class, mappedBy="peoples")
     */
    private $aspectEnvspeoples;

    /**
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="validator")
     */
    private $aspectEnvsValidator;

    /**
     * @ORM\OneToMany(targetEntity=AspectEnv::class, mappedBy="publisher")
     */
    private $aspectEnvspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Flux::class, mappedBy="redacteur")
     */
    private $fluxesredacteur;

    /**
     * @ORM\OneToMany(targetEntity=ObjetMetier::class, mappedBy="redacteur")
     */
    private $objetMetiersredacteur;

    /**
     * @ORM\OneToMany(targetEntity=VisiteSite::class, mappedBy="responsable")
     */
    private $visitesitesresponsable;

    /**
     * @ORM\OneToMany(targetEntity=VisiteSite::class, mappedBy="suppleant")
     */
    private $visitesitessuppleant;

    /**
     * @ORM\OneToMany(targetEntity=VisiteSite::class, mappedBy="publisher")
     */
    private $visitesitespublisher;

    /**
     * @ORM\ManyToMany(targetEntity=VisiteSite::class, mappedBy="peoples")
     */
    private $visitesitespeoples;

    /**
     * @ORM\OneToMany(targetEntity=VisiteSite::class, mappedBy="validator")
     */
    private $visitesitevalidator;

    /**
     * @ORM\OneToMany(targetEntity=Objectif::class, mappedBy="suppleant")
     */
    private $objectifssuppleant;

    /**
     * @ORM\OneToMany(targetEntity=Objectif::class, mappedBy="validator")
     */
    private $objectifsvalidator;

    /**
     * @ORM\ManyToMany(targetEntity=Objectif::class, mappedBy="peoples")
     */
    private $objectifspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="responsable")
     */
    private $reclamationsresponsable;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="peoples")
     */
    private $reclamationspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="publisher")
     */
    private $reclamationspublisher;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="validator")
     */
    private $reclamationsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="suppleant")
     */
    private $reclamationspeople;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="redacteur")
     */
    private $reclamationsredacteur;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="responsable")
     */
    private $evenementsresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="suppleant")
     */
    private $evenementssuppleant;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="peoples")
     */
    private $evenementspeoples;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="validator")
     */
    private $evenementsvalidator;

    /**
     * @ORM\OneToMany(targetEntity=Processus::class, mappedBy="redacteur")
     */
    private $processusesredacteur;

    /**
     * @ORM\OneToMany(targetEntity=Metier::class, mappedBy="responsable")
     */
    private $metiersresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="responsable")
     */
    private $controlesresponsable;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="suppleant")
     */
    private $controlessuppleant;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="redacteur")
     */
    private $applicationsredacteur;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Risque::class, mappedBy="peoples")
     */
    private $risquespeoples;

    /**
     * @ORM\ManyToMany(targetEntity=Controle::class, mappedBy="peoples")
     */
    private $controlespeoples;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="publisher")
     */
    private $controlespublisher;

    /**
     * @ORM\OneToMany(targetEntity=Activite::class, mappedBy="redacteur")
     */
    private $activitesredacteur;

    /**
     * @ORM\OneToMany(targetEntity=VisiteSite::class, mappedBy="redacteur")
     */
    private $visiteSitesRedacteur;


   
    public function __construct()
    {

        $this->activites = new ArrayCollection();
        $this->activitessuppleant = new ArrayCollection();
        $this->systemesresponsable = new ArrayCollection();
        $this->systemessuppleant = new ArrayCollection();
        $this->applicationsresponsable = new ArrayCollection();
        $this->applicationssuppleant = new ArrayCollection();
        $this->fluxsresponsable = new ArrayCollection();
        $this->fluxssuppleant = new ArrayCollection();
        $this->sitesresponsable = new ArrayCollection();
        $this->sitessuppleant = new ArrayCollection();
        $this->processusesresponsable = new ArrayCollection();
        $this->processusessuppleant = new ArrayCollection();
        $this->activitespeople = new ArrayCollection();
        $this->actionsresponsable = new ArrayCollection();
        $this->actionssuppleant = new ArrayCollection();
        $this->actionspeople = new ArrayCollection();
        $this->risquesresponsable = new ArrayCollection();
        $this->risquessuppleant = new ArrayCollection();
        $this->objectifsresponsable = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->objetMetiers = new ArrayCollection();
        $this->objetMetiersSuppleants = new ArrayCollection();
        $this->n11 = new ArrayCollection();
        $this->programs = new ArrayCollection();
        $this->axesresponsable = new ArrayCollection();
        $this->axessuppleant = new ArrayCollection();
        $this->jalonresponsable = new ArrayCollection();
        $this->rgpdAccesses = new ArrayCollection();
        $this->rgpdViolations = new ArrayCollection();
        $this->rgpdContriViolations = new ArrayCollection();
        $this->rgpdAudits = new ArrayCollection();
        $this->fluxes = new ArrayCollection();
        $this->objetMetierspublisher = new ArrayCollection();
        $this->rgpdAccessesResponsable = new ArrayCollection();
        $this->rgpdAccessesSuppleant = new ArrayCollection();
        $this->rgpdAccessesPublisher = new ArrayCollection();
        $this->rgpdViolationsresponsable = new ArrayCollection();
        $this->rgpdViolationsSuppleant = new ArrayCollection();
        $this->rgpdViolationsPublisher = new ArrayCollection();
        $this->anomaliesresponsable = new ArrayCollection();
        $this->anomaliessuppleant = new ArrayCollection();
        $this->contributeursanomalies = new ArrayCollection();
        $this->auteurcontrole = new ArrayCollection();
        $this->rgpdAuditscontributeurs = new ArrayCollection();
        $this->pcaEvenementsResponbable = new ArrayCollection();
        $this->pcaEvenementsContributeurs = new ArrayCollection();
        $this->mapsiCustomersDPO = new ArrayCollection();
        $this->mapsiCustomerRSE = new ArrayCollection();
        $this->mapsiCustomerResponsable = new ArrayCollection();
        $this->policiesresponsable = new ArrayCollection();
        $this->policiessuppleant = new ArrayCollection();
        $this->policiespublisher = new ArrayCollection();
        $this->risquespublisher = new ArrayCollection();
        $this->publisheractivites = new ArrayCollection();
        $this->publishedprocessuses = new ArrayCollection();
        $this->objectifspublisher = new ArrayCollection();
        $this->pcaEvenementChronoPrepas = new ArrayCollection();
        $this->peoplesfluxes = new ArrayCollection();
        $this->metiersdirecteur = new ArrayCollection();
        $this->metierssuppleant = new ArrayCollection();
        $this->metierspublisher = new ArrayCollection();
        $this->sitespublisher = new ArrayCollection();
        $this->tiersresponsable = new ArrayCollection();
        $this->tierssuppleant = new ArrayCollection();
        $this->tierspeoples = new ArrayCollection();
        $this->tierspublisher = new ArrayCollection();
        $this->ressourcesresponsable = new ArrayCollection();
        $this->ressourcessuppleant = new ArrayCollection();
        $this->ressourcespeoples = new ArrayCollection();
        $this->ressourcespublisher = new ArrayCollection();
        $this->processusespeoples = new ArrayCollection();
        $this->objetmetierspeoples = new ArrayCollection();
        $this->applicationspeoples = new ArrayCollection();
        $this->systemespeoples = new ArrayCollection();
        $this->applicationpublisher = new ArrayCollection();
        $this->projetsuppleant = new ArrayCollection();
        $this->projetspeoples = new ArrayCollection();
        $this->programsuppleant = new ArrayCollection();
        $this->programspeoples = new ArrayCollection();
        $this->systemespublisher = new ArrayCollection();
        $this->jalonConnectActionspublisher = new ArrayCollection();
        $this->programspublisher = new ArrayCollection();
        $this->projetspublisher = new ArrayCollection();
        $this->actionspublisher = new ArrayCollection();
        $this->jalonConnectActionspeoples = new ArrayCollection();
        $this->fluxesvalidator = new ArrayCollection();
        $this->activitesvalidator = new ArrayCollection();
        $this->processusesvalidator = new ArrayCollection();
        $this->objetmetiersvalidator = new ArrayCollection();
        $this->applicationsvalidator = new ArrayCollection();
        $this->systemesvalidator = new ArrayCollection();
        $this->programsresponsable = new ArrayCollection();
        $this->programsvalidator = new ArrayCollection();
        $this->projetsreponsable = new ArrayCollection();
        $this->projetsvalidator = new ArrayCollection();
        $this->actionsvalidator = new ArrayCollection();
        $this->jalonConnectActionssuppleant = new ArrayCollection();
        $this->jalonConnectActionsvalidator = new ArrayCollection();
        $this->auditsresponsable = new ArrayCollection();
        $this->auditssuppleant = new ArrayCollection();
        $this->auditspeoples = new ArrayCollection();
        $this->auditsvalidator = new ArrayCollection();
        $this->auditspublisher = new ArrayCollection();
        $this->dysfonctionnementsdeclarant = new ArrayCollection();
        $this->dysfonctionnementsresponsable = new ArrayCollection();
        $this->dysfonctionnementssuppleant = new ArrayCollection();
        $this->dysfonctionnementspublisher = new ArrayCollection();
        $this->dysfonctionnementsvalidator = new ArrayCollection();
        $this->dysfonctionnementspeoples = new ArrayCollection();
        $this->aspectEnvsresponsable = new ArrayCollection();
        $this->aspectEnvssuppleant = new ArrayCollection();
        $this->aspectEnvspeoples = new ArrayCollection();
        $this->aspectEnvsValidator = new ArrayCollection();
        $this->aspectEnvspublisher = new ArrayCollection();
        $this->fluxesredacteur = new ArrayCollection();
        $this->objetMetiersredacteur = new ArrayCollection();
        $this->visitesitesresponsable = new ArrayCollection();
        $this->visitesitessuppleant = new ArrayCollection();
        $this->visitesitespublisher = new ArrayCollection();
        $this->visitesitespeoples = new ArrayCollection();
        $this->visitesitevalidator = new ArrayCollection();
        $this->objectifssuppleant = new ArrayCollection();
        $this->objectifsvalidator = new ArrayCollection();
        $this->objectifspeoples = new ArrayCollection();
        $this->reclamationsresponsable = new ArrayCollection();
        $this->reclamationspeoples = new ArrayCollection();
        $this->reclamationspublisher = new ArrayCollection();
        $this->reclamationsvalidator = new ArrayCollection();
        $this->reclamationspeople = new ArrayCollection();
        $this->reclamationsredacteur = new ArrayCollection();
        $this->evenementsresponsable = new ArrayCollection();
        $this->evenementssuppleant = new ArrayCollection();
        $this->evenementspeoples = new ArrayCollection();
        $this->evenementsvalidator = new ArrayCollection();
        $this->processusesredacteur = new ArrayCollection();
        $this->metiersresponsable = new ArrayCollection();
        $this->controlesresponsable = new ArrayCollection();
        $this->controlessuppleant = new ArrayCollection();
        $this->applicationsredacteur = new ArrayCollection();
        $this->risquespeoples = new ArrayCollection();
        $this->controlespeoples = new ArrayCollection();
        $this->controlespublisher = new ArrayCollection();
        $this->activitesredacteur = new ArrayCollection();
        $this->visiteSitesRedacteur = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCellular(): ?string
    {
        return $this->cellular;
    }

    public function setCellular(?string $cellular): self
    {
        $this->cellular = $cellular;

        return $this;
    }

       
     /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }
    
    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setManager($this);
        }

        return $this;
    }
    
    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getManager() === $this) {
                $activite->setManager(null);
            }
        }

        return $this;
    }
    
         /**
     * @return Collection|Activite[]
     */
    public function getcriticites(): Collection
    {
        return $this->activites;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitessuppleant(): Collection
    {
        return $this->activitessuppleant;
    }

    public function addActivitessuppleant(Activite $activitessuppleant): self
    {
        if (!$this->activitessuppleant->contains($activitessuppleant)) {
            $this->activitessuppleant[] = $activitessuppleant;
            $activitessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeActivitessuppleant(Activite $activitessuppleant): self
    {
        if ($this->activitessuppleant->contains($activitessuppleant)) {
            $this->activitessuppleant->removeElement($activitessuppleant);
            // set the owning side to null (unless already changed)
            if ($activitessuppleant->getSuppleant() === $this) {
                $activitessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

   
    /**
     * @return Collection|Systeme[]
     */
    public function getSystemesresponsable(): Collection
    {
        return $this->systemesresponsable;
    }

    public function addSystemesresponsable(Systeme $systemesresponsable): self
    {
        if (!$this->systemesresponsable->contains($systemesresponsable)) {
            $this->systemesresponsable[] = $systemesresponsable;
            $systemesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeSystemesresponsable(Systeme $systemesresponsable): self
    {
        if ($this->systemesresponsable->contains($systemesresponsable)) {
            $this->systemesresponsable->removeElement($systemesresponsable);
            // set the owning side to null (unless already changed)
            if ($systemesresponsable->getResponsable() === $this) {
                $systemesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemessuppleant(): Collection
    {
        return $this->systemessuppleant;
    }

    public function addSystemessuppleant(Systeme $systemessuppleant): self
    {
        if (!$this->systemessuppleant->contains($systemessuppleant)) {
            $this->systemessuppleant[] = $systemessuppleant;
            $systemessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeSystemessuppleant(Systeme $systemessuppleant): self
    {
        if ($this->systemessuppleant->contains($systemessuppleant)) {
            $this->systemessuppleant->removeElement($systemessuppleant);
            // set the owning side to null (unless already changed)
            if ($systemessuppleant->getSuppleant() === $this) {
                $systemessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplicationsresponsable(): Collection
    {
        return $this->applicationsresponsable;
    }

    public function addApplicationsresponsable(Application $applicationsresponsable): self
    {
        if (!$this->applicationsresponsable->contains($applicationsresponsable)) {
            $this->applicationsresponsable[] = $applicationsresponsable;
            $applicationsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeApplicationsresponsable(Application $applicationsresponsable): self
    {
        if ($this->applicationsresponsable->contains($applicationsresponsable)) {
            $this->applicationsresponsable->removeElement($applicationsresponsable);
            // set the owning side to null (unless already changed)
            if ($applicationsresponsable->getResponsable() === $this) {
                $applicationsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplicationssuppleant(): Collection
    {
        return $this->applicationssuppleant;
    }

    public function addApplicationssuppleant(Application $applicationssuppleant): self
    {
        if (!$this->applicationssuppleant->contains($applicationssuppleant)) {
            $this->applicationssuppleant[] = $applicationssuppleant;
            $applicationssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeApplicationssuppleant(Application $applicationssuppleant): self
    {
        if ($this->applicationssuppleant->contains($applicationssuppleant)) {
            $this->applicationssuppleant->removeElement($applicationssuppleant);
            // set the owning side to null (unless already changed)
            if ($applicationssuppleant->getSuppleant() === $this) {
                $applicationssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxsresponsable(): Collection
    {
        return $this->fluxsresponsable;
    }

    public function addFluxsresponsable(Flux $fluxsresponsable): self
    {
        if (!$this->fluxsresponsable->contains($fluxsresponsable)) {
            $this->fluxsresponsable[] = $fluxsresponsable;
            $fluxsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeFluxsresponsable(Flux $fluxsresponsable): self
    {
        if ($this->fluxsresponsable->contains($fluxsresponsable)) {
            $this->fluxsresponsable->removeElement($fluxsresponsable);
            // set the owning side to null (unless already changed)
            if ($fluxsresponsable->getResponsable() === $this) {
                $fluxsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxssuppleant(): Collection
    {
        return $this->fluxssuppleant;
    }

    public function addFluxssuppleant(Flux $fluxssuppleant): self
    {
        if (!$this->fluxssuppleant->contains($fluxssuppleant)) {
            $this->fluxssuppleant[] = $fluxssuppleant;
            $fluxssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeFluxssuppleant(Flux $fluxssuppleant): self
    {
        if ($this->fluxssuppleant->contains($fluxssuppleant)) {
            $this->fluxssuppleant->removeElement($fluxssuppleant);
            // set the owning side to null (unless already changed)
            if ($fluxssuppleant->getSuppleant() === $this) {
                $fluxssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Site[]
     */
    public function getSitesresponsable(): Collection
    {
        return $this->sitesresponsable;
    }

    public function addSitesresponsable(Site $sitesresponsable): self
    {
        if (!$this->sitesresponsable->contains($sitesresponsable)) {
            $this->sitesresponsable[] = $sitesresponsable;
            $sitesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeSitesresponsable(Site $sitesresponsable): self
    {
        if ($this->sitesresponsable->contains($sitesresponsable)) {
            $this->sitesresponsable->removeElement($sitesresponsable);
            // set the owning side to null (unless already changed)
            if ($sitesresponsable->getResponsable() === $this) {
                $sitesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSitessuppleant(): Collection
    {
        return $this->sitessuppleant;
    }

    public function addSitessuppleant(Site $sitessuppleant): self
    {
        if (!$this->sitessuppleant->contains($sitessuppleant)) {
            $this->sitessuppleant[] = $sitessuppleant;
            $sitessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeSitessuppleant(Site $sitessuppleant): self
    {
        if ($this->sitessuppleant->contains($sitessuppleant)) {
            $this->sitessuppleant->removeElement($sitessuppleant);
            // set the owning side to null (unless already changed)
            if ($sitessuppleant->getSuppleant() === $this) {
                $sitessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessusesresponsable(): Collection
    {
        return $this->processusesresponsable;
    }

    public function addProcessusesresponsable(Processus $processusesresponsable): self
    {
        if (!$this->processusesresponsable->contains($processusesresponsable)) {
            $this->processusesresponsable[] = $processusesresponsable;
            $processusesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeProcessusesresponsable(Processus $processusesresponsable): self
    {
        if ($this->processusesresponsable->contains($processusesresponsable)) {
            $this->processusesresponsable->removeElement($processusesresponsable);
            // set the owning side to null (unless already changed)
            if ($processusesresponsable->getResponsable() === $this) {
                $processusesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessusessuppleant(): Collection
    {
        return $this->processusessuppleant;
    }

    public function addProcessusessuppleant(Processus $processusessuppleant): self
    {
        if (!$this->processusessuppleant->contains($processusessuppleant)) {
            $this->processusessuppleant[] = $processusessuppleant;
            $processusessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeProcessusessuppleant(Processus $processusessuppleant): self
    {
        if ($this->processusessuppleant->contains($processusessuppleant)) {
            $this->processusessuppleant->removeElement($processusessuppleant);
            // set the owning side to null (unless already changed)
            if ($processusessuppleant->getSuppleant() === $this) {
                $processusessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitespeople(): Collection
    {
        return $this->activitespeople;
    }

    public function addActivitesperson(Activite $activitesperson): self
    {
        if (!$this->activitespeople->contains($activitesperson)) {
            $this->activitespeople[] = $activitesperson;
            $activitesperson->addPeople($this);
        }

        return $this;
    }

    public function removeActivitesperson(Activite $activitesperson): self
    {
        if ($this->activitespeople->contains($activitesperson)) {
            $this->activitespeople->removeElement($activitesperson);
            $activitesperson->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActionsresponsable(): Collection
    {
        return $this->actionsresponsable;
    }

    public function addActionsresponsable(Action $actionsresponsable): self
    {
        if (!$this->actionsresponsable->contains($actionsresponsable)) {
            $this->actionsresponsable[] = $actionsresponsable;
            $actionsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeActionsresponsable(Action $actionsresponsable): self
    {
        if ($this->actionsresponsable->contains($actionsresponsable)) {
            $this->actionsresponsable->removeElement($actionsresponsable);
            // set the owning side to null (unless already changed)
            if ($actionsresponsable->getResponsable() === $this) {
                $actionsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActionssuppleant(): Collection
    {
        return $this->actionssuppleant;
    }

    public function addActionssuppleant(Action $actionssuppleant): self
    {
        if (!$this->actionssuppleant->contains($actionssuppleant)) {
            $this->actionssuppleant[] = $actionssuppleant;
            $actionssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeActionssuppleant(Action $actionssuppleant): self
    {
        if ($this->actionssuppleant->contains($actionssuppleant)) {
            $this->actionssuppleant->removeElement($actionssuppleant);
            // set the owning side to null (unless already changed)
            if ($actionssuppleant->getSuppleant() === $this) {
                $actionssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActionspeople(): Collection
    {
        return $this->actionspeople;
    }

    public function addActionsperson(Action $actionsperson): self
    {
        if (!$this->actionspeople->contains($actionsperson)) {
            $this->actionspeople[] = $actionsperson;
            $actionsperson->addPerson($this);
        }

        return $this;
    }

    public function removeActionsperson(Action $actionsperson): self
    {
        if ($this->actionspeople->contains($actionsperson)) {
            $this->actionspeople->removeElement($actionsperson);
            $actionsperson->removePerson($this);
        }

        return $this;
    }

    /**
     * @return Collection|Risque[]
     */
    public function getRisquesresponsable(): Collection
    {
        return $this->risquesresponsable;
    }

    public function addRisquesresponsable(Risque $risquesresponsable): self
    {
        if (!$this->risquesresponsable->contains($risquesresponsable)) {
            $this->risquesresponsable[] = $risquesresponsable;
            $risquesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeRisquesresponsable(Risque $risquesresponsable): self
    {
        if ($this->risquesresponsable->contains($risquesresponsable)) {
            $this->risquesresponsable->removeElement($risquesresponsable);
            // set the owning side to null (unless already changed)
            if ($risquesresponsable->getResponsable() === $this) {
                $risquesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Risque[]
     */
    public function getRisquessuppleant(): Collection
    {
        return $this->risquessuppleant;
    }

    public function addRisquessuppleant(Risque $risquessuppleant): self
    {
        if (!$this->risquessuppleant->contains($risquessuppleant)) {
            $this->risquessuppleant[] = $risquessuppleant;
            $risquessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeRisquessuppleant(Risque $risquessuppleant): self
    {
        if ($this->risquessuppleant->contains($risquessuppleant)) {
            $this->risquessuppleant->removeElement($risquessuppleant);
            // set the owning side to null (unless already changed)
            if ($risquessuppleant->getSuppleant() === $this) {
                $risquessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifsresponsable(): Collection
    {
        return $this->objectifsresponsable;
    }

    public function addObjectifsresponsable(Objectif $objectifsresponsable): self
    {
        if (!$this->objectifsresponsable->contains($objectifsresponsable)) {
            $this->objectifsresponsable[] = $objectifsresponsable;
            $objectifsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeObjectifsresponsable(Objectif $objectifsresponsable): self
    {
        if ($this->objectifsresponsable->contains($objectifsresponsable)) {
            $this->objectifsresponsable->removeElement($objectifsresponsable);
            // set the owning side to null (unless already changed)
            if ($objectifsresponsable->getResponsable() === $this) {
                $objectifsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    public function getCustomer(): ?MapsiCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?MapsiCustomer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setPilote($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getPilote() === $this) {
                $projet->setPilote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetMetiers(): Collection
    {
        return $this->objetMetiers;
    }

    public function addObjetMetier(ObjetMetier $objetMetier): self
    {
        if (!$this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers[] = $objetMetier;
            $objetMetier->setResponsable($this);
        }

        return $this;
    }

    public function removeObjetMetier(ObjetMetier $objetMetier): self
    {
        if ($this->objetMetiers->contains($objetMetier)) {
            $this->objetMetiers->removeElement($objetMetier);
            // set the owning side to null (unless already changed)
            if ($objetMetier->getResponsable() === $this) {
                $objetMetier->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetMetiersSuppleants(): Collection
    {
        return $this->objetMetiersSuppleants;
    }

    public function addObjetMetiersSuppleant(ObjetMetier $objetMetiersSuppleant): self
    {
        if (!$this->objetMetiersSuppleants->contains($objetMetiersSuppleant)) {
            $this->objetMetiersSuppleants[] = $objetMetiersSuppleant;
            $objetMetiersSuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeObjetMetiersSuppleant(ObjetMetier $objetMetiersSuppleant): self
    {
        if ($this->objetMetiersSuppleants->contains($objetMetiersSuppleant)) {
            $this->objetMetiersSuppleants->removeElement($objetMetiersSuppleant);
            // set the owning side to null (unless already changed)
            if ($objetMetiersSuppleant->getSuppleant() === $this) {
                $objetMetiersSuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    public function getN1(): ?self
    {
        return $this->n1;
    }

    public function setN1(?self $n1): self
    {
        $this->n1 = $n1;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getN11(): Collection
    {
        return $this->n11;
    }

    public function addN11(self $n11): self
    {
        if (!$this->n11->contains($n11)) {
            $this->n11[] = $n11;
            $n11->setN1($this);
        }

        return $this;
    }

    public function removeN11(self $n11): self
    {
        if ($this->n11->contains($n11)) {
            $this->n11->removeElement($n11);
            // set the owning side to null (unless already changed)
            if ($n11->getN1() === $this) {
                $n11->setN1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->setPilote($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->contains($program)) {
            $this->programs->removeElement($program);
            // set the owning side to null (unless already changed)
            if ($program->getPilote() === $this) {
                $program->setPilote(null);
            }
        }

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection|Axe[]
     */
    public function getAxesresponsable(): Collection
    {
        return $this->axesresponsable;
    }

    public function addAxesresponsable(Axe $axesresponsable): self
    {
        if (!$this->axesresponsable->contains($axesresponsable)) {
            $this->axesresponsable[] = $axesresponsable;
            $axesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeAxesresponsable(Axe $axesresponsable): self
    {
        if ($this->axesresponsable->contains($axesresponsable)) {
            $this->axesresponsable->removeElement($axesresponsable);
            // set the owning side to null (unless already changed)
            if ($axesresponsable->getResponsable() === $this) {
                $axesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Axe[]
     */
    public function getAxessuppleant(): Collection
    {
        return $this->axessuppleant;
    }

    public function addAxessuppleant(Axe $axessuppleant): self
    {
        if (!$this->axessuppleant->contains($axessuppleant)) {
            $this->axessuppleant[] = $axessuppleant;
            $axessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeAxessuppleant(Axe $axessuppleant): self
    {
        if ($this->axessuppleant->contains($axessuppleant)) {
            $this->axessuppleant->removeElement($axessuppleant);
            // set the owning side to null (unless already changed)
            if ($axessuppleant->getSuppleant() === $this) {
                $axessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newPeople = null === $user ? null : $this;
        if ($user->getPeople() !== $newPeople) {
            $user->setPeople($newPeople);
        }

        return $this;
    }

    /**
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonresponsable(): Collection
    {
        return $this->jalonresponsable;
    }

    public function addJalonresponsable(JalonConnectAction $jalonresponsable): self
    {
        if (!$this->jalonresponsable->contains($jalonresponsable)) {
            $this->jalonresponsable[] = $jalonresponsable;
            $jalonresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeJalonresponsable(JalonConnectAction $jalonresponsable): self
    {
        if ($this->jalonresponsable->contains($jalonresponsable)) {
            $this->jalonresponsable->removeElement($jalonresponsable);
            // set the owning side to null (unless already changed)
            if ($jalonresponsable->getResponsable() === $this) {
                $jalonresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAccess[]
     */
    public function getRgpdAccesses(): Collection
    {
        return $this->rgpdAccesses;
    }

    public function addRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if (!$this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses[] = $rgpdAccess;
            $rgpdAccess->addPilote($this);
        }

        return $this;
    }

    public function removeRgpdAccess(RgpdAccess $rgpdAccess): self
    {
        if ($this->rgpdAccesses->contains($rgpdAccess)) {
            $this->rgpdAccesses->removeElement($rgpdAccess);
            $rgpdAccess->removePilote($this);
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdViolations(): Collection
    {
        return $this->rgpdViolations;
    }

    public function addRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if (!$this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations[] = $rgpdViolation;
            $rgpdViolation->setDeclarant($this);
        }

        return $this;
    }

    public function removeRgpdViolation(RgpdViolation $rgpdViolation): self
    {
        if ($this->rgpdViolations->contains($rgpdViolation)) {
            $this->rgpdViolations->removeElement($rgpdViolation);
            // set the owning side to null (unless already changed)
            if ($rgpdViolation->getDeclarant() === $this) {
                $rgpdViolation->setDeclarant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdContriViolations(): Collection
    {
        return $this->rgpdContriViolations;
    }

    public function addRgpdContriViolation(RgpdViolation $rgpdContriViolation): self
    {
        if (!$this->rgpdContriViolations->contains($rgpdContriViolation)) {
            $this->rgpdContriViolations[] = $rgpdContriViolation;
            $rgpdContriViolation->addContributeur($this);
        }

        return $this;
    }

    public function removeRgpdContriViolation(RgpdViolation $rgpdContriViolation): self
    {
        if ($this->rgpdContriViolations->contains($rgpdContriViolation)) {
            $this->rgpdContriViolations->removeElement($rgpdContriViolation);
            $rgpdContriViolation->removeContributeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAudit[]
     */
    public function getRgpdAudits(): Collection
    {
        return $this->rgpdAudits;
    }

    public function addRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if (!$this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits[] = $rgpdAudit;
            $rgpdAudit->setResponsable($this);
        }

        return $this;
    }

    public function removeRgpdAudit(RgpdAudit $rgpdAudit): self
    {
        if ($this->rgpdAudits->contains($rgpdAudit)) {
            $this->rgpdAudits->removeElement($rgpdAudit);
            // set the owning side to null (unless already changed)
            if ($rgpdAudit->getResponsable() === $this) {
                $rgpdAudit->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxes->contains($flux)) {
            $this->fluxes[] = $flux;
            $flux->setPublisher($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->contains($flux)) {
            $this->fluxes->removeElement($flux);
            // set the owning side to null (unless already changed)
            if ($flux->getPublisher() === $this) {
                $flux->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetMetierspublisher(): Collection
    {
        return $this->objetMetierspublisher;
    }

    public function addObjetMetierspublisher(ObjetMetier $objetMetierspublisher): self
    {
        if (!$this->objetMetierspublisher->contains($objetMetierspublisher)) {
            $this->objetMetierspublisher[] = $objetMetierspublisher;
            $objetMetierspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeObjetMetierspublisher(ObjetMetier $objetMetierspublisher): self
    {
        if ($this->objetMetierspublisher->contains($objetMetierspublisher)) {
            $this->objetMetierspublisher->removeElement($objetMetierspublisher);
            // set the owning side to null (unless already changed)
            if ($objetMetierspublisher->getPublisher() === $this) {
                $objetMetierspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAccess[]
     */
    public function getRgpdAccessesResponsable(): Collection
    {
        return $this->rgpdAccessesResponsable;
    }

    public function addRgpdAccessesResponsable(RgpdAccess $rgpdAccessesResponsable): self
    {
        if (!$this->rgpdAccessesResponsable->contains($rgpdAccessesResponsable)) {
            $this->rgpdAccessesResponsable[] = $rgpdAccessesResponsable;
            $rgpdAccessesResponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeRgpdAccessesResponsable(RgpdAccess $rgpdAccessesResponsable): self
    {
        if ($this->rgpdAccessesResponsable->contains($rgpdAccessesResponsable)) {
            $this->rgpdAccessesResponsable->removeElement($rgpdAccessesResponsable);
            // set the owning side to null (unless already changed)
            if ($rgpdAccessesResponsable->getResponsable() === $this) {
                $rgpdAccessesResponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAccess[]
     */
    public function getRgpdAccessesSuppleant(): Collection
    {
        return $this->rgpdAccessesSuppleant;
    }

    public function addRgpdAccessesSuppleant(RgpdAccess $rgpdAccessesSuppleant): self
    {
        if (!$this->rgpdAccessesSuppleant->contains($rgpdAccessesSuppleant)) {
            $this->rgpdAccessesSuppleant[] = $rgpdAccessesSuppleant;
            $rgpdAccessesSuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeRgpdAccessesSuppleant(RgpdAccess $rgpdAccessesSuppleant): self
    {
        if ($this->rgpdAccessesSuppleant->contains($rgpdAccessesSuppleant)) {
            $this->rgpdAccessesSuppleant->removeElement($rgpdAccessesSuppleant);
            // set the owning side to null (unless already changed)
            if ($rgpdAccessesSuppleant->getSuppleant() === $this) {
                $rgpdAccessesSuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAccess[]
     */
    public function getRgpdAccessesPublisher(): Collection
    {
        return $this->rgpdAccessesPublisher;
    }

    public function addRgpdAccessesPublisher(RgpdAccess $rgpdAccessesPublisher): self
    {
        if (!$this->rgpdAccessesPublisher->contains($rgpdAccessesPublisher)) {
            $this->rgpdAccessesPublisher[] = $rgpdAccessesPublisher;
            $rgpdAccessesPublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeRgpdAccessesPublisher(RgpdAccess $rgpdAccessesPublisher): self
    {
        if ($this->rgpdAccessesPublisher->contains($rgpdAccessesPublisher)) {
            $this->rgpdAccessesPublisher->removeElement($rgpdAccessesPublisher);
            // set the owning side to null (unless already changed)
            if ($rgpdAccessesPublisher->getPublisher() === $this) {
                $rgpdAccessesPublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdViolationsresponsable(): Collection
    {
        return $this->rgpdViolationsresponsable;
    }

    public function addRgpdViolationsresponsable(RgpdViolation $rgpdViolationsresponsable): self
    {
        if (!$this->rgpdViolationsresponsable->contains($rgpdViolationsresponsable)) {
            $this->rgpdViolationsresponsable[] = $rgpdViolationsresponsable;
            $rgpdViolationsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeRgpdViolationsresponsable(RgpdViolation $rgpdViolationsresponsable): self
    {
        if ($this->rgpdViolationsresponsable->contains($rgpdViolationsresponsable)) {
            $this->rgpdViolationsresponsable->removeElement($rgpdViolationsresponsable);
            // set the owning side to null (unless already changed)
            if ($rgpdViolationsresponsable->getResponsable() === $this) {
                $rgpdViolationsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdViolationsSuppleant(): Collection
    {
        return $this->rgpdViolationsSuppleant;
    }

    public function addRgpdViolationsSuppleant(RgpdViolation $rgpdViolationsSuppleant): self
    {
        if (!$this->rgpdViolationsSuppleant->contains($rgpdViolationsSuppleant)) {
            $this->rgpdViolationsSuppleant[] = $rgpdViolationsSuppleant;
            $rgpdViolationsSuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeRgpdViolationsSuppleant(RgpdViolation $rgpdViolationsSuppleant): self
    {
        if ($this->rgpdViolationsSuppleant->contains($rgpdViolationsSuppleant)) {
            $this->rgpdViolationsSuppleant->removeElement($rgpdViolationsSuppleant);
            // set the owning side to null (unless already changed)
            if ($rgpdViolationsSuppleant->getSuppleant() === $this) {
                $rgpdViolationsSuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdViolation[]
     */
    public function getRgpdViolationsPublisher(): Collection
    {
        return $this->rgpdViolationsPublisher;
    }

    public function addRgpdViolationsPublisher(RgpdViolation $rgpdViolationsPublisher): self
    {
        if (!$this->rgpdViolationsPublisher->contains($rgpdViolationsPublisher)) {
            $this->rgpdViolationsPublisher[] = $rgpdViolationsPublisher;
            $rgpdViolationsPublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeRgpdViolationsPublisher(RgpdViolation $rgpdViolationsPublisher): self
    {
        if ($this->rgpdViolationsPublisher->contains($rgpdViolationsPublisher)) {
            $this->rgpdViolationsPublisher->removeElement($rgpdViolationsPublisher);
            // set the owning side to null (unless already changed)
            if ($rgpdViolationsPublisher->getPublisher() === $this) {
                $rgpdViolationsPublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Anomalie[]
     */
    public function getAnomaliesresponsable(): Collection
    {
        return $this->anomaliesresponsable;
    }

    public function addAnomaliesresponsable(Anomalie $anomaliesresponsable): self
    {
        if (!$this->anomaliesresponsable->contains($anomaliesresponsable)) {
            $this->anomaliesresponsable[] = $anomaliesresponsable;
            $anomaliesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeAnomaliesresponsable(Anomalie $anomaliesresponsable): self
    {
        if ($this->anomaliesresponsable->contains($anomaliesresponsable)) {
            $this->anomaliesresponsable->removeElement($anomaliesresponsable);
            // set the owning side to null (unless already changed)
            if ($anomaliesresponsable->getResponsable() === $this) {
                $anomaliesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Anomalie[]
     */
    public function getAnomaliessuppleant(): Collection
    {
        return $this->anomaliessuppleant;
    }

    public function addAnomaliessuppleant(Anomalie $anomaliessuppleant): self
    {
        if (!$this->anomaliessuppleant->contains($anomaliessuppleant)) {
            $this->anomaliessuppleant[] = $anomaliessuppleant;
            $anomaliessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeAnomaliessuppleant(Anomalie $anomaliessuppleant): self
    {
        if ($this->anomaliessuppleant->contains($anomaliessuppleant)) {
            $this->anomaliessuppleant->removeElement($anomaliessuppleant);
            // set the owning side to null (unless already changed)
            if ($anomaliessuppleant->getSuppleant() === $this) {
                $anomaliessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Anomalie[]
     */
    public function getContributeursanomalies(): Collection
    {
        return $this->contributeursanomalies;
    }

    public function addContributeursanomaly(Anomalie $contributeursanomaly): self
    {
        if (!$this->contributeursanomalies->contains($contributeursanomaly)) {
            $this->contributeursanomalies[] = $contributeursanomaly;
            $contributeursanomaly->addContributeur($this);
        }

        return $this;
    }

    public function removeContributeursanomaly(Anomalie $contributeursanomaly): self
    {
        if ($this->contributeursanomalies->contains($contributeursanomaly)) {
            $this->contributeursanomalies->removeElement($contributeursanomaly);
            $contributeursanomaly->removeContributeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getAuteurcontrole(): Collection
    {
        return $this->auteurcontrole;
    }

    public function addAuteurcontrole(Controle $auteurcontrole): self
    {
        if (!$this->auteurcontrole->contains($auteurcontrole)) {
            $this->auteurcontrole[] = $auteurcontrole;
            $auteurcontrole->setAuteur($this);
        }

        return $this;
    }

    public function removeAuteurcontrole(Controle $auteurcontrole): self
    {
        if ($this->auteurcontrole->contains($auteurcontrole)) {
            $this->auteurcontrole->removeElement($auteurcontrole);
            // set the owning side to null (unless already changed)
            if ($auteurcontrole->getAuteur() === $this) {
                $auteurcontrole->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RgpdAudit[]
     */
    public function getRgpdAuditscontributeurs(): Collection
    {
        return $this->rgpdAuditscontributeurs;
    }

    public function addRgpdAuditscontributeur(RgpdAudit $rgpdAuditscontributeur): self
    {
        if (!$this->rgpdAuditscontributeurs->contains($rgpdAuditscontributeur)) {
            $this->rgpdAuditscontributeurs[] = $rgpdAuditscontributeur;
            $rgpdAuditscontributeur->addContributeur($this);
        }

        return $this;
    }

    public function removeRgpdAuditscontributeur(RgpdAudit $rgpdAuditscontributeur): self
    {
        if ($this->rgpdAuditscontributeurs->contains($rgpdAuditscontributeur)) {
            $this->rgpdAuditscontributeurs->removeElement($rgpdAuditscontributeur);
            $rgpdAuditscontributeur->removeContributeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenement[]
     */
    public function getPcaEvenementsResponbable(): Collection
    {
        return $this->pcaEvenementsResponbable;
    }

    public function addPcaEvenementsResponbable(PcaEvenement $pcaEvenementsResponbable): self
    {
        if (!$this->pcaEvenementsResponbable->contains($pcaEvenementsResponbable)) {
            $this->pcaEvenementsResponbable[] = $pcaEvenementsResponbable;
            $pcaEvenementsResponbable->setResponsable($this);
        }

        return $this;
    }

    public function removePcaEvenementsResponbable(PcaEvenement $pcaEvenementsResponbable): self
    {
        if ($this->pcaEvenementsResponbable->contains($pcaEvenementsResponbable)) {
            $this->pcaEvenementsResponbable->removeElement($pcaEvenementsResponbable);
            // set the owning side to null (unless already changed)
            if ($pcaEvenementsResponbable->getResponsable() === $this) {
                $pcaEvenementsResponbable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenement[]
     */
    public function getPcaEvenementsContributeurs(): Collection
    {
        return $this->pcaEvenementsContributeurs;
    }

    public function addPcaEvenementsContributeur(PcaEvenement $pcaEvenementsContributeur): self
    {
        if (!$this->pcaEvenementsContributeurs->contains($pcaEvenementsContributeur)) {
            $this->pcaEvenementsContributeurs[] = $pcaEvenementsContributeur;
            $pcaEvenementsContributeur->addContributeur($this);
        }

        return $this;
    }

    public function removePcaEvenementsContributeur(PcaEvenement $pcaEvenementsContributeur): self
    {
        if ($this->pcaEvenementsContributeurs->contains($pcaEvenementsContributeur)) {
            $this->pcaEvenementsContributeurs->removeElement($pcaEvenementsContributeur);
            $pcaEvenementsContributeur->removeContributeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|MapsiCustomer[]
     */
    public function getMapsiCustomersDPO(): Collection
    {
        return $this->mapsiCustomersDPO;
    }

    public function addMapsiCustomersDPO(MapsiCustomer $mapsiCustomersDPO): self
    {
        if (!$this->mapsiCustomersDPO->contains($mapsiCustomersDPO)) {
            $this->mapsiCustomersDPO[] = $mapsiCustomersDPO;
            $mapsiCustomersDPO->setDpo($this);
        }

        return $this;
    }

    public function removeMapsiCustomersDPO(MapsiCustomer $mapsiCustomersDPO): self
    {
        if ($this->mapsiCustomersDPO->contains($mapsiCustomersDPO)) {
            $this->mapsiCustomersDPO->removeElement($mapsiCustomersDPO);
            // set the owning side to null (unless already changed)
            if ($mapsiCustomersDPO->getDpo() === $this) {
                $mapsiCustomersDPO->setDpo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MapsiCustomer[]
     */
    public function getMapsiCustomerRSE(): Collection
    {
        return $this->mapsiCustomerRSE;
    }

    public function addMapsiCustomerRSE(MapsiCustomer $mapsiCustomerRSE): self
    {
        if (!$this->mapsiCustomerRSE->contains($mapsiCustomerRSE)) {
            $this->mapsiCustomerRSE[] = $mapsiCustomerRSE;
            $mapsiCustomerRSE->setRse($this);
        }

        return $this;
    }

    public function removeMapsiCustomerRSE(MapsiCustomer $mapsiCustomerRSE): self
    {
        if ($this->mapsiCustomerRSE->contains($mapsiCustomerRSE)) {
            $this->mapsiCustomerRSE->removeElement($mapsiCustomerRSE);
            // set the owning side to null (unless already changed)
            if ($mapsiCustomerRSE->getRse() === $this) {
                $mapsiCustomerRSE->setRse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MapsiCustomer[]
     */
    public function getMapsiCustomerResponsable(): Collection
    {
        return $this->mapsiCustomerResponsable;
    }

    public function addMapsiCustomerResponsable(MapsiCustomer $mapsiCustomerResponsable): self
    {
        if (!$this->mapsiCustomerResponsable->contains($mapsiCustomerResponsable)) {
            $this->mapsiCustomerResponsable[] = $mapsiCustomerResponsable;
            $mapsiCustomerResponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeMapsiCustomerResponsable(MapsiCustomer $mapsiCustomerResponsable): self
    {
        if ($this->mapsiCustomerResponsable->contains($mapsiCustomerResponsable)) {
            $this->mapsiCustomerResponsable->removeElement($mapsiCustomerResponsable);
            // set the owning side to null (unless already changed)
            if ($mapsiCustomerResponsable->getResponsable() === $this) {
                $mapsiCustomerResponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Policy[]
     */
    public function getPoliciesresponsable(): Collection
    {
        return $this->policiesresponsable;
    }

    public function addPoliciesresponsable(Policy $policiesresponsable): self
    {
        if (!$this->policiesresponsable->contains($policiesresponsable)) {
            $this->policiesresponsable[] = $policiesresponsable;
            $policiesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removePoliciesresponsable(Policy $policiesresponsable): self
    {
        if ($this->policiesresponsable->contains($policiesresponsable)) {
            $this->policiesresponsable->removeElement($policiesresponsable);
            // set the owning side to null (unless already changed)
            if ($policiesresponsable->getResponsable() === $this) {
                $policiesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Policy[]
     */
    public function getPoliciessuppleant(): Collection
    {
        return $this->policiessuppleant;
    }

    public function addPoliciessuppleant(Policy $policiessuppleant): self
    {
        if (!$this->policiessuppleant->contains($policiessuppleant)) {
            $this->policiessuppleant[] = $policiessuppleant;
            $policiessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removePoliciessuppleant(Policy $policiessuppleant): self
    {
        if ($this->policiessuppleant->contains($policiessuppleant)) {
            $this->policiessuppleant->removeElement($policiessuppleant);
            // set the owning side to null (unless already changed)
            if ($policiessuppleant->getSuppleant() === $this) {
                $policiessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Policy[]
     */
    public function getPoliciespublisher(): Collection
    {
        return $this->policiespublisher;
    }

    public function addPoliciespublisher(Policy $policiespublisher): self
    {
        if (!$this->policiespublisher->contains($policiespublisher)) {
            $this->policiespublisher[] = $policiespublisher;
            $policiespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removePoliciespublisher(Policy $policiespublisher): self
    {
        if ($this->policiespublisher->contains($policiespublisher)) {
            $this->policiespublisher->removeElement($policiespublisher);
            // set the owning side to null (unless already changed)
            if ($policiespublisher->getPublisher() === $this) {
                $policiespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Risque[]
     */
    public function getRisquespublisher(): Collection
    {
        return $this->risquespublisher;
    }

    public function addRisquespublisher(Risque $risquespublisher): self
    {
        if (!$this->risquespublisher->contains($risquespublisher)) {
            $this->risquespublisher[] = $risquespublisher;
            $risquespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeRisquespublisher(Risque $risquespublisher): self
    {
        if ($this->risquespublisher->contains($risquespublisher)) {
            $this->risquespublisher->removeElement($risquespublisher);
            // set the owning side to null (unless already changed)
            if ($risquespublisher->getPublisher() === $this) {
                $risquespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getPublisheractivites(): Collection
    {
        return $this->publisheractivites;
    }

    public function addPublisheractivite(Activite $publisheractivite): self
    {
        if (!$this->publisheractivites->contains($publisheractivite)) {
            $this->publisheractivites[] = $publisheractivite;
            $publisheractivite->setPublisher($this);
        }

        return $this;
    }

    public function removePublisheractivite(Activite $publisheractivite): self
    {
        if ($this->publisheractivites->contains($publisheractivite)) {
            $this->publisheractivites->removeElement($publisheractivite);
            // set the owning side to null (unless already changed)
            if ($publisheractivite->getPublisher() === $this) {
                $publisheractivite->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getPublishedprocessuses(): Collection
    {
        return $this->publishedprocessuses;
    }

    public function addPublishedprocessus(Processus $publishedprocessus): self
    {
        if (!$this->publishedprocessuses->contains($publishedprocessus)) {
            $this->publishedprocessuses[] = $publishedprocessus;
            $publishedprocessus->setPublisher($this);
        }

        return $this;
    }

    public function removePublishedprocessus(Processus $publishedprocessus): self
    {
        if ($this->publishedprocessuses->contains($publishedprocessus)) {
            $this->publishedprocessuses->removeElement($publishedprocessus);
            // set the owning side to null (unless already changed)
            if ($publishedprocessus->getPublisher() === $this) {
                $publishedprocessus->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifspublisher(): Collection
    {
        return $this->objectifspublisher;
    }

    public function addObjectifspublisher(Objectif $objectifspublisher): self
    {
        if (!$this->objectifspublisher->contains($objectifspublisher)) {
            $this->objectifspublisher[] = $objectifspublisher;
            $objectifspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeObjectifspublisher(Objectif $objectifspublisher): self
    {
        if ($this->objectifspublisher->contains($objectifspublisher)) {
            $this->objectifspublisher->removeElement($objectifspublisher);
            // set the owning side to null (unless already changed)
            if ($objectifspublisher->getPublisher() === $this) {
                $objectifspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PcaEvenementChronoPrepa[]
     */
    public function getPcaEvenementChronoPrepas(): Collection
    {
        return $this->pcaEvenementChronoPrepas;
    }

    public function addPcaEvenementChronoPrepa(PcaEvenementChronoPrepa $pcaEvenementChronoPrepa): self
    {
        if (!$this->pcaEvenementChronoPrepas->contains($pcaEvenementChronoPrepa)) {
            $this->pcaEvenementChronoPrepas[] = $pcaEvenementChronoPrepa;
            $pcaEvenementChronoPrepa->setResponsable($this);
        }

        return $this;
    }

    public function removePcaEvenementChronoPrepa(PcaEvenementChronoPrepa $pcaEvenementChronoPrepa): self
    {
        if ($this->pcaEvenementChronoPrepas->contains($pcaEvenementChronoPrepa)) {
            $this->pcaEvenementChronoPrepas->removeElement($pcaEvenementChronoPrepa);
            // set the owning side to null (unless already changed)
            if ($pcaEvenementChronoPrepa->getResponsable() === $this) {
                $pcaEvenementChronoPrepa->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getPeoplesfluxes(): Collection
    {
        return $this->peoplesfluxes;
    }

    public function addPeoplesflux(Flux $peoplesflux): self
    {
        if (!$this->peoplesfluxes->contains($peoplesflux)) {
            $this->peoplesfluxes[] = $peoplesflux;
            $peoplesflux->addPeople($this);
        }

        return $this;
    }

    public function removePeoplesflux(Flux $peoplesflux): self
    {
        if ($this->peoplesfluxes->contains($peoplesflux)) {
            $this->peoplesfluxes->removeElement($peoplesflux);
            $peoplesflux->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getMetiersdirecteur(): Collection
    {
        return $this->metiersdirecteur;
    }

    public function addMetiersdirecteur(Metier $metiersdirecteur): self
    {
        if (!$this->metiersdirecteur->contains($metiersdirecteur)) {
            $this->metiersdirecteur[] = $metiersdirecteur;
            $metiersdirecteur->setDirecteur($this);
        }

        return $this;
    }

    public function removeMetiersdirecteur(Metier $metiersdirecteur): self
    {
        if ($this->metiersdirecteur->contains($metiersdirecteur)) {
            $this->metiersdirecteur->removeElement($metiersdirecteur);
            // set the owning side to null (unless already changed)
            if ($metiersdirecteur->getDirecteur() === $this) {
                $metiersdirecteur->setDirecteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getMetierssuppleant(): Collection
    {
        return $this->metierssuppleant;
    }

    public function addMetierssuppleant(Metier $metierssuppleant): self
    {
        if (!$this->metierssuppleant->contains($metierssuppleant)) {
            $this->metierssuppleant[] = $metierssuppleant;
            $metierssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeMetierssuppleant(Metier $metierssuppleant): self
    {
        if ($this->metierssuppleant->contains($metierssuppleant)) {
            $this->metierssuppleant->removeElement($metierssuppleant);
            // set the owning side to null (unless already changed)
            if ($metierssuppleant->getSuppleant() === $this) {
                $metierssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getMetierspublisher(): Collection
    {
        return $this->metierspublisher;
    }

    public function addMetierspublisher(Metier $metierspublisher): self
    {
        if (!$this->metierspublisher->contains($metierspublisher)) {
            $this->metierspublisher[] = $metierspublisher;
            $metierspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeMetierspublisher(Metier $metierspublisher): self
    {
        if ($this->metierspublisher->contains($metierspublisher)) {
            $this->metierspublisher->removeElement($metierspublisher);
            // set the owning side to null (unless already changed)
            if ($metierspublisher->getPublisher() === $this) {
                $metierspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getPublisher(): ?self
    {
        return $this->Publisher;
    }

    public function setPublisher(?self $Publisher): self
    {
        $this->Publisher = $Publisher;

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSitespublisher(): Collection
    {
        return $this->sitespublisher;
    }

    public function addSitespublisher(Site $sitespublisher): self
    {
        if (!$this->sitespublisher->contains($sitespublisher)) {
            $this->sitespublisher[] = $sitespublisher;
            $sitespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeSitespublisher(Site $sitespublisher): self
    {
        if ($this->sitespublisher->contains($sitespublisher)) {
            $this->sitespublisher->removeElement($sitespublisher);
            // set the owning side to null (unless already changed)
            if ($sitespublisher->getPublisher() === $this) {
                $sitespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTiersresponsable(): Collection
    {
        return $this->tiersresponsable;
    }

    public function addTiersresponsable(Tier $tiersresponsable): self
    {
        if (!$this->tiersresponsable->contains($tiersresponsable)) {
            $this->tiersresponsable[] = $tiersresponsable;
            $tiersresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeTiersresponsable(Tier $tiersresponsable): self
    {
        if ($this->tiersresponsable->contains($tiersresponsable)) {
            $this->tiersresponsable->removeElement($tiersresponsable);
            // set the owning side to null (unless already changed)
            if ($tiersresponsable->getResponsable() === $this) {
                $tiersresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTierssuppleant(): Collection
    {
        return $this->tierssuppleant;
    }

    public function addTierssuppleant(Tier $tierssuppleant): self
    {
        if (!$this->tierssuppleant->contains($tierssuppleant)) {
            $this->tierssuppleant[] = $tierssuppleant;
            $tierssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeTierssuppleant(Tier $tierssuppleant): self
    {
        if ($this->tierssuppleant->contains($tierssuppleant)) {
            $this->tierssuppleant->removeElement($tierssuppleant);
            // set the owning side to null (unless already changed)
            if ($tierssuppleant->getSuppleant() === $this) {
                $tierssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTierspeoples(): Collection
    {
        return $this->tierspeoples;
    }

    public function addTierspeople(Tier $tierspeople): self
    {
        if (!$this->tierspeoples->contains($tierspeople)) {
            $this->tierspeoples[] = $tierspeople;
            $tierspeople->addPeople($this);
        }

        return $this;
    }

    public function removeTierspeople(Tier $tierspeople): self
    {
        if ($this->tierspeoples->contains($tierspeople)) {
            $this->tierspeoples->removeElement($tierspeople);
            $tierspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Tier[]
     */
    public function getTierspublisher(): Collection
    {
        return $this->tierspublisher;
    }

    public function addTierspublisher(Tier $tierspublisher): self
    {
        if (!$this->tierspublisher->contains($tierspublisher)) {
            $this->tierspublisher[] = $tierspublisher;
            $tierspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeTierspublisher(Tier $tierspublisher): self
    {
        if ($this->tierspublisher->contains($tierspublisher)) {
            $this->tierspublisher->removeElement($tierspublisher);
            // set the owning side to null (unless already changed)
            if ($tierspublisher->getPublisher() === $this) {
                $tierspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessourcesresponsable(): Collection
    {
        return $this->ressourcesresponsable;
    }

    public function addRessourcesresponsable(Ressource $ressourcesresponsable): self
    {
        if (!$this->ressourcesresponsable->contains($ressourcesresponsable)) {
            $this->ressourcesresponsable[] = $ressourcesresponsable;
            $ressourcesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeRessourcesresponsable(Ressource $ressourcesresponsable): self
    {
        if ($this->ressourcesresponsable->contains($ressourcesresponsable)) {
            $this->ressourcesresponsable->removeElement($ressourcesresponsable);
            // set the owning side to null (unless already changed)
            if ($ressourcesresponsable->getResponsable() === $this) {
                $ressourcesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessourcessuppleant(): Collection
    {
        return $this->ressourcessuppleant;
    }

    public function addRessourcessuppleant(Ressource $ressourcessuppleant): self
    {
        if (!$this->ressourcessuppleant->contains($ressourcessuppleant)) {
            $this->ressourcessuppleant[] = $ressourcessuppleant;
            $ressourcessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeRessourcessuppleant(Ressource $ressourcessuppleant): self
    {
        if ($this->ressourcessuppleant->contains($ressourcessuppleant)) {
            $this->ressourcessuppleant->removeElement($ressourcessuppleant);
            // set the owning side to null (unless already changed)
            if ($ressourcessuppleant->getSuppleant() === $this) {
                $ressourcessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessourcespeoples(): Collection
    {
        return $this->ressourcespeoples;
    }

    public function addRessourcespeople(Ressource $ressourcespeople): self
    {
        if (!$this->ressourcespeoples->contains($ressourcespeople)) {
            $this->ressourcespeoples[] = $ressourcespeople;
            $ressourcespeople->addPeople($this);
        }

        return $this;
    }

    public function removeRessourcespeople(Ressource $ressourcespeople): self
    {
        if ($this->ressourcespeoples->contains($ressourcespeople)) {
            $this->ressourcespeoples->removeElement($ressourcespeople);
            $ressourcespeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessourcespublisher(): Collection
    {
        return $this->ressourcespublisher;
    }

    public function addRessourcespublisher(Ressource $ressourcespublisher): self
    {
        if (!$this->ressourcespublisher->contains($ressourcespublisher)) {
            $this->ressourcespublisher[] = $ressourcespublisher;
            $ressourcespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeRessourcespublisher(Ressource $ressourcespublisher): self
    {
        if ($this->ressourcespublisher->contains($ressourcespublisher)) {
            $this->ressourcespublisher->removeElement($ressourcespublisher);
            // set the owning side to null (unless already changed)
            if ($ressourcespublisher->getPublisher() === $this) {
                $ressourcespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessusespeoples(): Collection
    {
        return $this->processusespeoples;
    }

    public function addProcessusespeople(Processus $processusespeople): self
    {
        if (!$this->processusespeoples->contains($processusespeople)) {
            $this->processusespeoples[] = $processusespeople;
            $processusespeople->addPeople($this);
        }

        return $this;
    }

    public function removeProcessusespeople(Processus $processusespeople): self
    {
        if ($this->processusespeoples->contains($processusespeople)) {
            $this->processusespeoples->removeElement($processusespeople);
            $processusespeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetmetierspeoples(): Collection
    {
        return $this->objetmetierspeoples;
    }

    public function addObjetmetierspeople(ObjetMetier $objetmetierspeople): self
    {
        if (!$this->objetmetierspeoples->contains($objetmetierspeople)) {
            $this->objetmetierspeoples[] = $objetmetierspeople;
            $objetmetierspeople->addPeople($this);
        }

        return $this;
    }

    public function removeObjetmetierspeople(ObjetMetier $objetmetierspeople): self
    {
        if ($this->objetmetierspeoples->contains($objetmetierspeople)) {
            $this->objetmetierspeoples->removeElement($objetmetierspeople);
            $objetmetierspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplicationspeoples(): Collection
    {
        return $this->applicationspeoples;
    }

    public function addApplicationspeople(Application $applicationspeople): self
    {
        if (!$this->applicationspeoples->contains($applicationspeople)) {
            $this->applicationspeoples[] = $applicationspeople;
            $applicationspeople->addPeople($this);
        }

        return $this;
    }

    public function removeApplicationspeople(Application $applicationspeople): self
    {
        if ($this->applicationspeoples->contains($applicationspeople)) {
            $this->applicationspeoples->removeElement($applicationspeople);
            $applicationspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemespeoples(): Collection
    {
        return $this->systemespeoples;
    }

    public function addSystemespeople(Systeme $systemespeople): self
    {
        if (!$this->systemespeoples->contains($systemespeople)) {
            $this->systemespeoples[] = $systemespeople;
            $systemespeople->addPeople($this);
        }

        return $this;
    }

    public function removeSystemespeople(Systeme $systemespeople): self
    {
        if ($this->systemespeoples->contains($systemespeople)) {
            $this->systemespeoples->removeElement($systemespeople);
            $systemespeople->removePeople($this);
        }

        return $this;
    }



    /**
     * @return Collection|Application[]
     */
    public function getApplicationpublisher(): Collection
    {
        return $this->applicationpublisher;
    }

    public function addApplicationpublisher(Application $applicationpublisher): self
    {
        if (!$this->applicationpublisher->contains($applicationpublisher)) {
            $this->applicationpublisher[] = $applicationpublisher;
            $applicationpublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeApplicationpublisher(Application $applicationpublisher): self
    {
        if ($this->applicationpublisher->contains($applicationpublisher)) {
            $this->applicationpublisher->removeElement($applicationpublisher);
            // set the owning side to null (unless already changed)
            if ($applicationpublisher->getPublisher() === $this) {
                $applicationpublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetsuppleant(): Collection
    {
        return $this->projetsuppleant;
    }

    public function addProjetsuppleant(Projet $projetsuppleant): self
    {
        if (!$this->projetsuppleant->contains($projetsuppleant)) {
            $this->projetsuppleant[] = $projetsuppleant;
            $projetsuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeProjetsuppleant(Projet $projetsuppleant): self
    {
        if ($this->projetsuppleant->contains($projetsuppleant)) {
            $this->projetsuppleant->removeElement($projetsuppleant);
            // set the owning side to null (unless already changed)
            if ($projetsuppleant->getSuppleant() === $this) {
                $projetsuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetspeoples(): Collection
    {
        return $this->projetspeoples;
    }

    public function addProjetspeople(Projet $projetspeople): self
    {
        if (!$this->projetspeoples->contains($projetspeople)) {
            $this->projetspeoples[] = $projetspeople;
            $projetspeople->addPeople($this);
        }

        return $this;
    }

    public function removeProjetspeople(Projet $projetspeople): self
    {
        if ($this->projetspeoples->contains($projetspeople)) {
            $this->projetspeoples->removeElement($projetspeople);
            $projetspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgramsuppleant(): Collection
    {
        return $this->programsuppleant;
    }

    public function addProgramsuppleant(Program $programsuppleant): self
    {
        if (!$this->programsuppleant->contains($programsuppleant)) {
            $this->programsuppleant[] = $programsuppleant;
            $programsuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeProgramsuppleant(Program $programsuppleant): self
    {
        if ($this->programsuppleant->contains($programsuppleant)) {
            $this->programsuppleant->removeElement($programsuppleant);
            // set the owning side to null (unless already changed)
            if ($programsuppleant->getSuppleant() === $this) {
                $programsuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgramspeoples(): Collection
    {
        return $this->programspeoples;
    }

    public function addProgramspeople(Program $programspeople): self
    {
        if (!$this->programspeoples->contains($programspeople)) {
            $this->programspeoples[] = $programspeople;
            $programspeople->addPeople($this);
        }

        return $this;
    }

    public function removeProgramspeople(Program $programspeople): self
    {
        if ($this->programspeoples->contains($programspeople)) {
            $this->programspeoples->removeElement($programspeople);
            $programspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemespublisher(): Collection
    {
        return $this->systemespublisher;
    }

    public function addSystemespublisher(Systeme $systemespublisher): self
    {
        if (!$this->systemespublisher->contains($systemespublisher)) {
            $this->systemespublisher[] = $systemespublisher;
            $systemespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeSystemespublisher(Systeme $systemespublisher): self
    {
        if ($this->systemespublisher->contains($systemespublisher)) {
            $this->systemespublisher->removeElement($systemespublisher);
            // set the owning side to null (unless already changed)
            if ($systemespublisher->getPublisher() === $this) {
                $systemespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonConnectActionspublisher(): Collection
    {
        return $this->jalonConnectActionspublisher;
    }

    public function addJalonConnectActionspublisher(JalonConnectAction $jalonConnectActionspublisher): self
    {
        if (!$this->jalonConnectActionspublisher->contains($jalonConnectActionspublisher)) {
            $this->jalonConnectActionspublisher[] = $jalonConnectActionspublisher;
            $jalonConnectActionspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeJalonConnectActionspublisher(JalonConnectAction $jalonConnectActionspublisher): self
    {
        if ($this->jalonConnectActionspublisher->contains($jalonConnectActionspublisher)) {
            $this->jalonConnectActionspublisher->removeElement($jalonConnectActionspublisher);
            // set the owning side to null (unless already changed)
            if ($jalonConnectActionspublisher->getPublisher() === $this) {
                $jalonConnectActionspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgramspublisher(): Collection
    {
        return $this->programspublisher;
    }

    public function addProgramspublisher(Program $programspublisher): self
    {
        if (!$this->programspublisher->contains($programspublisher)) {
            $this->programspublisher[] = $programspublisher;
            $programspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeProgramspublisher(Program $programspublisher): self
    {
        if ($this->programspublisher->contains($programspublisher)) {
            $this->programspublisher->removeElement($programspublisher);
            // set the owning side to null (unless already changed)
            if ($programspublisher->getPublisher() === $this) {
                $programspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetspublisher(): Collection
    {
        return $this->projetspublisher;
    }

    public function addProjetspublisher(Projet $projetspublisher): self
    {
        if (!$this->projetspublisher->contains($projetspublisher)) {
            $this->projetspublisher[] = $projetspublisher;
            $projetspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeProjetspublisher(Projet $projetspublisher): self
    {
        if ($this->projetspublisher->contains($projetspublisher)) {
            $this->projetspublisher->removeElement($projetspublisher);
            // set the owning side to null (unless already changed)
            if ($projetspublisher->getPublisher() === $this) {
                $projetspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActionspublisher(): Collection
    {
        return $this->actionspublisher;
    }

    public function addActionspublisher(Action $actionspublisher): self
    {
        if (!$this->actionspublisher->contains($actionspublisher)) {
            $this->actionspublisher[] = $actionspublisher;
            $actionspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeActionspublisher(Action $actionspublisher): self
    {
        if ($this->actionspublisher->contains($actionspublisher)) {
            $this->actionspublisher->removeElement($actionspublisher);
            // set the owning side to null (unless already changed)
            if ($actionspublisher->getPublisher() === $this) {
                $actionspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonConnectActionspeoples(): Collection
    {
        return $this->jalonConnectActionspeoples;
    }

    public function addJalonConnectActionspeople(JalonConnectAction $jalonConnectActionspeople): self
    {
        if (!$this->jalonConnectActionspeoples->contains($jalonConnectActionspeople)) {
            $this->jalonConnectActionspeoples[] = $jalonConnectActionspeople;
            $jalonConnectActionspeople->addPeople($this);
        }

        return $this;
    }

    public function removeJalonConnectActionspeople(JalonConnectAction $jalonConnectActionspeople): self
    {
        if ($this->jalonConnectActionspeoples->contains($jalonConnectActionspeople)) {
            $this->jalonConnectActionspeoples->removeElement($jalonConnectActionspeople);
            $jalonConnectActionspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxesvalidator(): Collection
    {
        return $this->fluxesvalidator;
    }

    public function addFluxesvalidator(Flux $fluxesvalidator): self
    {
        if (!$this->fluxesvalidator->contains($fluxesvalidator)) {
            $this->fluxesvalidator[] = $fluxesvalidator;
            $fluxesvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeFluxesvalidator(Flux $fluxesvalidator): self
    {
        if ($this->fluxesvalidator->contains($fluxesvalidator)) {
            $this->fluxesvalidator->removeElement($fluxesvalidator);
            // set the owning side to null (unless already changed)
            if ($fluxesvalidator->getValidator() === $this) {
                $fluxesvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitesvalidator(): Collection
    {
        return $this->activitesvalidator;
    }

    public function addActivitesvalidator(Activite $activitesvalidator): self
    {
        if (!$this->activitesvalidator->contains($activitesvalidator)) {
            $this->activitesvalidator[] = $activitesvalidator;
            $activitesvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeActivitesvalidator(Activite $activitesvalidator): self
    {
        if ($this->activitesvalidator->contains($activitesvalidator)) {
            $this->activitesvalidator->removeElement($activitesvalidator);
            // set the owning side to null (unless already changed)
            if ($activitesvalidator->getValidator() === $this) {
                $activitesvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessusesvalidator(): Collection
    {
        return $this->processusesvalidator;
    }

    public function addProcessusesvalidator(Processus $processusesvalidator): self
    {
        if (!$this->processusesvalidator->contains($processusesvalidator)) {
            $this->processusesvalidator[] = $processusesvalidator;
            $processusesvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeProcessusesvalidator(Processus $processusesvalidator): self
    {
        if ($this->processusesvalidator->contains($processusesvalidator)) {
            $this->processusesvalidator->removeElement($processusesvalidator);
            // set the owning side to null (unless already changed)
            if ($processusesvalidator->getValidator() === $this) {
                $processusesvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetmetiersvalidator(): Collection
    {
        return $this->objetmetiersvalidator;
    }

    public function addObjetmetiersvalidator(ObjetMetier $objetmetiersvalidator): self
    {
        if (!$this->objetmetiersvalidator->contains($objetmetiersvalidator)) {
            $this->objetmetiersvalidator[] = $objetmetiersvalidator;
            $objetmetiersvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeObjetmetiersvalidator(ObjetMetier $objetmetiersvalidator): self
    {
        if ($this->objetmetiersvalidator->contains($objetmetiersvalidator)) {
            $this->objetmetiersvalidator->removeElement($objetmetiersvalidator);
            // set the owning side to null (unless already changed)
            if ($objetmetiersvalidator->getValidator() === $this) {
                $objetmetiersvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplicationsvalidator(): Collection
    {
        return $this->applicationsvalidator;
    }

    public function addApplicationsvalidator(Application $applicationsvalidator): self
    {
        if (!$this->applicationsvalidator->contains($applicationsvalidator)) {
            $this->applicationsvalidator[] = $applicationsvalidator;
            $applicationsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeApplicationsvalidator(Application $applicationsvalidator): self
    {
        if ($this->applicationsvalidator->contains($applicationsvalidator)) {
            $this->applicationsvalidator->removeElement($applicationsvalidator);
            // set the owning side to null (unless already changed)
            if ($applicationsvalidator->getValidator() === $this) {
                $applicationsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getSystemesvalidator(): Collection
    {
        return $this->systemesvalidator;
    }

    public function addSystemesvalidator(Systeme $systemesvalidator): self
    {
        if (!$this->systemesvalidator->contains($systemesvalidator)) {
            $this->systemesvalidator[] = $systemesvalidator;
            $systemesvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeSystemesvalidator(Systeme $systemesvalidator): self
    {
        if ($this->systemesvalidator->contains($systemesvalidator)) {
            $this->systemesvalidator->removeElement($systemesvalidator);
            // set the owning side to null (unless already changed)
            if ($systemesvalidator->getValidator() === $this) {
                $systemesvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgramsresponsable(): Collection
    {
        return $this->programsresponsable;
    }

    public function addProgramsresponsable(Program $programsresponsable): self
    {
        if (!$this->programsresponsable->contains($programsresponsable)) {
            $this->programsresponsable[] = $programsresponsable;
            $programsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeProgramsresponsable(Program $programsresponsable): self
    {
        if ($this->programsresponsable->contains($programsresponsable)) {
            $this->programsresponsable->removeElement($programsresponsable);
            // set the owning side to null (unless already changed)
            if ($programsresponsable->getResponsable() === $this) {
                $programsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgramsvalidator(): Collection
    {
        return $this->programsvalidator;
    }

    public function addProgramsvalidator(Program $programsvalidator): self
    {
        if (!$this->programsvalidator->contains($programsvalidator)) {
            $this->programsvalidator[] = $programsvalidator;
            $programsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeProgramsvalidator(Program $programsvalidator): self
    {
        if ($this->programsvalidator->contains($programsvalidator)) {
            $this->programsvalidator->removeElement($programsvalidator);
            // set the owning side to null (unless already changed)
            if ($programsvalidator->getValidator() === $this) {
                $programsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetsreponsable(): Collection
    {
        return $this->projetsreponsable;
    }

    public function addProjetsreponsable(Projet $projetsreponsable): self
    {
        if (!$this->projetsreponsable->contains($projetsreponsable)) {
            $this->projetsreponsable[] = $projetsreponsable;
            $projetsreponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeProjetsreponsable(Projet $projetsreponsable): self
    {
        if ($this->projetsreponsable->contains($projetsreponsable)) {
            $this->projetsreponsable->removeElement($projetsreponsable);
            // set the owning side to null (unless already changed)
            if ($projetsreponsable->getResponsable() === $this) {
                $projetsreponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetsvalidator(): Collection
    {
        return $this->projetsvalidator;
    }

    public function addProjetsvalidator(Projet $projetsvalidator): self
    {
        if (!$this->projetsvalidator->contains($projetsvalidator)) {
            $this->projetsvalidator[] = $projetsvalidator;
            $projetsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeProjetsvalidator(Projet $projetsvalidator): self
    {
        if ($this->projetsvalidator->contains($projetsvalidator)) {
            $this->projetsvalidator->removeElement($projetsvalidator);
            // set the owning side to null (unless already changed)
            if ($projetsvalidator->getValidator() === $this) {
                $projetsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActionsvalidator(): Collection
    {
        return $this->actionsvalidator;
    }

    public function addActionsvalidator(Action $actionsvalidator): self
    {
        if (!$this->actionsvalidator->contains($actionsvalidator)) {
            $this->actionsvalidator[] = $actionsvalidator;
            $actionsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeActionsvalidator(Action $actionsvalidator): self
    {
        if ($this->actionsvalidator->contains($actionsvalidator)) {
            $this->actionsvalidator->removeElement($actionsvalidator);
            // set the owning side to null (unless already changed)
            if ($actionsvalidator->getValidator() === $this) {
                $actionsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonConnectActionssuppleant(): Collection
    {
        return $this->jalonConnectActionssuppleant;
    }

    public function addJalonConnectActionssuppleant(JalonConnectAction $jalonConnectActionssuppleant): self
    {
        if (!$this->jalonConnectActionssuppleant->contains($jalonConnectActionssuppleant)) {
            $this->jalonConnectActionssuppleant[] = $jalonConnectActionssuppleant;
            $jalonConnectActionssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeJalonConnectActionssuppleant(JalonConnectAction $jalonConnectActionssuppleant): self
    {
        if ($this->jalonConnectActionssuppleant->contains($jalonConnectActionssuppleant)) {
            $this->jalonConnectActionssuppleant->removeElement($jalonConnectActionssuppleant);
            // set the owning side to null (unless already changed)
            if ($jalonConnectActionssuppleant->getSuppleant() === $this) {
                $jalonConnectActionssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JalonConnectAction[]
     */
    public function getJalonConnectActionsvalidator(): Collection
    {
        return $this->jalonConnectActionsvalidator;
    }

    public function addJalonConnectActionsvalidator(JalonConnectAction $jalonConnectActionsvalidator): self
    {
        if (!$this->jalonConnectActionsvalidator->contains($jalonConnectActionsvalidator)) {
            $this->jalonConnectActionsvalidator[] = $jalonConnectActionsvalidator;
            $jalonConnectActionsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeJalonConnectActionsvalidator(JalonConnectAction $jalonConnectActionsvalidator): self
    {
        if ($this->jalonConnectActionsvalidator->contains($jalonConnectActionsvalidator)) {
            $this->jalonConnectActionsvalidator->removeElement($jalonConnectActionsvalidator);
            // set the owning side to null (unless already changed)
            if ($jalonConnectActionsvalidator->getValidator() === $this) {
                $jalonConnectActionsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditsresponsable(): Collection
    {
        return $this->auditsresponsable;
    }

    public function addAuditsresponsable(Audit $auditsresponsable): self
    {
        if (!$this->auditsresponsable->contains($auditsresponsable)) {
            $this->auditsresponsable[] = $auditsresponsable;
            $auditsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeAuditsresponsable(Audit $auditsresponsable): self
    {
        if ($this->auditsresponsable->removeElement($auditsresponsable)) {
            // set the owning side to null (unless already changed)
            if ($auditsresponsable->getResponsable() === $this) {
                $auditsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditssuppleant(): Collection
    {
        return $this->auditssuppleant;
    }

    public function addAuditssuppleant(Audit $auditssuppleant): self
    {
        if (!$this->auditssuppleant->contains($auditssuppleant)) {
            $this->auditssuppleant[] = $auditssuppleant;
            $auditssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeAuditssuppleant(Audit $auditssuppleant): self
    {
        if ($this->auditssuppleant->removeElement($auditssuppleant)) {
            // set the owning side to null (unless already changed)
            if ($auditssuppleant->getSuppleant() === $this) {
                $auditssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditspeoples(): Collection
    {
        return $this->auditspeoples;
    }

    public function addAuditspeople(Audit $auditspeople): self
    {
        if (!$this->auditspeoples->contains($auditspeople)) {
            $this->auditspeoples[] = $auditspeople;
            $auditspeople->addPeople($this);
        }

        return $this;
    }

    public function removeAuditspeople(Audit $auditspeople): self
    {
        if ($this->auditspeoples->removeElement($auditspeople)) {
            $auditspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditsvalidator(): Collection
    {
        return $this->auditsvalidator;
    }

    public function addAuditsvalidator(Audit $auditsvalidator): self
    {
        if (!$this->auditsvalidator->contains($auditsvalidator)) {
            $this->auditsvalidator[] = $auditsvalidator;
            $auditsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeAuditsvalidator(Audit $auditsvalidator): self
    {
        if ($this->auditsvalidator->removeElement($auditsvalidator)) {
            // set the owning side to null (unless already changed)
            if ($auditsvalidator->getValidator() === $this) {
                $auditsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAuditspublisher(): Collection
    {
        return $this->auditspublisher;
    }

    public function addAuditspublisher(Audit $auditspublisher): self
    {
        if (!$this->auditspublisher->contains($auditspublisher)) {
            $this->auditspublisher[] = $auditspublisher;
            $auditspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeAuditspublisher(Audit $auditspublisher): self
    {
        if ($this->auditspublisher->removeElement($auditspublisher)) {
            // set the owning side to null (unless already changed)
            if ($auditspublisher->getPublisher() === $this) {
                $auditspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnementsdeclarant(): Collection
    {
        return $this->dysfonctionnementsdeclarant;
    }

    public function addDysfonctionnementsdeclarant(Dysfonctionnement $dysfonctionnementsdeclarant): self
    {
        if (!$this->dysfonctionnementsdeclarant->contains($dysfonctionnementsdeclarant)) {
            $this->dysfonctionnementsdeclarant[] = $dysfonctionnementsdeclarant;
            $dysfonctionnementsdeclarant->setDeclarant($this);
        }

        return $this;
    }

    public function removeDysfonctionnementsdeclarant(Dysfonctionnement $dysfonctionnementsdeclarant): self
    {
        if ($this->dysfonctionnementsdeclarant->removeElement($dysfonctionnementsdeclarant)) {
            // set the owning side to null (unless already changed)
            if ($dysfonctionnementsdeclarant->getDeclarant() === $this) {
                $dysfonctionnementsdeclarant->setDeclarant(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnementsresponsable(): Collection
    {
        return $this->dysfonctionnementsresponsable;
    }

    public function addDysfonctionnementsresponsable(Dysfonctionnement $dysfonctionnementsresponsable): self
    {
        if (!$this->dysfonctionnementsresponsable->contains($dysfonctionnementsresponsable)) {
            $this->dysfonctionnementsresponsable[] = $dysfonctionnementsresponsable;
            $dysfonctionnementsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeDysfonctionnementsresponsable(Dysfonctionnement $dysfonctionnementsresponsable): self
    {
        if ($this->dysfonctionnementsresponsable->removeElement($dysfonctionnementsresponsable)) {
            // set the owning side to null (unless already changed)
            if ($dysfonctionnementsresponsable->getResponsable() === $this) {
                $dysfonctionnementsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnementssuppleant(): Collection
    {
        return $this->dysfonctionnementssuppleant;
    }

    public function addDysfonctionnementssuppleant(Dysfonctionnement $dysfonctionnementssuppleant): self
    {
        if (!$this->dysfonctionnementssuppleant->contains($dysfonctionnementssuppleant)) {
            $this->dysfonctionnementssuppleant[] = $dysfonctionnementssuppleant;
            $dysfonctionnementssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeDysfonctionnementssuppleant(Dysfonctionnement $dysfonctionnementssuppleant): self
    {
        if ($this->dysfonctionnementssuppleant->removeElement($dysfonctionnementssuppleant)) {
            // set the owning side to null (unless already changed)
            if ($dysfonctionnementssuppleant->getSuppleant() === $this) {
                $dysfonctionnementssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnementspublisher(): Collection
    {
        return $this->dysfonctionnementspublisher;
    }

    public function addDysfonctionnementspublisher(Dysfonctionnement $dysfonctionnementspublisher): self
    {
        if (!$this->dysfonctionnementspublisher->contains($dysfonctionnementspublisher)) {
            $this->dysfonctionnementspublisher[] = $dysfonctionnementspublisher;
            $dysfonctionnementspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeDysfonctionnementspublisher(Dysfonctionnement $dysfonctionnementspublisher): self
    {
        if ($this->dysfonctionnementspublisher->removeElement($dysfonctionnementspublisher)) {
            // set the owning side to null (unless already changed)
            if ($dysfonctionnementspublisher->getPublisher() === $this) {
                $dysfonctionnementspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnementsvalidator(): Collection
    {
        return $this->dysfonctionnementsvalidator;
    }

    public function addDysfonctionnementsvalidator(Dysfonctionnement $dysfonctionnementsvalidator): self
    {
        if (!$this->dysfonctionnementsvalidator->contains($dysfonctionnementsvalidator)) {
            $this->dysfonctionnementsvalidator[] = $dysfonctionnementsvalidator;
            $dysfonctionnementsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeDysfonctionnementsvalidator(Dysfonctionnement $dysfonctionnementsvalidator): self
    {
        if ($this->dysfonctionnementsvalidator->removeElement($dysfonctionnementsvalidator)) {
            // set the owning side to null (unless already changed)
            if ($dysfonctionnementsvalidator->getValidator() === $this) {
                $dysfonctionnementsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dysfonctionnement[]
     */
    public function getDysfonctionnementspeoples(): Collection
    {
        return $this->dysfonctionnementspeoples;
    }

    public function addDysfonctionnementspeople(Dysfonctionnement $dysfonctionnementspeople): self
    {
        if (!$this->dysfonctionnementspeoples->contains($dysfonctionnementspeople)) {
            $this->dysfonctionnementspeoples[] = $dysfonctionnementspeople;
            $dysfonctionnementspeople->addPeople($this);
        }

        return $this;
    }

    public function removeDysfonctionnementspeople(Dysfonctionnement $dysfonctionnementspeople): self
    {
        if ($this->dysfonctionnementspeoples->removeElement($dysfonctionnementspeople)) {
            $dysfonctionnementspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|AspectEnv[]
     */
    public function getAspectEnvsresponsable(): Collection
    {
        return $this->aspectEnvsresponsable;
    }

    public function addAspectEnvsresponsable(AspectEnv $aspectEnvsresponsable): self
    {
        if (!$this->aspectEnvsresponsable->contains($aspectEnvsresponsable)) {
            $this->aspectEnvsresponsable[] = $aspectEnvsresponsable;
            $aspectEnvsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeAspectEnvsresponsable(AspectEnv $aspectEnvsresponsable): self
    {
        if ($this->aspectEnvsresponsable->removeElement($aspectEnvsresponsable)) {
            // set the owning side to null (unless already changed)
            if ($aspectEnvsresponsable->getResponsable() === $this) {
                $aspectEnvsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AspectEnv[]
     */
    public function getAspectEnvssuppleant(): Collection
    {
        return $this->aspectEnvssuppleant;
    }

    public function addAspectEnvssuppleant(AspectEnv $aspectEnvssuppleant): self
    {
        if (!$this->aspectEnvssuppleant->contains($aspectEnvssuppleant)) {
            $this->aspectEnvssuppleant[] = $aspectEnvssuppleant;
            $aspectEnvssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeAspectEnvssuppleant(AspectEnv $aspectEnvssuppleant): self
    {
        if ($this->aspectEnvssuppleant->removeElement($aspectEnvssuppleant)) {
            // set the owning side to null (unless already changed)
            if ($aspectEnvssuppleant->getSuppleant() === $this) {
                $aspectEnvssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AspectEnv[]
     */
    public function getAspectEnvspeoples(): Collection
    {
        return $this->aspectEnvspeoples;
    }

    public function addAspectEnvspeople(AspectEnv $aspectEnvspeople): self
    {
        if (!$this->aspectEnvspeoples->contains($aspectEnvspeople)) {
            $this->aspectEnvspeoples[] = $aspectEnvspeople;
            $aspectEnvspeople->addPeople($this);
        }

        return $this;
    }

    public function removeAspectEnvspeople(AspectEnv $aspectEnvspeople): self
    {
        if ($this->aspectEnvspeoples->removeElement($aspectEnvspeople)) {
            $aspectEnvspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|AspectEnv[]
     */
    public function getAspectEnvsValidator(): Collection
    {
        return $this->aspectEnvsValidator;
    }

    public function addAspectEnvsValidator(AspectEnv $aspectEnvsValidator): self
    {
        if (!$this->aspectEnvsValidator->contains($aspectEnvsValidator)) {
            $this->aspectEnvsValidator[] = $aspectEnvsValidator;
            $aspectEnvsValidator->setValidator($this);
        }

        return $this;
    }

    public function removeAspectEnvsValidator(AspectEnv $aspectEnvsValidator): self
    {
        if ($this->aspectEnvsValidator->removeElement($aspectEnvsValidator)) {
            // set the owning side to null (unless already changed)
            if ($aspectEnvsValidator->getValidator() === $this) {
                $aspectEnvsValidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AspectEnv[]
     */
    public function getAspectEnvspublisher(): Collection
    {
        return $this->aspectEnvspublisher;
    }

    public function addAspectEnvspublisher(AspectEnv $aspectEnvspublisher): self
    {
        if (!$this->aspectEnvspublisher->contains($aspectEnvspublisher)) {
            $this->aspectEnvspublisher[] = $aspectEnvspublisher;
            $aspectEnvspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeAspectEnvspublisher(AspectEnv $aspectEnvspublisher): self
    {
        if ($this->aspectEnvspublisher->removeElement($aspectEnvspublisher)) {
            // set the owning side to null (unless already changed)
            if ($aspectEnvspublisher->getPublisher() === $this) {
                $aspectEnvspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getFluxesredacteur(): Collection
    {
        return $this->fluxesredacteur;
    }

    public function addFluxesredacteur(Flux $fluxesredacteur): self
    {
        if (!$this->fluxesredacteur->contains($fluxesredacteur)) {
            $this->fluxesredacteur[] = $fluxesredacteur;
            $fluxesredacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeFluxesredacteur(Flux $fluxesredacteur): self
    {
        if ($this->fluxesredacteur->removeElement($fluxesredacteur)) {
            // set the owning side to null (unless already changed)
            if ($fluxesredacteur->getRedacteur() === $this) {
                $fluxesredacteur->setRedacteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjetMetier[]
     */
    public function getObjetMetiersredacteur(): Collection
    {
        return $this->objetMetiersredacteur;
    }

    public function addObjetMetiersredacteur(ObjetMetier $objetMetiersredacteur): self
    {
        if (!$this->objetMetiersredacteur->contains($objetMetiersredacteur)) {
            $this->objetMetiersredacteur[] = $objetMetiersredacteur;
            $objetMetiersredacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeObjetMetiersredacteur(ObjetMetier $objetMetiersredacteur): self
    {
        if ($this->objetMetiersredacteur->removeElement($objetMetiersredacteur)) {
            // set the owning side to null (unless already changed)
            if ($objetMetiersredacteur->getRedacteur() === $this) {
                $objetMetiersredacteur->setRedacteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisitesitesresponsable(): Collection
    {
        return $this->visitesitesresponsable;
    }

    public function addVisitesitesresponsable(VisiteSite $visitesitesresponsable): self
    {
        if (!$this->visitesitesresponsable->contains($visitesitesresponsable)) {
            $this->visitesitesresponsable[] = $visitesitesresponsable;
            $visitesitesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeVisitesitesresponsable(VisiteSite $visitesitesresponsable): self
    {
        if ($this->visitesitesresponsable->removeElement($visitesitesresponsable)) {
            // set the owning side to null (unless already changed)
            if ($visitesitesresponsable->getResponsable() === $this) {
                $visitesitesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisitesitessuppleant(): Collection
    {
        return $this->visitesitessuppleant;
    }

    public function addVisitesitessuppleant(VisiteSite $visitesitessuppleant): self
    {
        if (!$this->visitesitessuppleant->contains($visitesitessuppleant)) {
            $this->visitesitessuppleant[] = $visitesitessuppleant;
            $visitesitessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeVisitesitessuppleant(VisiteSite $visitesitessuppleant): self
    {
        if ($this->visitesitessuppleant->removeElement($visitesitessuppleant)) {
            // set the owning side to null (unless already changed)
            if ($visitesitessuppleant->getSuppleant() === $this) {
                $visitesitessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisitesitespublisher(): Collection
    {
        return $this->visitesitespublisher;
    }

    public function addVisitesitespublisher(VisiteSite $visitesitespublisher): self
    {
        if (!$this->visitesitespublisher->contains($visitesitespublisher)) {
            $this->visitesitespublisher[] = $visitesitespublisher;
            $visitesitespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeVisitesitespublisher(VisiteSite $visitesitespublisher): self
    {
        if ($this->visitesitespublisher->removeElement($visitesitespublisher)) {
            // set the owning side to null (unless already changed)
            if ($visitesitespublisher->getPublisher() === $this) {
                $visitesitespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisitesitespeoples(): Collection
    {
        return $this->visitesitespeoples;
    }

    public function addVisitesitespeople(VisiteSite $visitesitespeople): self
    {
        if (!$this->visitesitespeoples->contains($visitesitespeople)) {
            $this->visitesitespeoples[] = $visitesitespeople;
            $visitesitespeople->addPeople($this);
        }

        return $this;
    }

    public function removeVisitesitespeople(VisiteSite $visitesitespeople): self
    {
        if ($this->visitesitespeoples->removeElement($visitesitespeople)) {
            $visitesitespeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisitesitevalidator(): Collection
    {
        return $this->visitesitevalidator;
    }

    public function addVisitesitevalidator(VisiteSite $visitesitevalidator): self
    {
        if (!$this->visitesitevalidator->contains($visitesitevalidator)) {
            $this->visitesitevalidator[] = $visitesitevalidator;
            $visitesitevalidator->setValidator($this);
        }

        return $this;
    }

    public function removeVisitesitevalidator(VisiteSite $visitesitevalidator): self
    {
        if ($this->visitesitevalidator->removeElement($visitesitevalidator)) {
            // set the owning side to null (unless already changed)
            if ($visitesitevalidator->getValidator() === $this) {
                $visitesitevalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifssuppleant(): Collection
    {
        return $this->objectifssuppleant;
    }

    public function addObjectifssuppleant(Objectif $objectifssuppleant): self
    {
        if (!$this->objectifssuppleant->contains($objectifssuppleant)) {
            $this->objectifssuppleant[] = $objectifssuppleant;
            $objectifssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeObjectifssuppleant(Objectif $objectifssuppleant): self
    {
        if ($this->objectifssuppleant->removeElement($objectifssuppleant)) {
            // set the owning side to null (unless already changed)
            if ($objectifssuppleant->getSuppleant() === $this) {
                $objectifssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifsvalidator(): Collection
    {
        return $this->objectifsvalidator;
    }

    public function addObjectifsvalidator(Objectif $objectifsvalidator): self
    {
        if (!$this->objectifsvalidator->contains($objectifsvalidator)) {
            $this->objectifsvalidator[] = $objectifsvalidator;
            $objectifsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeObjectifsvalidator(Objectif $objectifsvalidator): self
    {
        if ($this->objectifsvalidator->removeElement($objectifsvalidator)) {
            // set the owning side to null (unless already changed)
            if ($objectifsvalidator->getValidator() === $this) {
                $objectifsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifspeoples(): Collection
    {
        return $this->objectifspeoples;
    }

    public function addObjectifspeople(Objectif $objectifspeople): self
    {
        if (!$this->objectifspeoples->contains($objectifspeople)) {
            $this->objectifspeoples[] = $objectifspeople;
            $objectifspeople->addPeople($this);
        }

        return $this;
    }

    public function removeObjectifspeople(Objectif $objectifspeople): self
    {
        if ($this->objectifspeoples->removeElement($objectifspeople)) {
            $objectifspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationsresponsable(): Collection
    {
        return $this->reclamationsresponsable;
    }

    public function addReclamationsresponsable(Reclamation $reclamationsresponsable): self
    {
        if (!$this->reclamationsresponsable->contains($reclamationsresponsable)) {
            $this->reclamationsresponsable[] = $reclamationsresponsable;
            $reclamationsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeReclamationsresponsable(Reclamation $reclamationsresponsable): self
    {
        if ($this->reclamationsresponsable->removeElement($reclamationsresponsable)) {
            // set the owning side to null (unless already changed)
            if ($reclamationsresponsable->getResponsable() === $this) {
                $reclamationsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationspeoples(): Collection
    {
        return $this->reclamationspeoples;
    }

    public function addReclamationspeople(Reclamation $reclamationspeople): self
    {
        if (!$this->reclamationspeoples->contains($reclamationspeople)) {
            $this->reclamationspeoples[] = $reclamationspeople;
            $reclamationspeople->addPeople($this);
        }

        return $this;
    }

    public function removeReclamationspeople(Reclamation $reclamationspeople): self
    {
        if ($this->reclamationspeoples->removeElement($reclamationspeople)) {
            $reclamationspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationspublisher(): Collection
    {
        return $this->reclamationspublisher;
    }

    public function addReclamationspublisher(Reclamation $reclamationspublisher): self
    {
        if (!$this->reclamationspublisher->contains($reclamationspublisher)) {
            $this->reclamationspublisher[] = $reclamationspublisher;
            $reclamationspublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeReclamationspublisher(Reclamation $reclamationspublisher): self
    {
        if ($this->reclamationspublisher->removeElement($reclamationspublisher)) {
            // set the owning side to null (unless already changed)
            if ($reclamationspublisher->getPublisher() === $this) {
                $reclamationspublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationsvalidator(): Collection
    {
        return $this->reclamationsvalidator;
    }

    public function addReclamationsvalidator(Reclamation $reclamationsvalidator): self
    {
        if (!$this->reclamationsvalidator->contains($reclamationsvalidator)) {
            $this->reclamationsvalidator[] = $reclamationsvalidator;
            $reclamationsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeReclamationsvalidator(Reclamation $reclamationsvalidator): self
    {
        if ($this->reclamationsvalidator->removeElement($reclamationsvalidator)) {
            // set the owning side to null (unless already changed)
            if ($reclamationsvalidator->getValidator() === $this) {
                $reclamationsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationspeople(): Collection
    {
        return $this->reclamationspeople;
    }

    public function addReclamationsperson(Reclamation $reclamationsperson): self
    {
        if (!$this->reclamationspeople->contains($reclamationsperson)) {
            $this->reclamationspeople[] = $reclamationsperson;
            $reclamationsperson->setSuppleant($this);
        }

        return $this;
    }

    public function removeReclamationsperson(Reclamation $reclamationsperson): self
    {
        if ($this->reclamationspeople->removeElement($reclamationsperson)) {
            // set the owning side to null (unless already changed)
            if ($reclamationsperson->getSuppleant() === $this) {
                $reclamationsperson->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamationsredacteur(): Collection
    {
        return $this->reclamationsredacteur;
    }

    public function addReclamationsredacteur(Reclamation $reclamationsredacteur): self
    {
        if (!$this->reclamationsredacteur->contains($reclamationsredacteur)) {
            $this->reclamationsredacteur[] = $reclamationsredacteur;
            $reclamationsredacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeReclamationsredacteur(Reclamation $reclamationsredacteur): self
    {
        if ($this->reclamationsredacteur->removeElement($reclamationsredacteur)) {
            // set the owning side to null (unless already changed)
            if ($reclamationsredacteur->getRedacteur() === $this) {
                $reclamationsredacteur->setRedacteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementsresponsable(): Collection
    {
        return $this->evenementsresponsable;
    }

    public function addEvenementsresponsable(Evenement $evenementsresponsable): self
    {
        if (!$this->evenementsresponsable->contains($evenementsresponsable)) {
            $this->evenementsresponsable[] = $evenementsresponsable;
            $evenementsresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeEvenementsresponsable(Evenement $evenementsresponsable): self
    {
        if ($this->evenementsresponsable->removeElement($evenementsresponsable)) {
            // set the owning side to null (unless already changed)
            if ($evenementsresponsable->getResponsable() === $this) {
                $evenementsresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementssuppleant(): Collection
    {
        return $this->evenementssuppleant;
    }

    public function addEvenementssuppleant(Evenement $evenementssuppleant): self
    {
        if (!$this->evenementssuppleant->contains($evenementssuppleant)) {
            $this->evenementssuppleant[] = $evenementssuppleant;
            $evenementssuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeEvenementssuppleant(Evenement $evenementssuppleant): self
    {
        if ($this->evenementssuppleant->removeElement($evenementssuppleant)) {
            // set the owning side to null (unless already changed)
            if ($evenementssuppleant->getSuppleant() === $this) {
                $evenementssuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementspeoples(): Collection
    {
        return $this->evenementspeoples;
    }

    public function addEvenementspeople(Evenement $evenementspeople): self
    {
        if (!$this->evenementspeoples->contains($evenementspeople)) {
            $this->evenementspeoples[] = $evenementspeople;
            $evenementspeople->addPeople($this);
        }

        return $this;
    }

    public function removeEvenementspeople(Evenement $evenementspeople): self
    {
        if ($this->evenementspeoples->removeElement($evenementspeople)) {
            $evenementspeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementsvalidator(): Collection
    {
        return $this->evenementsvalidator;
    }

    public function addEvenementsvalidator(Evenement $evenementsvalidator): self
    {
        if (!$this->evenementsvalidator->contains($evenementsvalidator)) {
            $this->evenementsvalidator[] = $evenementsvalidator;
            $evenementsvalidator->setValidator($this);
        }

        return $this;
    }

    public function removeEvenementsvalidator(Evenement $evenementsvalidator): self
    {
        if ($this->evenementsvalidator->removeElement($evenementsvalidator)) {
            // set the owning side to null (unless already changed)
            if ($evenementsvalidator->getValidator() === $this) {
                $evenementsvalidator->setValidator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Processus[]
     */
    public function getProcessusesredacteur(): Collection
    {
        return $this->processusesredacteur;
    }

    public function addProcessusesredacteur(Processus $processusesredacteur): self
    {
        if (!$this->processusesredacteur->contains($processusesredacteur)) {
            $this->processusesredacteur[] = $processusesredacteur;
            $processusesredacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeProcessusesredacteur(Processus $processusesredacteur): self
    {
        if ($this->processusesredacteur->removeElement($processusesredacteur)) {
            // set the owning side to null (unless already changed)
            if ($processusesredacteur->getRedacteur() === $this) {
                $processusesredacteur->setRedacteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Metier[]
     */
    public function getMetiersresponsable(): Collection
    {
        return $this->metiersresponsable;
    }

    public function addMetiersresponsable(Metier $metiersresponsable): self
    {
        if (!$this->metiersresponsable->contains($metiersresponsable)) {
            $this->metiersresponsable[] = $metiersresponsable;
            $metiersresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeMetiersresponsable(Metier $metiersresponsable): self
    {
        if ($this->metiersresponsable->removeElement($metiersresponsable)) {
            // set the owning side to null (unless already changed)
            if ($metiersresponsable->getResponsable() === $this) {
                $metiersresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getControlesresponsable(): Collection
    {
        return $this->controlesresponsable;
    }

    public function addControlesresponsable(Controle $controlesresponsable): self
    {
        if (!$this->controlesresponsable->contains($controlesresponsable)) {
            $this->controlesresponsable[] = $controlesresponsable;
            $controlesresponsable->setResponsable($this);
        }

        return $this;
    }

    public function removeControlesresponsable(Controle $controlesresponsable): self
    {
        if ($this->controlesresponsable->removeElement($controlesresponsable)) {
            // set the owning side to null (unless already changed)
            if ($controlesresponsable->getResponsable() === $this) {
                $controlesresponsable->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getControlessuppleant(): Collection
    {
        return $this->controlessuppleant;
    }

    public function addControlessuppleant(Controle $controlessuppleant): self
    {
        if (!$this->controlessuppleant->contains($controlessuppleant)) {
            $this->controlessuppleant[] = $controlessuppleant;
            $controlessuppleant->setSuppleant($this);
        }

        return $this;
    }

    public function removeControlessuppleant(Controle $controlessuppleant): self
    {
        if ($this->controlessuppleant->removeElement($controlessuppleant)) {
            // set the owning side to null (unless already changed)
            if ($controlessuppleant->getSuppleant() === $this) {
                $controlessuppleant->setSuppleant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplicationsredacteur(): Collection
    {
        return $this->applicationsredacteur;
    }

    public function addApplicationsredacteur(Application $applicationsredacteur): self
    {
        if (!$this->applicationsredacteur->contains($applicationsredacteur)) {
            $this->applicationsredacteur[] = $applicationsredacteur;
            $applicationsredacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeApplicationsredacteur(Application $applicationsredacteur): self
    {
        if ($this->applicationsredacteur->removeElement($applicationsredacteur)) {
            // set the owning side to null (unless already changed)
            if ($applicationsredacteur->getRedacteur() === $this) {
                $applicationsredacteur->setRedacteur(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Risque[]
     */
    public function getRisquespeoples(): Collection
    {
        return $this->risquespeoples;
    }

    public function addRisquespeople(Risque $risquespeople): self
    {
        if (!$this->risquespeoples->contains($risquespeople)) {
            $this->risquespeoples[] = $risquespeople;
            $risquespeople->addPeople($this);
        }

        return $this;
    }

    public function removeRisquespeople(Risque $risquespeople): self
    {
        if ($this->risquespeoples->removeElement($risquespeople)) {
            $risquespeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getControlespeoples(): Collection
    {
        return $this->controlespeoples;
    }

    public function addControlespeople(Controle $controlespeople): self
    {
        if (!$this->controlespeoples->contains($controlespeople)) {
            $this->controlespeoples[] = $controlespeople;
            $controlespeople->addPeople($this);
        }

        return $this;
    }

    public function removeControlespeople(Controle $controlespeople): self
    {
        if ($this->controlespeoples->removeElement($controlespeople)) {
            $controlespeople->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Controle[]
     */
    public function getControlespublisher(): Collection
    {
        return $this->controlespublisher;
    }

    public function addControlespublisher(Controle $controlespublisher): self
    {
        if (!$this->controlespublisher->contains($controlespublisher)) {
            $this->controlespublisher[] = $controlespublisher;
            $controlespublisher->setPublisher($this);
        }

        return $this;
    }

    public function removeControlespublisher(Controle $controlespublisher): self
    {
        if ($this->controlespublisher->removeElement($controlespublisher)) {
            // set the owning side to null (unless already changed)
            if ($controlespublisher->getPublisher() === $this) {
                $controlespublisher->setPublisher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivitesredacteur(): Collection
    {
        return $this->activitesredacteur;
    }

    public function addActivitesredacteur(Activite $activitesredacteur): self
    {
        if (!$this->activitesredacteur->contains($activitesredacteur)) {
            $this->activitesredacteur[] = $activitesredacteur;
            $activitesredacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeActivitesredacteur(Activite $activitesredacteur): self
    {
        if ($this->activitesredacteur->removeElement($activitesredacteur)) {
            // set the owning side to null (unless already changed)
            if ($activitesredacteur->getRedacteur() === $this) {
                $activitesredacteur->setRedacteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisiteSite[]
     */
    public function getVisiteSitesRedacteur(): Collection
    {
        return $this->visiteSitesRedacteur;
    }

    public function addVisiteSitesRedacteur(VisiteSite $visiteSitesRedacteur): self
    {
        if (!$this->visiteSitesRedacteur->contains($visiteSitesRedacteur)) {
            $this->visiteSitesRedacteur[] = $visiteSitesRedacteur;
            $visiteSitesRedacteur->setRedacteur($this);
        }

        return $this;
    }

    public function removeVisiteSitesRedacteur(VisiteSite $visiteSitesRedacteur): self
    {
        if ($this->visiteSitesRedacteur->removeElement($visiteSitesRedacteur)) {
            // set the owning side to null (unless already changed)
            if ($visiteSitesRedacteur->getRedacteur() === $this) {
                $visiteSitesRedacteur->setRedacteur(null);
            }
        }

        return $this;
    }


}
