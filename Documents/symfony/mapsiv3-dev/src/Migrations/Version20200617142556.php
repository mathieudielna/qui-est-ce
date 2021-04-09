<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617142556 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_statut_pca ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_statut_pca ADD CONSTRAINT FK_AE99827F9395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_AE99827F9395C3F3 ON type_statut_pca (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_statut_pca DROP FOREIGN KEY FK_AE99827F9395C3F3');
        $this->addSql('DROP INDEX IDX_AE99827F9395C3F3 ON type_statut_pca');
        $this->addSql('ALTER TABLE type_statut_pca DROP customer_id');
    }
}
