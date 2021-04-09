<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113141455 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program ADD responsable_id INT DEFAULT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD validated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778453C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_92ED778453C59D72 ON program (responsable_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778453C59D72');
        $this->addSql('DROP INDEX IDX_92ED778453C59D72 ON program');
        $this->addSql('ALTER TABLE program DROP responsable_id, DROP statut, DROP validated_at');
    }
}
