<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617142331 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_statut_pca (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD dima_id INT DEFAULT NULL, ADD pdma_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD CONSTRAINT FK_2E608B94B656D6A2 FOREIGN KEY (dima_id) REFERENCES criticite (id)');
        $this->addSql('ALTER TABLE pca_evenement_app_track ADD CONSTRAINT FK_2E608B9499597DA1 FOREIGN KEY (pdma_id) REFERENCES criticite (id)');
        $this->addSql('CREATE INDEX IDX_2E608B94B656D6A2 ON pca_evenement_app_track (dima_id)');
        $this->addSql('CREATE INDEX IDX_2E608B9499597DA1 ON pca_evenement_app_track (pdma_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE type_statut_pca');
        $this->addSql('ALTER TABLE pca_evenement_app_track DROP FOREIGN KEY FK_2E608B94B656D6A2');
        $this->addSql('ALTER TABLE pca_evenement_app_track DROP FOREIGN KEY FK_2E608B9499597DA1');
        $this->addSql('DROP INDEX IDX_2E608B94B656D6A2 ON pca_evenement_app_track');
        $this->addSql('DROP INDEX IDX_2E608B9499597DA1 ON pca_evenement_app_track');
        $this->addSql('ALTER TABLE pca_evenement_app_track DROP dima_id, DROP pdma_id');
    }
}
