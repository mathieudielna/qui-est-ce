<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616132928 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C7367A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_DE266C7367A3C51B ON pca_evenement (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement DROP FOREIGN KEY FK_DE266C7367A3C51B');
        $this->addSql('DROP INDEX IDX_DE266C7367A3C51B ON pca_evenement');
        $this->addSql('ALTER TABLE pca_evenement DROP suppleant_id');
    }
}
