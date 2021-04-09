<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123135453 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE audit (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, suppleant_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, closed_at DATETIME DEFAULT NULL, resultat LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, resultatlight VARCHAR(255) DEFAULT NULL, INDEX IDX_9218FF7953C59D72 (responsable_id), INDEX IDX_9218FF7967A3C51B (suppleant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_people (audit_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_BC846FDBD29F359 (audit_id), INDEX IDX_BC846FD3147C936 (people_id), PRIMARY KEY(audit_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_type_conformite (audit_id INT NOT NULL, type_conformite_id INT NOT NULL, INDEX IDX_AABADB0ABD29F359 (audit_id), INDEX IDX_AABADB0A79A28B64 (type_conformite_id), PRIMARY KEY(audit_id, type_conformite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_processus (audit_id INT NOT NULL, processus_id INT NOT NULL, INDEX IDX_376CC292BD29F359 (audit_id), INDEX IDX_376CC292A55629DC (processus_id), PRIMARY KEY(audit_id, processus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_site (audit_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_4FE3E7E0BD29F359 (audit_id), INDEX IDX_4FE3E7E0F6BD1646 (site_id), PRIMARY KEY(audit_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_tier (audit_id INT NOT NULL, tier_id INT NOT NULL, INDEX IDX_23E798EBD29F359 (audit_id), INDEX IDX_23E798EA354F9DC (tier_id), PRIMARY KEY(audit_id, tier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_flux (audit_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_54F2DF3EBD29F359 (audit_id), INDEX IDX_54F2DF3EC85926E (flux_id), PRIMARY KEY(audit_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_action (audit_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_6412A049BD29F359 (audit_id), INDEX IDX_6412A0499D32F035 (action_id), PRIMARY KEY(audit_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF7953C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF7967A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE audit_people ADD CONSTRAINT FK_BC846FDBD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_people ADD CONSTRAINT FK_BC846FD3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_type_conformite ADD CONSTRAINT FK_AABADB0ABD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_type_conformite ADD CONSTRAINT FK_AABADB0A79A28B64 FOREIGN KEY (type_conformite_id) REFERENCES type_conformite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_processus ADD CONSTRAINT FK_376CC292BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_processus ADD CONSTRAINT FK_376CC292A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_site ADD CONSTRAINT FK_4FE3E7E0BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_site ADD CONSTRAINT FK_4FE3E7E0F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_tier ADD CONSTRAINT FK_23E798EBD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_tier ADD CONSTRAINT FK_23E798EA354F9DC FOREIGN KEY (tier_id) REFERENCES tier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_flux ADD CONSTRAINT FK_54F2DF3EBD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_flux ADD CONSTRAINT FK_54F2DF3EC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_action ADD CONSTRAINT FK_6412A049BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_action ADD CONSTRAINT FK_6412A0499D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit_people DROP FOREIGN KEY FK_BC846FDBD29F359');
        $this->addSql('ALTER TABLE audit_type_conformite DROP FOREIGN KEY FK_AABADB0ABD29F359');
        $this->addSql('ALTER TABLE audit_processus DROP FOREIGN KEY FK_376CC292BD29F359');
        $this->addSql('ALTER TABLE audit_site DROP FOREIGN KEY FK_4FE3E7E0BD29F359');
        $this->addSql('ALTER TABLE audit_tier DROP FOREIGN KEY FK_23E798EBD29F359');
        $this->addSql('ALTER TABLE audit_flux DROP FOREIGN KEY FK_54F2DF3EBD29F359');
        $this->addSql('ALTER TABLE audit_action DROP FOREIGN KEY FK_6412A049BD29F359');
        $this->addSql('DROP TABLE audit');
        $this->addSql('DROP TABLE audit_people');
        $this->addSql('DROP TABLE audit_type_conformite');
        $this->addSql('DROP TABLE audit_processus');
        $this->addSql('DROP TABLE audit_site');
        $this->addSql('DROP TABLE audit_tier');
        $this->addSql('DROP TABLE audit_flux');
        $this->addSql('DROP TABLE audit_action');
    }
}
