<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029213152 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tier ADD publisher_id INT DEFAULT NULL, ADD published_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tier ADD CONSTRAINT FK_249E978A40C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_249E978A40C86FCE ON tier (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tier DROP FOREIGN KEY FK_249E978A40C86FCE');
        $this->addSql('DROP INDEX IDX_249E978A40C86FCE ON tier');
        $this->addSql('ALTER TABLE tier DROP publisher_id, DROP published_at');
    }
}
