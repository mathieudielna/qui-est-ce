<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219174411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rgpd_violation (id INT AUTO_INCREMENT NOT NULL, declarant_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, typenotification VARCHAR(255) DEFAULT NULL, numerocnil VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, closed_at DATETIME DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, mesuresecu LONGTEXT DEFAULT NULL, INDEX IDX_24D13BEEEC439BC (declarant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rgpd_violation_people (rgpd_violation_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_77C2C90185B35C4 (rgpd_violation_id), INDEX IDX_77C2C9013147C936 (people_id), PRIMARY KEY(rgpd_violation_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rgpd_violation_flux (rgpd_violation_id INT NOT NULL, flux_id INT NOT NULL, INDEX IDX_E21AF99E85B35C4 (rgpd_violation_id), INDEX IDX_E21AF99EC85926E (flux_id), PRIMARY KEY(rgpd_violation_id, flux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rgpd_violation ADD CONSTRAINT FK_24D13BEEEC439BC FOREIGN KEY (declarant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE rgpd_violation_people ADD CONSTRAINT FK_77C2C90185B35C4 FOREIGN KEY (rgpd_violation_id) REFERENCES rgpd_violation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_violation_people ADD CONSTRAINT FK_77C2C9013147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_violation_flux ADD CONSTRAINT FK_E21AF99E85B35C4 FOREIGN KEY (rgpd_violation_id) REFERENCES rgpd_violation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_violation_flux ADD CONSTRAINT FK_E21AF99EC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_violation_people DROP FOREIGN KEY FK_77C2C90185B35C4');
        $this->addSql('ALTER TABLE rgpd_violation_flux DROP FOREIGN KEY FK_E21AF99E85B35C4');
        $this->addSql('DROP TABLE rgpd_violation');
        $this->addSql('DROP TABLE rgpd_violation_people');
        $this->addSql('DROP TABLE rgpd_violation_flux');
    }
}
