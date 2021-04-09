<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124203225 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objectif ADD suppleant_id INT DEFAULT NULL, ADD validator_id INT DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F8685167A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F86851B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E2F8685167A3C51B ON objectif (suppleant_id)');
        $this->addSql('CREATE INDEX IDX_E2F86851B0644AEC ON objectif (validator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objectif DROP FOREIGN KEY FK_E2F8685167A3C51B');
        $this->addSql('ALTER TABLE objectif DROP FOREIGN KEY FK_E2F86851B0644AEC');
        $this->addSql('DROP INDEX IDX_E2F8685167A3C51B ON objectif');
        $this->addSql('DROP INDEX IDX_E2F86851B0644AEC ON objectif');
        $this->addSql('ALTER TABLE objectif DROP suppleant_id, DROP validator_id, DROP validated_at, DROP validationstatut, DROP slug');
    }
}
