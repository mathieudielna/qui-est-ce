<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123164701 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE non_conformite ADD auditnonconformite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE non_conformite ADD CONSTRAINT FK_8327F8D59D2756EC FOREIGN KEY (auditnonconformite_id) REFERENCES audit (id)');
        $this->addSql('CREATE INDEX IDX_8327F8D59D2756EC ON non_conformite (auditnonconformite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE non_conformite DROP FOREIGN KEY FK_8327F8D59D2756EC');
        $this->addSql('DROP INDEX IDX_8327F8D59D2756EC ON non_conformite');
        $this->addSql('ALTER TABLE non_conformite DROP auditnonconformite_id');
    }
}
