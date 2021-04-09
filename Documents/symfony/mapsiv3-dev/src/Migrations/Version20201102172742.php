<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102172742 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action ADD publisher_id INT DEFAULT NULL, ADD published_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE jalon_connect_action ADD CONSTRAINT FK_57AA62940C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_57AA62940C86FCE ON jalon_connect_action (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jalon_connect_action DROP FOREIGN KEY FK_57AA62940C86FCE');
        $this->addSql('DROP INDEX IDX_57AA62940C86FCE ON jalon_connect_action');
        $this->addSql('ALTER TABLE jalon_connect_action DROP publisher_id, DROP published_at');
    }
}
