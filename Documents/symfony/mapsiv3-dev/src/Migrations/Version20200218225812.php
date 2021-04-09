<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200218225812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flux_type_dcpsecu (flux_id INT NOT NULL, type_dcpsecu_id INT NOT NULL, INDEX IDX_DEB05CA3C85926E (flux_id), INDEX IDX_DEB05CA371F123E6 (type_dcpsecu_id), PRIMARY KEY(flux_id, type_dcpsecu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flux_type_dcpsecu ADD CONSTRAINT FK_DEB05CA3C85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_type_dcpsecu ADD CONSTRAINT FK_DEB05CA371F123E6 FOREIGN KEY (type_dcpsecu_id) REFERENCES type_dcpsecu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flux_type_dcpsecu');
    }
}
