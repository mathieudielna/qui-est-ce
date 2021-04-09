<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130022230 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspect_env ADD typeaspectenv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aspect_env ADD CONSTRAINT FK_7C07B51EB5D71121 FOREIGN KEY (typeaspectenv_id) REFERENCES type_aspect_env (id)');
        $this->addSql('CREATE INDEX IDX_7C07B51EB5D71121 ON aspect_env (typeaspectenv_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspect_env DROP FOREIGN KEY FK_7C07B51EB5D71121');
        $this->addSql('DROP INDEX IDX_7C07B51EB5D71121 ON aspect_env');
        $this->addSql('ALTER TABLE aspect_env DROP typeaspectenv_id');
    }
}
