<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201129185649 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impact ADD typesituation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE impact ADD CONSTRAINT FK_C409C00721AC8DC0 FOREIGN KEY (typesituation_id) REFERENCES type_situation (id)');
        $this->addSql('CREATE INDEX IDX_C409C00721AC8DC0 ON impact (typesituation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impact DROP FOREIGN KEY FK_C409C00721AC8DC0');
        $this->addSql('DROP INDEX IDX_C409C00721AC8DC0 ON impact');
        $this->addSql('ALTER TABLE impact DROP typesituation_id');
    }
}
