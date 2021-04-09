<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112123234 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier ADD validator_id INT DEFAULT NULL, ADD statutrgpd_id INT DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A6B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE objet_metier ADD CONSTRAINT FK_E47FE0A66940FBF0 FOREIGN KEY (statutrgpd_id) REFERENCES type_statutrgpd (id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A6B0644AEC ON objet_metier (validator_id)');
        $this->addSql('CREATE INDEX IDX_E47FE0A66940FBF0 ON objet_metier (statutrgpd_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A6B0644AEC');
        $this->addSql('ALTER TABLE objet_metier DROP FOREIGN KEY FK_E47FE0A66940FBF0');
        $this->addSql('DROP INDEX IDX_E47FE0A6B0644AEC ON objet_metier');
        $this->addSql('DROP INDEX IDX_E47FE0A66940FBF0 ON objet_metier');
        $this->addSql('ALTER TABLE objet_metier DROP validator_id, DROP statutrgpd_id, DROP statut, DROP validated_at, DROP validationstatut');
    }
}
