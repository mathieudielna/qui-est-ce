<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130022035 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aspect_env_type_aspect_env');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aspect_env_type_aspect_env (aspect_env_id INT NOT NULL, type_aspect_env_id INT NOT NULL, INDEX IDX_2E5ECCBC772F8468 (aspect_env_id), INDEX IDX_2E5ECCBC7C2335D (type_aspect_env_id), PRIMARY KEY(aspect_env_id, type_aspect_env_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE aspect_env_type_aspect_env ADD CONSTRAINT FK_2E5ECCBC772F8468 FOREIGN KEY (aspect_env_id) REFERENCES aspect_env (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspect_env_type_aspect_env ADD CONSTRAINT FK_2E5ECCBC7C2335D FOREIGN KEY (type_aspect_env_id) REFERENCES type_aspect_env (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
