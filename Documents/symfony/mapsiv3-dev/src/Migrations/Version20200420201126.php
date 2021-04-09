<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420201126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_violation ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL, ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rgpd_violation ADD CONSTRAINT FK_24D13BEE53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE rgpd_violation ADD CONSTRAINT FK_24D13BEE67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE rgpd_violation ADD CONSTRAINT FK_24D13BEE40C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_24D13BEE53C59D72 ON rgpd_violation (responsable_id)');
        $this->addSql('CREATE INDEX IDX_24D13BEE67A3C51B ON rgpd_violation (suppleant_id)');
        $this->addSql('CREATE INDEX IDX_24D13BEE40C86FCE ON rgpd_violation (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rgpd_violation DROP FOREIGN KEY FK_24D13BEE53C59D72');
        $this->addSql('ALTER TABLE rgpd_violation DROP FOREIGN KEY FK_24D13BEE67A3C51B');
        $this->addSql('ALTER TABLE rgpd_violation DROP FOREIGN KEY FK_24D13BEE40C86FCE');
        $this->addSql('DROP INDEX IDX_24D13BEE53C59D72 ON rgpd_violation');
        $this->addSql('DROP INDEX IDX_24D13BEE67A3C51B ON rgpd_violation');
        $this->addSql('DROP INDEX IDX_24D13BEE40C86FCE ON rgpd_violation');
        $this->addSql('ALTER TABLE rgpd_violation DROP responsable_id, DROP suppleant_id, DROP publisher_id');
    }
}
