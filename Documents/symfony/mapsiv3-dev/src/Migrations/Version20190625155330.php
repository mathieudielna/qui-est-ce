<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625155330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE risque_processus (risque_id INT NOT NULL, processus_id INT NOT NULL, INDEX IDX_ACCB35D44ECC2413 (risque_id), INDEX IDX_ACCB35D4A55629DC (processus_id), PRIMARY KEY(risque_id, processus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risque_metier (risque_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_9AC1EB44ECC2413 (risque_id), INDEX IDX_9AC1EB4ED16FA20 (metier_id), PRIMARY KEY(risque_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE risque_processus ADD CONSTRAINT FK_ACCB35D44ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque_processus ADD CONSTRAINT FK_ACCB35D4A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque_metier ADD CONSTRAINT FK_9AC1EB44ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE risque_metier ADD CONSTRAINT FK_9AC1EB4ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE risque_processus');
        $this->addSql('DROP TABLE risque_metier');
    }
}
