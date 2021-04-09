<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209131706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action ADD rag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA6296C8B800C FOREIGN KEY (rag_id) REFERENCES type_rag (id)');
        $this->addSql('CREATE INDEX IDX_57AA6296C8B800C ON jalon_connect_action (rag_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA6296C8B800C');
        $this->addSql('DROP INDEX IDX_57AA6296C8B800C ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action DROP rag_id');
    }
}
