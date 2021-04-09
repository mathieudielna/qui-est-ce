SET @start = 16;

INSERT INTO `criticite` (`designation`, `dureeheure`, `customer_id`, `color`) VALUES
('a. 1 sec', '0.01', @start, 'badge-danger'),
('b. 4 h', '4', @start, 'badge-danger'),
('c. 8 h', '8', @start, 'badge-danger'),
('d. 1 j', '24', @start, 'badge-danger'),
('e. 2 j', '48', @start, 'badge-warning'),
('f. 3 j', '72', @start, 'badge-warning'),
('g. 5 j ', '120', @start, 'badge-warning'),
('h. 1 sem', '168', @start, 'badge-info'),
('i. 2 sem', '336', @start, 'badge-info'),
('j. 3 sem', '504', @start, 'badge-info'),
('k. 1 m', '720', @start, 'badge-primary'),
('l. 2 m', '1440', @start, 'badge-primary');

INSERT INTO `on_off` (`designation`, `customer_id`, `code`) VALUES
('En cours d\'installation', @start, 'OFF'),
('Démarré', @start, 'ON'),
('Eteint', @start, 'OFF'),
('Décomissionné', @start, 'OFF');

INSERT INTO `niveau_impact` (`designation`, `code`, `customer_id`, `color`) VALUES
('Nul', 1, @start, '#2ECC71'),
('Modéré', 2,  @start, '#F1C40F'),
('Important',3,  @start, '#E74C3C'),
('Sévère', 4,  @start, '#9B59B6'),
('Critique', 5, @start, '#8E44AD');

INSERT INTO `oui_non` (`designation`, `customer_id`, `code`) VALUES
('Oui', @start, 1),
('Non', @start, 2);

INSERT INTO `type_acteur` (`designation`, `customer_id`) VALUES
('Salarié', @start),
('Client', @start),
('Etat', @start),
('Collectivité', @start),
('Compagnie aérienne', @start),
('Passager', @start),
('Fournisseur', @start),
('Prestataire', @start),
('Locataire foncier', @start),
('Partenaire', @start),
('Public', @start),
('Propriétaire', @start);

INSERT INTO `type_action` (`designation`, `customer_id`) VALUES
('Action', @start),
('Projet', @start),
('Programme', @start);

INSERT INTO `type_activite` (`designation`, `customer_id`, `icon`) VALUES
('Activité', @start, 'fa fa-square'),
('Décision', @start, 'fa fa-chevron-circle-up');

INSERT INTO `type_appli` (`designation`, `description`, `customer_id`) VALUES
('Infrastructure', NULL, @start),
('Métier', NULL, @start),
('Support', NULL, @start);


INSERT INTO `type_axevolet` (`customer_id`, `designation`) VALUES
(@start, 'Volet 1 - Positionnement stratégique'),
(@start, 'Volet 2 - Trajectoire financière'),
(@start, 'Volet 3 - Management de la performance'),
(@start, 'Volet 4 - Aménagement et environnement'),
(@start, 'Volet 5 - Mobilité et logistique du territoire');

INSERT INTO `type_conformite` (`designation`, `description`, `customer_id`) VALUES
('RGPD', '11', @start),
('PCA', '11', @start),
('Environnement', '11', @start),
('Qualité', '11', @start),
('Energie', '11', @start),
('COBIT', '11', @start),
('Réglementation financière', '11', @start),
('Gestion des risques', '11', @start),
('Infrastructure IT', NULL, @start),
('HSE', NULL, @start),
('Organisation SI', NULL, @start),
('Performance technique', NULL, @start),
('Performance RH', NULL, @start),
('Sécuritaire', NULL, @start);


INSERT INTO `type_dcpjuridique` (`designation`, `customer_id`) VALUES
('Intérêt légitime du responsable de traitement', @start),
('Exécution d\'un contrat dans lequel la personne est partie', @start),
('Nécessaire à l\'exécution de mesures précontractuelles prises à la demande de la personne concernée', @start),
('Consentement', @start),
('Execution d\'une mission de service public', @start),
('Obligation légale du responsable du traitement', @start),
('Sauvegarde de la vie des personnes', @start),
('Nécessaire aux fins des intérêts légitimes poursuivis par le responsable du traitement ou par un tier', @start);

