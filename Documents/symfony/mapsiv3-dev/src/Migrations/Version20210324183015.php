<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324183015 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mapsi_customer ADD adresse LONGTEXT DEFAULT NULL, ADD pays VARCHAR(255) DEFAULT NULL, ADD sigle VARCHAR(255) DEFAULT NULL, ADD siren VARCHAR(255) DEFAULT NULL, ADD siret VARCHAR(255) DEFAULT NULL, ADD nafape VARCHAR(255) DEFAULT NULL, ADD tva VARCHAR(255) DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL, ADD creation_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mapsi_customer DROP adresse, DROP pays, DROP sigle, DROP siren, DROP siret, DROP nafape, DROP tva, DROP commentaire, DROP creation_at');
    }
}
