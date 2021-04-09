<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909162932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier ADD typesupport_id INT DEFAULT NULL, ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A6FA4F5408 FOREIGN KEY (typesupport_id) REFERENCES type_support (id)');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A653C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A667A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A6FA4F5408 ON objet_metier (typesupport_id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A653C59D72 ON objet_metier (responsable_id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A667A3C51B ON objet_metier (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A6FA4F5408');
        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A653C59D72');
        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A667A3C51B');
        $this->addSql('DROP INDEX IDX_E47FE0A6FA4F5408 ON objet_metier');
        $this->addSql('DROP INDEX IDX_E47FE0A653C59D72 ON objet_metier');
        $this->addSql('DROP INDEX IDX_E47FE0A667A3C51B ON objet_metier');
        $this->addSql('ALTER TABLE objet_metier DROP typesupport_id, DROP responsable_id, DROP suppleant_id');
    }
}
