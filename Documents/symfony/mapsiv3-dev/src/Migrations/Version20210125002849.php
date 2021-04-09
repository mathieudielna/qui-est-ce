<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210125002849 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reclamation ADD redacteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404764D0490 FOREIGN KEY (redacteur_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_CE606404764D0490 ON reclamation (redacteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404764D0490');
        $this->addSql('DROP INDEX IDX_CE606404764D0490 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP redacteur_id');
    }
}
