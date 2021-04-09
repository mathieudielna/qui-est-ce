<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605180102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flux_objet_metier (flux_id INT NOT NULL, objet_metier_id INT NOT NULL, INDEX IDX_DEE0422DC85926E (flux_id), INDEX IDX_DEE0422D25707B47 (objet_metier_id), PRIMARY KEY(flux_id, objet_metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flux_objet_metier ADD CONSTRAINT FK_DEE0422DC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_objet_metier ADD CONSTRAINT FK_DEE0422D25707B47 FOREIGN KEY (objet_metier_id) REFERENCES objet_metier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flux_objet_metier');
    }
}
