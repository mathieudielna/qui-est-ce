<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200327134017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pca_evenement_type_pca_evenement (pca_evenement_id INT NOT NULL, type_pca_evenement_id INT NOT NULL, INDEX IDX_13165C842BB3B2B1 (pca_evenement_id), INDEX IDX_13165C847C2C3300 (type_pca_evenement_id), PRIMARY KEY(pca_evenement_id, type_pca_evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pca_evenement_type_pca_evenement ADD CONSTRAINT FK_13165C842BB3B2B1 FOREIGN KEY (pca_evenement_id) REFERENCES pca_evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pca_evenement_type_pca_evenement ADD CONSTRAINT FK_13165C847C2C3300 FOREIGN KEY (type_pca_evenement_id) REFERENCES type_pca_evenement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pca_evenement_type_pca_evenement');
    }
}
