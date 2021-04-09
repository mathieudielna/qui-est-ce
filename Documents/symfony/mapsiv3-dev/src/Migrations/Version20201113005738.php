<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113005738 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme ADD statutrun_id INT DEFAULT NULL, ADD validator_id INT DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE33C267D26 FOREIGN KEY (statutrun_id) REFERENCES on_off (id)');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE3B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_95796DE33C267D26 ON systeme (statutrun_id)');
        $this->addSql('CREATE INDEX IDX_95796DE3B0644AEC ON systeme (validator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE33C267D26');
        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE3B0644AEC');
        $this->addSql('DROP INDEX IDX_95796DE33C267D26 ON systeme');
        $this->addSql('DROP INDEX IDX_95796DE3B0644AEC ON systeme');
        $this->addSql('ALTER TABLE systeme DROP statutrun_id, DROP validator_id, DROP statut, DROP validated_at, DROP validationstatut');
    }
}
