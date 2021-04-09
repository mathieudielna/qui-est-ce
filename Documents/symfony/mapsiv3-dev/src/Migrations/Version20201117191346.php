<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117191346 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action ADD validator_id INT DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL, ADD statuttache VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA629B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_57AA629B0644AEC ON jalon_connect_action (validator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA629B0644AEC');
        $this->addSql('DROP INDEX IDX_57AA629B0644AEC ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action DROP validator_id, DROP statut, DROP validated_at, DROP validationstatut, DROP statuttache');
    }
}
