<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926150033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tier ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tier ADD CONSTRAINT FK_249E978AC54C8C93 FOREIGN KEY (type_id) REFERENCES type_tier (id)');
        $this->addSql('CREATE INDEX IDX_249E978AC54C8C93 ON tier (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tier DROP FOREIGN KEY FK_249E978AC54C8C93');
        $this->addSql('DROP INDEX IDX_249E978AC54C8C93 ON tier');
        $this->addSql('ALTER TABLE tier DROP type_id');
    }
}
