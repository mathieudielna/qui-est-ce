<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617150654 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pca_evenement_serv_track (id INT AUTO_INCREMENT NOT NULL, systeme_id INT NOT NULL, pcaeve_id INT DEFAULT NULL, dima_id INT DEFAULT NULL, pdma_id INT NOT NULL, statut_id INT DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_49F8EB10346F772E (systeme_id), INDEX IDX_49F8EB10DE5CA7E7 (pcaeve_id), INDEX IDX_49F8EB10B656D6A2 (dima_id), INDEX IDX_49F8EB1099597DA1 (pdma_id), INDEX IDX_49F8EB10F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement_serv_track ADD CONSTRAINT FK_49F8EB10346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id)');
        $this->addSql('ALTER TABLE pca_evenement_serv_track ADD CONSTRAINT FK_49F8EB10DE5CA7E7 FOREIGN KEY (pcaeve_id) REFERENCES pca_evenement (id)');
        $this->addSql('ALTER TABLE pca_evenement_serv_track ADD CONSTRAINT FK_49F8EB10B656D6A2 FOREIGN KEY (dima_id) REFERENCES criticite (id)');
        $this->addSql('ALTER TABLE pca_evenement_serv_track ADD CONSTRAINT FK_49F8EB1099597DA1 FOREIGN KEY (pdma_id) REFERENCES criticite (id)');
        $this->addSql('ALTER TABLE pca_evenement_serv_track ADD CONSTRAINT FK_49F8EB10F6203804 FOREIGN KEY (statut_id) REFERENCES type_statut_pca (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pca_evenement_serv_track');
    }
}
