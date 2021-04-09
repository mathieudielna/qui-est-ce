<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112191202 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application ADD statutrun_id INT DEFAULT NULL, ADD validator_id INT DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC13C267D26 FOREIGN KEY (statutrun_id) REFERENCES on_off (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC13C267D26 ON application (statutrun_id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC1B0644AEC ON application (validator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC13C267D26');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1B0644AEC');
        $this->addSql('DROP INDEX IDX_A45BDDC13C267D26 ON application');
        $this->addSql('DROP INDEX IDX_A45BDDC1B0644AEC ON application');
        $this->addSql('ALTER TABLE application DROP statutrun_id, DROP validator_id, DROP statut, DROP validated_at, DROP validationstatut');
    }
}
