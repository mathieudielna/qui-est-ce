<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523212324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oui_non (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD pca_id INT DEFAULT NULL, DROP flux, DROP pca');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555157EE82DBB FOREIGN KEY (pca_id) REFERENCES oui_non (id)');
        $this->addSql('CREATE INDEX IDX_B87555157EE82DBB ON activite (pca_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555157EE82DBB');
        $this->addSql('DROP TABLE oui_non');
        $this->addSql('DROP INDEX IDX_B87555157EE82DBB ON activite');
        $this->addSql('ALTER TABLE activite ADD flux VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD pca VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP pca_id');
    }
}
