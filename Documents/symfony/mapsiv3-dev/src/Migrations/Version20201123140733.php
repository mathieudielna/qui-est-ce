<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123140733 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE non_conformite ADD severite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE non_conformite ADD CONSTRAINT FK_8327F8D5ED9D9C26 FOREIGN KEY (severite_id) REFERENCES type_non_conformite (id)');
        $this->addSql('CREATE INDEX IDX_8327F8D5ED9D9C26 ON non_conformite (severite_id)');
        $this->addSql('ALTER TABLE audit ADD validator_id INT DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_9218FF79B0644AEC ON audit (validator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79B0644AEC');
        $this->addSql('DROP INDEX IDX_9218FF79B0644AEC ON audit');
        $this->addSql('ALTER TABLE audit DROP validator_id, DROP statut, DROP validated_at, DROP validationstatut, DROP slug');
        $this->addSql('ALTER TABLE non_conformite DROP FOREIGN KEY FK_8327F8D5ED9D9C26');
        $this->addSql('DROP INDEX IDX_8327F8D5ED9D9C26 ON non_conformite');
        $this->addSql('ALTER TABLE non_conformite DROP severite_id');
    }
}
