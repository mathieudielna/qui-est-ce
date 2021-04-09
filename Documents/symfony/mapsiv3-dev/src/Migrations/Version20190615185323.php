<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190615185323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux_connect_activite ADD flux_id INT DEFAULT NULL, ADD activite_id INT DEFAULT NULL, ADD direction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux_connect_activite ADD CONSTRAINT FK_7F7FC552C85926E FOREIGN KEY (flux_id) REFERENCES flux (id)');
        $this->addSql('ALTER TABLE flux_connect_activite ADD CONSTRAINT FK_7F7FC5529B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE flux_connect_activite ADD CONSTRAINT FK_7F7FC552AF73D997 FOREIGN KEY (direction_id) REFERENCES type_direction (id)');
        $this->addSql('CREATE INDEX IDX_7F7FC552C85926E ON flux_connect_activite (flux_id)');
        $this->addSql('CREATE INDEX IDX_7F7FC5529B0F88B1 ON flux_connect_activite (activite_id)');
        $this->addSql('CREATE INDEX IDX_7F7FC552AF73D997 ON flux_connect_activite (direction_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux_connect_activite DROP FOREIGN KEY FK_7F7FC552C85926E');
        $this->addSql('ALTER TABLE flux_connect_activite DROP FOREIGN KEY FK_7F7FC5529B0F88B1');
        $this->addSql('ALTER TABLE flux_connect_activite DROP FOREIGN KEY FK_7F7FC552AF73D997');
        $this->addSql('DROP INDEX IDX_7F7FC552C85926E ON flux_connect_activite');
        $this->addSql('DROP INDEX IDX_7F7FC5529B0F88B1 ON flux_connect_activite');
        $this->addSql('DROP INDEX IDX_7F7FC552AF73D997 ON flux_connect_activite');
        $this->addSql('ALTER TABLE flux_connect_activite DROP flux_id, DROP activite_id, DROP direction_id');
    }
}
