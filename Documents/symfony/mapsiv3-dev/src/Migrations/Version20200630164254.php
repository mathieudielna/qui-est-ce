<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200630164254 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tier ADD score_id INT DEFAULT NULL, ADD adresse LONGTEXT DEFAULT NULL, ADD codepostal VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, ADD pays VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tier ADD CONSTRAINT FK_249E978A12EB0A51 FOREIGN KEY (score_id) REFERENCES type_score (id)');
        $this->addSql('CREATE INDEX IDX_249E978A12EB0A51 ON tier (score_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tier DROP FOREIGN KEY FK_249E978A12EB0A51');
        $this->addSql('DROP INDEX IDX_249E978A12EB0A51 ON tier');
        $this->addSql('ALTER TABLE tier DROP score_id, DROP adresse, DROP codepostal, DROP ville, DROP pays');
    }
}
