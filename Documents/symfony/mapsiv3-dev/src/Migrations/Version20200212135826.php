<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212135826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux DROP FOREIGN KEY FK_7252313AAC07831C');
        $this->addSql('DROP INDEX IDX_7252313AAC07831C ON flux');
        $this->addSql('ALTER TABLE flux DROP transfertue_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flux ADD transfertue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flux ADD CONSTRAINT FK_7252313AAC07831C FOREIGN KEY (transfertue_id) REFERENCES oui_non (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7252313AAC07831C ON flux (transfertue_id)');
    }
}
