<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529003042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite ADD impact4h_id INT DEFAULT NULL, ADD impact1j_id INT DEFAULT NULL, ADD impact3j_id INT DEFAULT NULL, ADD impact1s_id INT DEFAULT NULL, ADD impact2s_id INT DEFAULT NULL, ADD impact1m_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515913B3146 FOREIGN KEY (impact4h_id) REFERENCES niveau_impact (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515F3D276BD FOREIGN KEY (impact1j_id) REFERENCES niveau_impact (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515891225DD FOREIGN KEY (impact3j_id) REFERENCES niveau_impact (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515DEC36EA8 FOREIGN KEY (impact1s_id) REFERENCES niveau_impact (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B875551599631478 FOREIGN KEY (impact2s_id) REFERENCES niveau_impact (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555156E054E04 FOREIGN KEY (impact1m_id) REFERENCES niveau_impact (id)');
        $this->addSql('CREATE INDEX IDX_B8755515913B3146 ON activite (impact4h_id)');
        $this->addSql('CREATE INDEX IDX_B8755515F3D276BD ON activite (impact1j_id)');
        $this->addSql('CREATE INDEX IDX_B8755515891225DD ON activite (impact3j_id)');
        $this->addSql('CREATE INDEX IDX_B8755515DEC36EA8 ON activite (impact1s_id)');
        $this->addSql('CREATE INDEX IDX_B875551599631478 ON activite (impact2s_id)');
        $this->addSql('CREATE INDEX IDX_B87555156E054E04 ON activite (impact1m_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515913B3146');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515F3D276BD');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515891225DD');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515DEC36EA8');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B875551599631478');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555156E054E04');
        $this->addSql('DROP INDEX IDX_B8755515913B3146 ON activite');
        $this->addSql('DROP INDEX IDX_B8755515F3D276BD ON activite');
        $this->addSql('DROP INDEX IDX_B8755515891225DD ON activite');
        $this->addSql('DROP INDEX IDX_B8755515DEC36EA8 ON activite');
        $this->addSql('DROP INDEX IDX_B875551599631478 ON activite');
        $this->addSql('DROP INDEX IDX_B87555156E054E04 ON activite');
        $this->addSql('ALTER TABLE activite DROP impact4h_id, DROP impact1j_id, DROP impact3j_id, DROP impact1s_id, DROP impact2s_id, DROP impact1m_id');
    }
}