INSERT INTO `type_direction` (`designation`, `customer_id`) VALUES
('Entrant', @start),
('Sortant', @start),
('Bidirectionnel', @start),
('Intra service', @start);

INSERT INTO `type_audit` (`designation`) VALUES
('A blanc'),
('Interne'),
('Externe');
INSERT INTO `type_non_conformite` (`designation`) VALUES
('Majeur'),
('Mineure'),
('Point sensible');

INSERT INTO `type_duree` (`designation`, `customer_id`) VALUES
('0', @start),
('1/2 jour', @start),
('1 jour', @start),
('2 jours', @start),
('3 jours', @start),
('5 jours', @start),
('1 semaine', @start),
('2 semaines', @start),
('1 mois', @start),
('2 mois', @start),
('3 mois', @start),
('6 mois', @start),
('1 an', @start),
('2 ans', @start),
('3 ans', @start),
('4 ans', @start),
('5 ans', @start),
('7 ans', @start),
('10 ans', @start);

INSERT INTO `type_om` (`designation`, `couleur`, `customer_id`) VALUES
('Physique', NULL, @start),
('Numérique', NULL, @start);

INSERT INTO `type_os` (`designation`, `customer_id`) VALUES
('Microsoft Windows Server 2016 (64-bit)', @start),
('Microsoft Windows Server 2003 Standard (32-bit)', @start),
('Microsoft Windows Server 2008 R2 (64-bit)', @start),
('Microsoft Windows Server 2012 (64-bit)', @start),
('Microsoft Windows Server 2008 (64-bit)', @start),
('Microsoft Windows Server 2012 R2 (64-bit)', @start),
('Windows 2019', @start),
('CentOS', @start),
('Red Hat Enterprise Linux 5 (32-bit)', @start),
('Ubuntu Linux (64-bit)', @start),
('Fedora', @start),
('AIX', @start),
('HP-UX', @start),
('Windows 2000 server', @start),
('SUSE Linux Enterprise 11 (64-bit)', @start),
('Autre Windows', @start),
('Autre Linux', @start),
('Autre NAS', @start),
('Autre UNIX', @start),
('Microsoft Windows Server 2003 Standard (32-bit)', @start),
('Microsoft Windows 7 (32-bit)', @start),
('Microsoft Windows Server 2008 (32-bit)', @start);

INSERT INTO `type_periodicite` (`designation`, `customer_id`) VALUES
('A la demande', @start),
('Continu', @start),
('Permanent', @start),
('Quotidien', @start),
('Bihebdomadaire', @start),
('Hebdomadaire', @start),
('Bimensuel', @start),
('Mensuel', @start),
('Bimestriel', @start),
('Trimestriel', @start),
('Quadrimestriel', @start),
('Semestriel', @start),
('Annuel', @start),
('Biannuel', @start);

INSERT INTO `type_plateforme` (`designation`, `customer_id`) VALUES
('ADSL', @start),
('SDSL', @start),
('FO', @start),
('XDSL', @start),
('AS400', @start),
('UNIX', @start),
('x86-64', @start),
('VM', @start),
('SAN', @start),
('LAN', @start),
('NAS', @start),
('Internet', @start);

INSERT INTO `type_priorite` (`designation`, `customer_id`, `color`, `critique`) VALUES
('6. P5 (-)', @start, 'badge-primary','1'),
('5. P4', @start, 'badge-primary','1'),
('4. P3', @start, 'badge-info','1'),
('3. P2', @start, 'badge-info',''),
('2. P1', @start, 'badge-warning',''),
('1. P0 (+)', @start, 'badge-danger','');

INSERT INTO `type_processus` (`designation`, `customer_id`, `code`) VALUES
('Support', @start, 'SUP'),
('Réalisation', @start, 'REA'),
('Management', @start, 'MAN');

