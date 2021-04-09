<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190913174655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE application_application (application_source INT NOT NULL, application_target INT NOT NULL, INDEX IDX_D90F0A3EFB973B6 (application_source), INDEX IDX_D90F0A3F65C2339 (application_target), PRIMARY KEY(application_source, application_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application_application ADD CONSTRAINT FK_D90F0A3EFB973B6 FOREIGN KEY (application_source) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application_application ADD CONSTRAINT FK_D90F0A3F65C2339 FOREIGN KEY (application_target) REFERENCES application (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE application_application');
    }
}
