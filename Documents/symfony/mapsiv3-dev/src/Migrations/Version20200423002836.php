<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423002836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE systeme_exercicepca');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systeme_exercicepca (systeme_id INT NOT NULL, exercicepca_id INT NOT NULL, INDEX IDX_40E80EBAAD5D07CE (exercicepca_id), INDEX IDX_40E80EBA346F772E (systeme_id), PRIMARY KEY(systeme_id, exercicepca_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE systeme_exercicepca ADD CONSTRAINT FK_40E80EBA346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE systeme_exercicepca ADD CONSTRAINT FK_40E80EBAAD5D07CE FOREIGN KEY (exercicepca_id) REFERENCES exercicepca (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
