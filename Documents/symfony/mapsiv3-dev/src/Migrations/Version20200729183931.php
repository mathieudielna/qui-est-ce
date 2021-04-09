<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729183931 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux_connect_activite DROP FOREIGN KEY FK_7F7FC552129C5EF2');
        $this->addSql('ALTER TABLE flux_connect_activite DROP FOREIGN KEY FK_7F7FC55223321CD9');
        $this->addSql('DROP INDEX IDX_7F7FC552129C5EF2 ON flux_connect_activite');
        $this->addSql('DROP INDEX IDX_7F7FC55223321CD9 ON flux_connect_activite');
        $this->addSql('ALTER TABLE flux_connect_activite DROP directionfx_id, DROP directionact_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux_connect_activite ADD directionfx_id INT DEFAULT NULL, ADD directionact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux_connect_activite ADD CONSTRAINT FK_7F7FC552129C5EF2 FOREIGN KEY (directionfx_id) REFERENCES type_direction (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE flux_connect_activite ADD CONSTRAINT FK_7F7FC55223321CD9 FOREIGN KEY (directionact_id) REFERENCES type_direction (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7F7FC552129C5EF2 ON flux_connect_activite (directionfx_id)');
        $this->addSql('CREATE INDEX IDX_7F7FC55223321CD9 ON flux_connect_activite (directionact_id)');
    }
}
