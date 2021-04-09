<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610201652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme ADD os_id INT DEFAULT NULL, DROP os');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE33DCA04D1 FOREIGN KEY (os_id) REFERENCES type_os (id)');
        $this->addSql('CREATE INDEX IDX_95796DE33DCA04D1 ON systeme (os_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE systeme DROP FOREIGN KEY FK_95796DE33DCA04D1');
        $this->addSql('DROP INDEX IDX_95796DE33DCA04D1 ON systeme');
        $this->addSql('ALTER TABLE systeme ADD os VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP os_id');
    }
}
