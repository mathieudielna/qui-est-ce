<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625201345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE axe ADD volet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE axe ADD CONSTRAINT FK_6C6A1E2C215A6787 FOREIGN KEY (volet_id) REFERENCES type_axevolet (id)');
        $this->addSql('CREATE INDEX IDX_6C6A1E2C215A6787 ON axe (volet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE axe DROP FOREIGN KEY FK_6C6A1E2C215A6787');
        $this->addSql('DROP INDEX IDX_6C6A1E2C215A6787 ON axe');
        $this->addSql('ALTER TABLE axe DROP volet_id');
    }
}
