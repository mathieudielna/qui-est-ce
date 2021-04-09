<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191118202722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet ADD program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA93EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_50159CA93EB8070A ON projet (program_id)');
        $this->addSql('ALTER TABLE program ADD pilote_id INT DEFAULT NULL, ADD code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784F510AAE9 FOREIGN KEY (pilote_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_92ED7784F510AAE9 ON program (pilote_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784F510AAE9');
        $this->addSql('DROP INDEX IDX_92ED7784F510AAE9 ON program');
        $this->addSql('ALTER TABLE program DROP pilote_id, DROP code');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA93EB8070A');
        $this->addSql('DROP INDEX IDX_50159CA93EB8070A ON projet');
        $this->addSql('ALTER TABLE projet DROP program_id');
    }
}