INSERT INTO `type_risque` (`designation`, `customer_id`) VALUES
('Risque stratégique', @start),
('Risque lié aux activités opérationnelles', @start),
('Risques juridiques', @start),
('Risque management organisation', @start),
('Risque financier', @start);

INSERT INTO `type_phase` (`customer_id`, `designation`) VALUES
(@start, 'Phase 1'),
(@start, 'Phase 2'),
(@start, 'Phase 3');

INSERT INTO `type_site` (`designation`, `customer_id`) VALUES
('Siège', @start),
('Agence', @start),
('Dépot', @start),
('Succursale', @start),
('Etablissement', @start),
('Point de vente', @start),
('Secours informatique', @start),
('Secours utilisateurs', @start),
('Site prestataire', @start),
('Salle informatique', @start),
('Salle d\'archive', @start);

INSERT INTO `type_statut` (`designation`, `description`, `customer_id`, `color`, `code`) VALUES
('1.Non démarré', NULL, @start, '#f4f4f4',0),
('2.Assigné', NULL, @start, '#BEB7A4',0),
('3.En cours', NULL, @start, '#0ED67C',0),
('4.Terminé', NULL, @start, '#0094DC',1),
('5.Annulé', NULL, @start, '#B3A5C6',1);

INSERT INTO `type_statutrgpd` (`designation`, `customer_id`) VALUES
('En cours d\'analyse', @start),
('Conforme', @start),
('Non conforme', @start),
('Non applicable', @start);

INSERT INTO `type_support` (`designation`, `customer_id`) VALUES
('Application métier', @start),
('Papier / Dossier papier', @start),
('Courrier', @start),
('Main propre', @start),
('Verbal', @start),
('Proces Verbal', @start),
('Messagerie', @start),
('GED', @start),
('Fichier informatique', @start),
('EDI', @start),
('Plate forme SAAS', @start),
('Autre', @start);

INSERT INTO `type_systeme` (`designation`, `customer_id`, `code`) VALUES
('Bandothèque', @start, 'BAND'),
('Cloud métier', @start, 'CLOU'),
('Espace affaire', @start, 'ESPA'),
('Firewall', @start, 'FIRE'),
('Imprimante', @start, 'IMPR'),
('Modem', @start, 'MODE'),
('Pont wifi', @start, 'WIFI'),
('Routeur', @start, 'ROUT'),
('Serveur applicatif', @start, 'SRVA'),
('Serveur de stockage', @start, 'SRVS'),
('Serveur infrastructure', @start, 'SRVI'),
('Station de travail', @start, 'PCUT'),
('Switch', @start, 'SWIT'),
('Telecom', @start, 'TELE');

INSERT INTO `type_tier` (`customer_id`, `designation`, `couleur`) VALUES
(@start, 'Client', ''),
(@start, 'Prospect', ''),
(@start, 'Fournisseur', ''),
(@start, 'Administration', ''),
(@start, 'Autre', '');

INSERT INTO `type_rag` (`designation`,`color`,`icon`,`customer_id`) VALUES 
('Alert','badge-danger','fa-exclamation-triangle',@start),
('Warning','badge-warning','fa-question-circle',@start),
('Good','badge-primary','fa-check-square',@start);

INSERT INTO `data` (`designation`, `customer_id`) VALUES
('Nom', @start),
('Prenom', @start),
('Adresse', @start),
('Composition de ménage', @start),
('Adresse email', @start),
('Téléphone (Dont mobile)', @start),
('Images ou photographies', @start),
('Habitudes de vie (alimentation, sports, vacances,…)', @start),
('Informations d\'ordre économique (revenus, dépenses, données bancaires,…)', @start),
('Performances au travail, absences, congés spéciaux,…', @start),
('Intérêts personnels et préférences (autres)', @start),
('Critères relatifs au comportement (autres)', @start),
('Données de connexion (adresse IP, logs,…)', @start),
('Données de localisation (GPS, antennes BTS, GSM,…)', @start),
('Décisions automatisées (avec conséquences potentielles juridiques ou autres)', @start),
('Monitoring systématique (espace public, service obligatoire,…)', @start),
('Agglomération de données provenant de diverses sources ', @start),
('origine raciale ou ethnique', @start),
('opinions politiques', @start),
('convictions religieuses ou philosophiques ', @start),
('appartenance syndicale', @start),
('données génétiques', @start),
('données biométriques aux fins d\'identifier une personne physique de manière unique', @start),
('données concernant la santé  d\'une personne physique', @start),
('données concernant la vie sexuelle ou l\'orientation sexuelle d\'une personne physique', @start),
('condamnations pénales', @start),
('condamnations relatives à des infractions', @start),
('condamnations à des mesures de sûreté', @start);

