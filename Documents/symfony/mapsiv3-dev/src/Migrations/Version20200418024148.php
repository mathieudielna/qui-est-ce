<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418024148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A640C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A640C86FCE ON objet_metier (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A640C86FCE');
        $this->addSql('DROP INDEX IDX_E47FE0A640C86FCE ON objet_metier');
        $this->addSql('ALTER TABLE objet_metier DROP publisher_id');
    }
}
