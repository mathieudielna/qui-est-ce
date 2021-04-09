<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129230023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systemehost (systeme_id INT NOT NULL, host_id INT NOT NULL, INDEX IDX_357A002C346F772E (systeme_id), INDEX IDX_357A002C1FB8D185 (host_id), PRIMARY KEY(systeme_id, host_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE systemehost ADD CONSTRAINT FK_357A002C346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id)');
        $this->addSql('ALTER TABLE systemehost ADD CONSTRAINT FK_357A002C1FB8D185 FOREIGN KEY (host_id) REFERENCES systeme (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE systemehost');
    }
}
