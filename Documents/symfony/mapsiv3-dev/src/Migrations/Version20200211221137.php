<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211221137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AAF73D997');
        $this->addSql('DROP INDEX IDX_7252313AAF73D997 ON flux');
        $this->addSql('ALTER TABLE flux ADD commentaire LONGTEXT DEFAULT NULL, DROP direction_id');
        $this->addSql('ALTER TABLE flux_connect_activite DROP FOREIGN KEY FK_7F7FC552AF73D997');
        $this->addSql('DROP INDEX IDX_7F7FC552AF73D997 ON flux_connect_activite');
        $this->addSql('ALTER TABLE flux_connect_activite DROP direction_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD direction_id INT DEFAULT NULL, DROP commentaire');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AAF73D997 FOREIGN KEY (direction_id) REFERENCES type_direction (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7252313AAF73D997 ON flux (direction_id)');
        $this->addSql('ALTER TABLE flux_connect_activite ADD direction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux_connect_activite ADD CONSTRAINT FK_7F7FC552AF73D997 FOREIGN KEY (direction_id) REFERENCES type_direction (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7F7FC552AF73D997 ON flux_connect_activite (direction_id)');
    }
}
