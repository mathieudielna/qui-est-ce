<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126203257 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, validator_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, validated_at DATETIME DEFAULT NULL, start_at DATETIME DEFAULT NULL, finish_at DATETIME DEFAULT NULL, INDEX IDX_B26681E9395C3F3 (customer_id), INDEX IDX_B26681E53C59D72 (responsable_id), INDEX IDX_B26681E67A3C51B (suppleant_id), INDEX IDX_B26681EB0644AEC (validator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_type_conformite (evenement_id INT NOT NULL, type_conformite_id INT NOT NULL, INDEX IDX_C535607FD02F13 (evenement_id), INDEX IDX_C53560779A28B64 (type_conformite_id), PRIMARY KEY(evenement_id, type_conformite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_people (evenement_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_9BE3BAA4FD02F13 (evenement_id), INDEX IDX_9BE3BAA43147C936 (people_id), PRIMARY KEY(evenement_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_processus (evenement_id INT NOT NULL, processus_id INT NOT NULL, INDEX IDX_40B480CCFD02F13 (evenement_id), INDEX IDX_40B480CCA55629DC (processus_id), PRIMARY KEY(evenement_id, processus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_activite (evenement_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_3713CEFDFD02F13 (evenement_id), INDEX IDX_3713CEFD9B0F88B1 (activite_id), PRIMARY KEY(evenement_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_objet_metier (evenement_id INT NOT NULL, objet_metier_id INT NOT NULL, INDEX IDX_48528CF0FD02F13 (evenement_id), INDEX IDX_48528CF025707B47 (objet_metier_id), PRIMARY KEY(evenement_id, objet_metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_flux (evenement_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_D10154B7FD02F13 (evenement_id), INDEX IDX_D10154B7C85926E (flux_id), PRIMARY KEY(evenement_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_application (evenement_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_35CECBEAFD02F13 (evenement_id), INDEX IDX_35CECBEA3E030ACD (application_id), PRIMARY KEY(evenement_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_systeme (evenement_id INT NOT NULL, systeme_id INT NOT NULL, INDEX IDX_967C7A3FFD02F13 (evenement_id), INDEX IDX_967C7A3F346F772E (systeme_id), PRIMARY KEY(evenement_id, systeme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EB0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE evenement_type_conformite ADD CONSTRAINT FK_C535607FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_type_conformite ADD CONSTRAINT FK_C53560779A28B64 FOREIGN KEY (type_conformite_id) REFERENCES type_conformite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_people ADD CONSTRAINT FK_9BE3BAA4FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_people ADD CONSTRAINT FK_9BE3BAA43147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_processus ADD CONSTRAINT FK_40B480CCFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_processus ADD CONSTRAINT FK_40B480CCA55629DC FOREIGN KEY (processus_id) REFERENCES processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_activite ADD CONSTRAINT FK_3713CEFDFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_activite ADD CONSTRAINT FK_3713CEFD9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_objet_metier ADD CONSTRAINT FK_48528CF0FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_objet_metier ADD CONSTRAINT FK_48528CF025707B47 FOREIGN KEY (objet_metier_id) REFERENCES objet_metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_flux ADD CONSTRAINT FK_D10154B7FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_flux ADD CONSTRAINT FK_D10154B7C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_application ADD CONSTRAINT FK_35CECBEAFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_application ADD CONSTRAINT FK_35CECBEA3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_systeme ADD CONSTRAINT FK_967C7A3FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_systeme ADD CONSTRAINT FK_967C7A3F346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenement_type_conformite DROP FOREIGN KEY FK_C535607FD02F13');
        $this->addSql('ALTER TABLE evenement_people DROP FOREIGN KEY FK_9BE3BAA4FD02F13');
        $this->addSql('ALTER TABLE evenement_processus DROP FOREIGN KEY FK_40B480CCFD02F13');
        $this->addSql('ALTER TABLE evenement_activite DROP FOREIGN KEY FK_3713CEFDFD02F13');
        $this->addSql('ALTER TABLE evenement_objet_metier DROP FOREIGN KEY FK_48528CF0FD02F13');
        $this->addSql('ALTER TABLE evenement_flux DROP FOREIGN KEY FK_D10154B7FD02F13');
        $this->addSql('ALTER TABLE evenement_application DROP FOREIGN KEY FK_35CECBEAFD02F13');
        $this->addSql('ALTER TABLE evenement_systeme DROP FOREIGN KEY FK_967C7A3FFD02F13');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_type_conformite');
        $this->addSql('DROP TABLE evenement_people');
        $this->addSql('DROP TABLE evenement_processus');
        $this->addSql('DROP TABLE evenement_activite');
        $this->addSql('DROP TABLE evenement_objet_metier');
        $this->addSql('DROP TABLE evenement_flux');
        $this->addSql('DROP TABLE evenement_application');
        $this->addSql('DROP TABLE evenement_systeme');
    }
}
