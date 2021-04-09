<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025213237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA6299395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_57AA6299395C3F3 ON jalon_connect_action (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA6299395C3F3');
        $this->addSql('DROP INDEX IDX_57AA6299395C3F3 ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action DROP customer_id');
    }
}
