<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908220102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD metier_id INT DEFAULT NULL, ADD pilote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9F510AAE9 FOREIGN KEY (pilote_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9ED16FA20 ON projet (metier_id)');
        $this->addSql('CREATE INDEX IDX_50159CA9F510AAE9 ON projet (pilote_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9ED16FA20');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9F510AAE9');
        $this->addSql('DROP INDEX IDX_50159CA9ED16FA20 ON projet');
        $this->addSql('DROP INDEX IDX_50159CA9F510AAE9 ON projet');
        $this->addSql('ALTER TABLE projet DROP metier_id, DROP pilote_id');
    }
}
