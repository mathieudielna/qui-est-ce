<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605135719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme ADD responsable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE353C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_95796DE353C59D72 ON systeme (responsable_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE353C59D72');
        $this->addSql('DROP INDEX IDX_95796DE353C59D72 ON systeme');
        $this->addSql('ALTER TABLE systeme DROP responsable_id');
    }
}
