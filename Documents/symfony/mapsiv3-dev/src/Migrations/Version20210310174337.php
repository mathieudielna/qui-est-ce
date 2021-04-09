<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310174337 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE controle_people (controle_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_653741BC758926A6 (controle_id), INDEX IDX_653741BC3147C936 (people_id), PRIMARY KEY(controle_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controle_type_conformite (controle_id INT NOT NULL, type_conformite_id INT NOT NULL, INDEX IDX_C95EE14D758926A6 (controle_id), INDEX IDX_C95EE14D79A28B64 (type_conformite_id), PRIMARY KEY(controle_id, type_conformite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controle_people ADD CONSTRAINT FK_653741BC758926A6 FOREIGN KEY (controle_id) REFERENCES controle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_people ADD CONSTRAINT FK_653741BC3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_type_conformite ADD CONSTRAINT FK_C95EE14D758926A6 FOREIGN KEY (controle_id) REFERENCES controle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_type_conformite ADD CONSTRAINT FK_C95EE14D79A28B64 FOREIGN KEY (type_conformite_id) REFERENCES type_conformite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396E40C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_E39396E40C86FCE ON controle (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE controle_people');
        $this->addSql('DROP TABLE controle_type_conformite');
        $this->addSql('ALTER TABLE controle DROP FOREIGN KEY FK_E39396E40C86FCE');
        $this->addSql('DROP INDEX IDX_E39396E40C86FCE ON controle');
        $this->addSql('ALTER TABLE controle DROP publisher_id');
    }
}
