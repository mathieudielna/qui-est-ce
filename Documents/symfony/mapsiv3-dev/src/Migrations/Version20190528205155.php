<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528205155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite CHANGE impactimg impactimg VARCHAR(255) DEFAULT NULL, CHANGE impactactionnaire impactactionnaire VARCHAR(255) DEFAULT NULL, CHANGE impactinterne impactinterne VARCHAR(255) DEFAULT NULL, CHANGE impactbusinessfutur impactbusinessfutur VARCHAR(255) DEFAULT NULL, CHANGE perturbationinterne perturbationinterne LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite CHANGE impactimg impactimg LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE impactactionnaire impactactionnaire LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE impactinterne impactinterne LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE impactbusinessfutur impactbusinessfutur LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE perturbationinterne perturbationinterne LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
