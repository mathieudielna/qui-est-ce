<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419212100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, processus VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, metier VARCHAR(255) DEFAULT NULL, equipe VARCHAR(255) DEFAULT NULL, suppleant VARCHAR(255) DEFAULT NULL, dima VARCHAR(255) DEFAULT NULL, pdma VARCHAR(255) DEFAULT NULL, periodepic VARCHAR(255) DEFAULT NULL, flux VARCHAR(255) DEFAULT NULL, pca VARCHAR(255) DEFAULT NULL, niveaureprise VARCHAR(255) DEFAULT NULL, INDEX IDX_B875551553C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B875551553C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE activite');
    }
}
