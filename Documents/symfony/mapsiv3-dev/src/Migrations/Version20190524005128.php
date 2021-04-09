<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524005128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD processus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id)');
        $this->addSql('CREATE INDEX IDX_B8755515A55629DC ON activite (processus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515A55629DC');
        $this->addSql('DROP INDEX IDX_B8755515A55629DC ON activite');
        $this->addSql('ALTER TABLE activite DROP processus_id');
    }
}
