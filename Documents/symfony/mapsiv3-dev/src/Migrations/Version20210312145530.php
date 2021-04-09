<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312145530 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspect_env ADD processuses_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51E2C0DCDD4 FOREIGN KEY (processuses_id) REFERENCES processus (id)');
        $this->addSql('CREATE INDEX IDX_7C07B51E2C0DCDD4 ON aspect_env (processuses_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspect_env DROP FOREIGN KEY FK_7C07B51E2C0DCDD4');
        $this->addSql('DROP INDEX IDX_7C07B51E2C0DCDD4 ON aspect_env');
        $this->addSql('ALTER TABLE aspect_env DROP processuses_id');
    }
}
