<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123141623 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE non_conformite ADD customer_id INT DEFAULT NULL, ADD audit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE non_conformite ADD CONSTRAINT FK_8327F8D59395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('ALTER TABLE non_conformite ADD CONSTRAINT FK_8327F8D5BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('CREATE INDEX IDX_8327F8D59395C3F3 ON non_conformite (customer_id)');
        $this->addSql('CREATE INDEX IDX_8327F8D5BD29F359 ON non_conformite (audit_id)');
        $this->addSql('ALTER TABLE audit ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF799395C3F3 FOREIGN KEY (customer_id) REFERENCES mapsi_customer (id)');
        $this->addSql('CREATE INDEX IDX_9218FF799395C3F3 ON audit (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF799395C3F3');
        $this->addSql('DROP INDEX IDX_9218FF799395C3F3 ON audit');
        $this->addSql('ALTER TABLE audit DROP customer_id');
        $this->addSql('ALTER TABLE non_conformite DROP FOREIGN KEY FK_8327F8D59395C3F3');
        $this->addSql('ALTER TABLE non_conformite DROP FOREIGN KEY FK_8327F8D5BD29F359');
        $this->addSql('DROP INDEX IDX_8327F8D59395C3F3 ON non_conformite');
        $this->addSql('DROP INDEX IDX_8327F8D5BD29F359 ON non_conformite');
        $this->addSql('ALTER TABLE non_conformite DROP customer_id, DROP audit_id');
    }
}
