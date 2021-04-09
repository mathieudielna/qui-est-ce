<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420185215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_access ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rgpd_access ADD CONSTRAINT FK_38C63BEA53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE rgpd_access ADD CONSTRAINT FK_38C63BEA67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_38C63BEA53C59D72 ON rgpd_access (responsable_id)');
        $this->addSql('CREATE INDEX IDX_38C63BEA67A3C51B ON rgpd_access (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_access DROP FOREIGN KEY FK_38C63BEA53C59D72');
        $this->addSql('ALTER TABLE rgpd_access DROP FOREIGN KEY FK_38C63BEA67A3C51B');
        $this->addSql('DROP INDEX IDX_38C63BEA53C59D72 ON rgpd_access');
        $this->addSql('DROP INDEX IDX_38C63BEA67A3C51B ON rgpd_access');
        $this->addSql('ALTER TABLE rgpd_access DROP responsable_id, DROP suppleant_id');
    }
}
