<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616135438 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pca_evenement_app_track (id INT AUTO_INCREMENT NOT NULL, pca_evenement_id INT NOT NULL, application_id INT NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_2E608B942BB3B2B1 (pca_evenement_id), INDEX IDX_2E608B943E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD CONSTRAINT FK_2E608B942BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id)');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD CONSTRAINT FK_2E608B943E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pca_evenement_app_track');
    }
}
