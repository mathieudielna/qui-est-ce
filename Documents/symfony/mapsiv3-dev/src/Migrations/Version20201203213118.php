<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203213118 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rgpd_access_people (rgpd_access_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_4B824EA78C8118C3 (rgpd_access_id), INDEX IDX_4B824EA73147C936 (people_id), PRIMARY KEY(rgpd_access_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rgpd_access_people ADD CONSTRAINT FK_4B824EA78C8118C3 FOREIGN KEY (rgpd_access_id) REFERENCES rgpd_access (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rgpd_access_people ADD CONSTRAINT FK_4B824EA73147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rgpd_access_people');
    }
}
