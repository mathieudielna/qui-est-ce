<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200730235501 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objectif_indicateur ADD objectif_id INT NOT NULL');
        $this->addSql('ALTER TABLE objectif_indicateur ADD CONSTRAINT FK_88F6CFA1157D1AD4 FOREIGN KEY (objectif_id) REFERENCES objectif (id)');
        $this->addSql('CREATE INDEX IDX_88F6CFA1157D1AD4 ON objectif_indicateur (objectif_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objectif_indicateur DROP FOREIGN KEY FK_88F6CFA1157D1AD4');
        $this->addSql('DROP INDEX IDX_88F6CFA1157D1AD4 ON objectif_indicateur');
        $this->addSql('ALTER TABLE objectif_indicateur DROP objectif_id');
    }
}
