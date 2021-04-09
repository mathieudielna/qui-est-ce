<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190606140321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE site_site (site_source INT NOT NULL, site_target INT NOT NULL, INDEX IDX_52D9B41D2F24D12C (site_source), INDEX IDX_52D9B41D36C181A3 (site_target), PRIMARY KEY(site_source, site_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE site_site ADD CONSTRAINT FK_52D9B41D2F24D12C FOREIGN KEY (site_source) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site_site ADD CONSTRAINT FK_52D9B41D36C181A3 FOREIGN KEY (site_target) REFERENCES site (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE site_site');
    }
}
