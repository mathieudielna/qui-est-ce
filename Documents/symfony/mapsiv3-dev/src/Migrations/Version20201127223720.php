<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127223720 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impact ADD aspectenv_id INT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE impact ADD CONSTRAINT FK_C409C007A073744E FOREIGN KEY (aspectenv_id) REFERENCES aspect_env (id)');
        $this->addSql('CREATE INDEX IDX_C409C007A073744E ON impact (aspectenv_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impact DROP FOREIGN KEY FK_C409C007A073744E');
        $this->addSql('DROP INDEX IDX_C409C007A073744E ON impact');
        $this->addSql('ALTER TABLE impact DROP aspectenv_id, DROP slug');
    }
}
