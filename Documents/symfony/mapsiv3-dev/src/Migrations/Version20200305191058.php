<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305191058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE risque_type_conformite (risque_id INT NOT NULL, type_conformite_id INT NOT NULL, INDEX IDX_A855C89B4ECC2413 (risque_id), INDEX IDX_A855C89B79A28B64 (type_conformite_id), PRIMARY KEY(risque_id, type_conformite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE risque_type_conformite ADD CONSTRAINT FK_A855C89B4ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque_type_conformite ADD CONSTRAINT FK_A855C89B79A28B64 FOREIGN KEY (type_conformite_id) REFERENCES type_conformite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE risque_type_conformite');
    }
}
