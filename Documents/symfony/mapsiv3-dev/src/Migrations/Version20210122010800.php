<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122010800 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite_site ADD validator_id INT DEFAULT NULL, ADD validationstatut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE visite_site ADD CONSTRAINT FK_E432A655B0644AEC FOREIGN KEY (validator_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E432A655B0644AEC ON visite_site (validator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite_site DROP FOREIGN KEY FK_E432A655B0644AEC');
        $this->addSql('DROP INDEX IDX_E432A655B0644AEC ON visite_site');
        $this->addSql('ALTER TABLE visite_site DROP validator_id, DROP validationstatut');
    }
}
