<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610165010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D2453C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D2467A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_20230D2453C59D72 ON risque (responsable_id)');
        $this->addSql('CREATE INDEX IDX_20230D2467A3C51B ON risque (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D2453C59D72');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D2467A3C51B');
        $this->addSql('DROP INDEX IDX_20230D2453C59D72 ON risque');
        $this->addSql('DROP INDEX IDX_20230D2467A3C51B ON risque');
        $this->addSql('ALTER TABLE risque DROP responsable_id, DROP suppleant_id');
    }
}
