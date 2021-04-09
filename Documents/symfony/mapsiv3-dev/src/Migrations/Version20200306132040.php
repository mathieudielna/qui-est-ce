<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306132040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rgpd_audit (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, closed_at DATETIME DEFAULT NULL, resultat LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_537F9A9E53C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rgpd_audit_flux (rgpd_audit_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_5D87F86ADAD85EA4 (rgpd_audit_id), INDEX IDX_5D87F86AC85926E (flux_id), PRIMARY KEY(rgpd_audit_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rgpd_audit_people (rgpd_audit_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_701562B3DAD85EA4 (rgpd_audit_id), INDEX IDX_701562B33147C936 (people_id), PRIMARY KEY(rgpd_audit_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rgpd_audit_action (rgpd_audit_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_1FCF8407DAD85EA4 (rgpd_audit_id), INDEX IDX_1FCF84079D32F035 (action_id), PRIMARY KEY(rgpd_audit_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rgpd_audit ADD CONSTRAINT FK_537F9A9E53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE rgpd_audit_flux ADD CONSTRAINT FK_5D87F86ADAD85EA4 FOREIGN KEY (rgpd_audit_id) REFERENCES rgpd_audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_audit_flux ADD CONSTRAINT FK_5D87F86AC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_audit_people ADD CONSTRAINT FK_701562B3DAD85EA4 FOREIGN KEY (rgpd_audit_id) REFERENCES rgpd_audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_audit_people ADD CONSTRAINT FK_701562B33147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_audit_action ADD CONSTRAINT FK_1FCF8407DAD85EA4 FOREIGN KEY (rgpd_audit_id) REFERENCES rgpd_audit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_audit_action ADD CONSTRAINT FK_1FCF84079D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_audit_flux DROP FOREIGN KEY FK_5D87F86ADAD85EA4');
        $this->addSql('ALTER TABLE rgpd_audit_people DROP FOREIGN KEY FK_701562B3DAD85EA4');
        $this->addSql('ALTER TABLE rgpd_audit_action DROP FOREIGN KEY FK_1FCF8407DAD85EA4');
        $this->addSql('DROP TABLE rgpd_audit');
        $this->addSql('DROP TABLE rgpd_audit_flux');
        $this->addSql('DROP TABLE rgpd_audit_people');
        $this->addSql('DROP TABLE rgpd_audit_action');
    }
}
