<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614215520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_processus ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_processus ADD CONSTRAINT FK_5A2CCD0D9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_5A2CCD0D9395C3F3 ON type_processus (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_processus DROP FOREIGN KEY FK_5A2CCD0D9395C3F3');
        $this->addSql('DROP INDEX IDX_5A2CCD0D9395C3F3 ON type_processus');
        $this->addSql('ALTER TABLE type_processus DROP customer_id');
    }
}
