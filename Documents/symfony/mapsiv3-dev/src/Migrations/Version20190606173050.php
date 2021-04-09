<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190606173050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE processus ADD typeprocessus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE processus ADD CONSTRAINT FK_EEEA8C1DB0F24CB3 FOREIGN KEY (typeprocessus_id) REFERENCES type_processus (id)');
        $this->addSql('CREATE INDEX IDX_EEEA8C1DB0F24CB3 ON processus (typeprocessus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE processus DROP FOREIGN KEY FK_EEEA8C1DB0F24CB3');
        $this->addSql('DROP INDEX IDX_EEEA8C1DB0F24CB3 ON processus');
        $this->addSql('ALTER TABLE processus DROP typeprocessus_id');
    }
}
