<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605180901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE supports (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flux_type_support (flux_id INT NOT NULL, type_support_id INT NOT NULL, INDEX IDX_92BA26DBC85926E (flux_id), INDEX IDX_92BA26DB1E166220 (type_support_id), PRIMARY KEY(flux_id, type_support_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flux_type_support ADD CONSTRAINT FK_92BA26DBC85926E FOREIGN KEY (flux_id) REFERENCES flux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux_type_support ADD CONSTRAINT FK_92BA26DB1E166220 FOREIGN KEY (type_support_id) REFERENCES type_support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flux DROP support');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE supports');
        $this->addSql('DROP TABLE flux_type_support');
        $this->addSql('ALTER TABLE flux ADD support VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
