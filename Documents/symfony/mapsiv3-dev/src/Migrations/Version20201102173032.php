<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102173032 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE action ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C9240C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_47CC8C9240C86FCE ON action (publisher_id)');
        $this->addSql('ALTER TABLE projet ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA940C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_50159CA940C86FCE ON projet (publisher_id)');
        $this->addSql('ALTER TABLE program ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778440C86FCE FOREIGN KEY (publisher_id) REFERENCES people (id)');
        $this->addSql('CREATE INDEX IDX_92ED778440C86FCE ON program (publisher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C9240C86FCE');
        $this->addSql('DROP INDEX IDX_47CC8C9240C86FCE ON action');
        $this->addSql('ALTER TABLE action DROP publisher_id');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778440C86FCE');
        $this->addSql('DROP INDEX IDX_92ED778440C86FCE ON program');
        $this->addSql('ALTER TABLE program DROP publisher_id');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA940C86FCE');
        $this->addSql('DROP INDEX IDX_50159CA940C86FCE ON projet');
        $this->addSql('ALTER TABLE projet DROP publisher_id');
    }
}
