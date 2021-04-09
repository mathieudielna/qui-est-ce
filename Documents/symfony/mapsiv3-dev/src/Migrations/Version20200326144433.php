<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326144433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement ADD statut_id INT DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE pca_evenement ADD CONSTRAINT FK_DE266C73F6203804 FOREIGN KEY (statut_id) REFERENCES type_statut (id)');
        $this->addSql('CREATE INDEX IDX_DE266C73F6203804 ON pca_evenement (statut_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pca_evenement DROP FOREIGN KEY FK_DE266C73F6203804');
        $this->addSql('DROP INDEX IDX_DE266C73F6203804 ON pca_evenement');
        $this->addSql('ALTER TABLE pca_evenement DROP statut_id, DROP commentaire');
    }
}
