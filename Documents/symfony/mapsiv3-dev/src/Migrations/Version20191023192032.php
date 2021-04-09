<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191023192032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA629B9B4C4CA');
        $this->addSql('DROP INDEX IDX_57AA629B9B4C4CA ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action DROP fin_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action ADD fin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA629B9B4C4CA FOREIGN KEY (fin_id) REFERENCES oui_non (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_57AA629B9B4C4CA ON jalon_connect_action (fin_id)');
    }
}
