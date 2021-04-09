<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126004601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actionstrat_action (actionstrat_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_F1B864676ED50D60 (actionstrat_id), INDEX IDX_F1B864679D32F035 (action_id), PRIMARY KEY(actionstrat_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actionstrat_action ADD CONSTRAINT FK_F1B864676ED50D60 FOREIGN KEY (actionstrat_id) REFERENCES actionstrat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actionstrat_action ADD CONSTRAINT FK_F1B864679D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE actionstrat_action');
    }
}
