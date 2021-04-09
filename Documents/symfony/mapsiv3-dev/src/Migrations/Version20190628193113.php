<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628193113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_connect_activite (id INT AUTO_INCREMENT NOT NULL, application_id INT DEFAULT NULL, activite_id INT DEFAULT NULL, dima_id INT DEFAULT NULL, pdma_id INT DEFAULT NULL, INDEX IDX_3B30D3A03E030ACD (application_id), INDEX IDX_3B30D3A09B0F88B1 (activite_id), INDEX IDX_3B30D3A0B656D6A2 (dima_id), INDEX IDX_3B30D3A099597DA1 (pdma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_connect_activite ADD CONSTRAINT FK_3B30D3A03E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
        $this->addSql('ALTER TABLE app_connect_activite ADD CONSTRAINT FK_3B30D3A09B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE app_connect_activite ADD CONSTRAINT FK_3B30D3A0B656D6A2 FOREIGN KEY (dima_id) REFERENCES criticite (id)');
        $this->addSql('ALTER TABLE app_connect_activite ADD CONSTRAINT FK_3B30D3A099597DA1 FOREIGN KEY (pdma_id) REFERENCES criticite (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE app_connect_activite');
    }
}
