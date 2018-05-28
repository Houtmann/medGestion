<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180528130741 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE medecin (id INTEGER NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, civilite VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE patient (id INTEGER NOT NULL, fk_medecin_traitant_id INTEGER DEFAULT NULL, civilite VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(100) NOT NULL, date_naissance DATE NOT NULL, num_secu INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB63179DEF ON patient (fk_medecin_traitant_id)');
        $this->addSql('CREATE TABLE rdv (id INTEGER NOT NULL, fk_patient_id INTEGER NOT NULL, fk_medecin_id INTEGER NOT NULL, date DATE NOT NULL, heure DATETIME NOT NULL, duree TIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_10C31F869BE758EA ON rdv (fk_patient_id)');
        $this->addSql('CREATE INDEX IDX_10C31F86F49DD017 ON rdv (fk_medecin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE rdv');
    }
}
