<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701191055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme ADD srvhote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE392CFC7B8 FOREIGN KEY (srvhote_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_95796DE392CFC7B8 ON systeme (srvhote_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE392CFC7B8');
        $this->addSql('DROP INDEX IDX_95796DE392CFC7B8 ON systeme');
        $this->addSql('ALTER TABLE systeme DROP srvhote_id');
    }
}
