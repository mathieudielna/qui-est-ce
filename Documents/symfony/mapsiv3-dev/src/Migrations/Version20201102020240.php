<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102020240 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE application_people (application_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_982566E33E030ACD (application_id), INDEX IDX_982566E33147C936 (people_id), PRIMARY KEY(application_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE systeme_people (systeme_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_295BBE83346F772E (systeme_id), INDEX IDX_295BBE833147C936 (people_id), PRIMARY KEY(systeme_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application_people ADD CONSTRAINT FK_982566E33E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application_people ADD CONSTRAINT FK_982566E33147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE systeme_people ADD CONSTRAINT FK_295BBE83346F772E FOREIGN KEY (systeme_id) REFERENCES systeme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE systeme_people ADD CONSTRAINT FK_295BBE833147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE application_people');
        $this->addSql('DROP TABLE systeme_people');
    }
}
