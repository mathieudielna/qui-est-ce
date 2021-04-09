<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029161747 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE people ADD publisher_id INT DEFAULT NULL, ADD published_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE people ADD CONSTRAINT FK_28166A2640C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_28166A2640C86FCE ON people (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE people DROP FOREIGN KEY FK_28166A2640C86FCE');
        $this->addSql('DROP INDEX IDX_28166A2640C86FCE ON people');
        $this->addSql('ALTER TABLE people DROP publisher_id, DROP published_at');
    }
}
