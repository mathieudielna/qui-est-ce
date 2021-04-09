<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420195144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_access ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rgpd_access ADD CONSTRAINT FK_38C63BEA40C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_38C63BEA40C86FCE ON rgpd_access (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_access DROP FOREIGN KEY FK_38C63BEA40C86FCE');
        $this->addSql('DROP INDEX IDX_38C63BEA40C86FCE ON rgpd_access');
        $this->addSql('ALTER TABLE rgpd_access DROP publisher_id');
    }
}
