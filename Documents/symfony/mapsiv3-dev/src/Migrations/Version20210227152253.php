<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227152253 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE controle ADD responsable_id INT DEFAULT NULL, ADD suppleant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396E53C59D72 FOREIGN KEY (responsable_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396E67A3C51B FOREIGN KEY (suppleant_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E39396E53C59D72 ON controle (responsable_id)');
        $this->addSql('CREATE INDEX IDX_E39396E67A3C51B ON controle (suppleant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE controle DROP FOREIGN KEY FK_E39396E53C59D72');
        $this->addSql('ALTER TABLE controle DROP FOREIGN KEY FK_E39396E67A3C51B');
        $this->addSql('DROP INDEX IDX_E39396E53C59D72 ON controle');
        $this->addSql('DROP INDEX IDX_E39396E67A3C51B ON controle');
        $this->addSql('ALTER TABLE controle DROP responsable_id, DROP suppleant_id');
    }
}
