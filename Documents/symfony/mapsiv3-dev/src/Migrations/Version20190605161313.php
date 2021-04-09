<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605161313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC167A3C51B');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1783E3463');
        $this->addSql('DROP INDEX IDX_A45BDDC1783E3463 ON application');
        $this->addSql('DROP INDEX IDX_A45BDDC167A3C51B ON application');
        $this->addSql('ALTER TABLE application DROP manager_id, DROP suppleant_id, DROP responsable');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application ADD manager_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL, ADD responsable VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC167A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1783E3463 FOREIGN KEY (manager_id) REFERENCES people (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A45BDDC1783E3463 ON application (manager_id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC167A3C51B ON application (suppleant_id)');
    }
}
