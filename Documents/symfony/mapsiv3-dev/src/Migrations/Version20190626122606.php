<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190626122606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE action_processus (action_id INT NOT NULL, processus_id INT NOT NULL, INDEX IDX_4AEC9F009D32F035 (action_id), INDEX IDX_4AEC9F00A55629DC (processus_id), PRIMARY KEY(action_id, processus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_risque (action_id INT NOT NULL, risque_id INT NOT NULL, INDEX IDX_E2133C4F9D32F035 (action_id), INDEX IDX_E2133C4F4ECC2413 (risque_id), PRIMARY KEY(action_id, risque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_axe (action_id INT NOT NULL, axe_id INT NOT NULL, INDEX IDX_5190806C9D32F035 (action_id), INDEX IDX_5190806C2E30CD41 (axe_id), PRIMARY KEY(action_id, axe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action_processus ADD CONSTRAINT FK_4AEC9F009D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_processus ADD CONSTRAINT FK_4AEC9F00A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_risque ADD CONSTRAINT FK_E2133C4F9D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_risque ADD CONSTRAINT FK_E2133C4F4ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_axe ADD CONSTRAINT FK_5190806C9D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE action_axe ADD CONSTRAINT FK_5190806C2E30CD41 FOREIGN KEY (axe_id) REFERENCES axe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE action_processus');
        $this->addSql('DROP TABLE action_risque');
        $this->addSql('DROP TABLE action_axe');
    }
}
