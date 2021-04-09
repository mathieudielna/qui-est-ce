<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219000149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rgpd_access (id INT AUTO_INCREMENT NOT NULL, statut_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, INDEX IDX_38C63BEAF6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rgpd_access ADD CONSTRAINT FK_38C63BEAF6203804 FOREIGN KEY (statut_id) REFERENCES type_statut (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rgpd_access');
    }
}
