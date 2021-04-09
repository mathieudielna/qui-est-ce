<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210125132009 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reclamation ADD anonyme_id INT DEFAULT NULL, ADD information_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404433B2C47 FOREIGN KEY (anonyme_id) REFERENCES oui_non (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064042EF03101 FOREIGN KEY (information_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_CE606404433B2C47 ON reclamation (anonyme_id)');
        $this->addSql('CREATE INDEX IDX_CE6064042EF03101 ON reclamation (information_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404433B2C47');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064042EF03101');
        $this->addSql('DROP INDEX IDX_CE606404433B2C47 ON reclamation');
        $this->addSql('DROP INDEX IDX_CE6064042EF03101 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP anonyme_id, DROP information_id');
    }
}