INSERT INTO `type_prevention` (`designation`, `customer_id`) VALUES
('Anonymisation', @start),
('Cryptograhie', @start),
('Contrôles de confidentialité des données', @start),
('Contrôles d intégrité des données', @start),
('Contrôles de disponibilité  des données', @start),
('Back ups', @start),
('Partition des données (serveurs distincts, BD,…)', @start),
('Accès physique (bâtiments)', @start),
('Accès des données (IAM)', @start),
('Tracabilité', @start),
('Opérations', @start),
('Monitoring (settings, configuration,…)', @start),
('Management de la plateforme et des applications', @start),
('Malware', @start),
('Firewall', @start),
('Anti-virus', @start),
('VPN (ou autres accès réseau à distance)', @start),
('Autres (à préciser)', @start);

INSERT INTO `type_traitementrgpd` (`designation`, `customer_id`) VALUES
('Collecte', @start),
('Enregistrement', @start),
('Organisation', @start),
('Structuration', @start),
('Conservation', @start),
('Adaptation/Modification', @start),
('Extraction', @start),
('Consultation', @start),
('Utilisation', @start),
('Communication (transmission, diffusion, mise à disposition,…)', @start),
('Rapprochement/Interconnexion', @start),
('Limitation', @start),
('Effacement/Destruction', @start),
('Autre, à préciser', @start);

INSERT INTO `type_dcpsensible` (`designation`, `customer_id`) VALUES
('Données révélant l\'origine raciale ou ethnique', @start),
('Données révélant les opinions politiques', @start),
('Données révélant les convictions religieuses ou philosophiques ', @start),
('Données révélant l\'appartenance syndicale', @start),
('Données génétiques', @start),
('Données biométriques aux fins d\'identifier une personne physique de manière unique', @start),
('Données concernant la santé', @start),
('Données concernant la vie sexuelle ou l\'orientation sexuelle', @start),
('Données relatives à des condamnations pénales ou  infractions', @start);

INSERT INTO `type_pca_evenement` (`designation`, `customer_id`) VALUES
('Test système', @start),
('Test réseau', @start),
('Test applicatif', @start),
('Test de reprise utilisateurs', @start),
('Test de la cellule de crise', @start);

INSERT INTO `type_statut_risque` (`designation`, `customer_id`, `description`, `code`, `color`) VALUES
('Ouvert', @start,'','1',''),
('Analyse', @start,'','2',''),
('Evalué', @start,'','3',''),
('Cloturé', @start,'','4','');

INSERT INTO `type_score` (`designation`,`code`,  `color`, `customer_id`) VALUES
('Risque néant','1','', @start),
('Risque faible','2','', @start),
('Risque modéré','3','', @start),
('Risque élevé','4','', @start),
('Risque extrême','5','', @start);

INSERT INTO `type_aspect_env` (`designation`) VALUES
('Rejet dans les eaux superficielles et souterraines'),
('Rejet dans l’air'),
('Pollution du sol'),
('Déchets dangereux ou non dangereux'),
('Nuisances acoustiques'),
('Nuisances olfactives'),
('Nuisances visuelles'),
('Vibrations'),
('Rayonnements ionisants et électromagnétiques'),
('Consommation d’énergie, d’eau, carburant, etc.');

INSERT INTO `type_reclamation` (`designation`, `customer_id`) VALUES
('Aspect visuel', @start),
('Odeurs', @start),
('Pollution sol', @start),
('Pollution eau', @start),
('Pollution air', @start),
('Déchets', @start),
('Impacts sur la sécurité', @start),
('Impacts sur la santé', @start);
