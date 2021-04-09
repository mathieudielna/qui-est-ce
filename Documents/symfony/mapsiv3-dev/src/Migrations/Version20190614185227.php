<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614185227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque ADD acceptation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D24241F44CA FOREIGN KEY (acceptation_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_20230D24241F44CA ON risque (acceptation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D24241F44CA');
        $this->addSql('DROP INDEX IDX_20230D24241F44CA ON risque');
        $this->addSql('ALTER TABLE risque DROP acceptation_id');
    }
}
