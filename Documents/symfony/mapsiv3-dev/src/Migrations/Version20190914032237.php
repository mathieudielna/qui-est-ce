<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190914032237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systeme_systeme (systeme_source INT NOT NULL, systeme_target INT NOT NULL, INDEX IDX_33C477505EC7ABD6 (systeme_source), INDEX IDX_33C477504722FB59 (systeme_target), PRIMARY KEY(systeme_source, systeme_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE systeme_systeme ADD CONSTRAINT FK_33C477505EC7ABD6 FOREIGN KEY (systeme_source) REFERENCES systeme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE systeme_systeme ADD CONSTRAINT FK_33C477504722FB59 FOREIGN KEY (systeme_target) REFERENCES systeme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE systeme_systeme');
    }
}
