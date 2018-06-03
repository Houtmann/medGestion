<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180603125117 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, roles CLOB NOT NULL --(DC2Type:array)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP INDEX IDX_1ADAD7EB63179DEF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__patient AS SELECT id, fk_medecin_traitant_id, civilite, nom, prenom, adresse, date_naissance, num_secu FROM patient');
        $this->addSql('DROP TABLE patient');
        $this->addSql('CREATE TABLE patient (id INTEGER NOT NULL, fk_medecin_traitant_id INTEGER DEFAULT NULL, civilite VARCHAR(50) NOT NULL COLLATE BINARY, nom VARCHAR(50) NOT NULL COLLATE BINARY, prenom VARCHAR(50) NOT NULL COLLATE BINARY, adresse VARCHAR(100) NOT NULL COLLATE BINARY, date_naissance DATE NOT NULL, num_secu INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_1ADAD7EB63179DEF FOREIGN KEY (fk_medecin_traitant_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO patient (id, fk_medecin_traitant_id, civilite, nom, prenom, adresse, date_naissance, num_secu) SELECT id, fk_medecin_traitant_id, civilite, nom, prenom, adresse, date_naissance, num_secu FROM __temp__patient');
        $this->addSql('DROP TABLE __temp__patient');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB63179DEF ON patient (fk_medecin_traitant_id)');
        $this->addSql('DROP INDEX IDX_10C31F869BE758EA');
        $this->addSql('DROP INDEX IDX_10C31F86F49DD017');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rdv AS SELECT id, fk_patient_id, fk_medecin_id, date, heure, duree FROM rdv');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('CREATE TABLE rdv (id INTEGER NOT NULL, fk_patient_id INTEGER NOT NULL, fk_medecin_id INTEGER NOT NULL, date DATE NOT NULL, heure DATETIME NOT NULL, duree TIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_10C31F869BE758EA FOREIGN KEY (fk_patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_10C31F86F49DD017 FOREIGN KEY (fk_medecin_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO rdv (id, fk_patient_id, fk_medecin_id, date, heure, duree) SELECT id, fk_patient_id, fk_medecin_id, date, heure, duree FROM __temp__rdv');
        $this->addSql('DROP TABLE __temp__rdv');
        $this->addSql('CREATE INDEX IDX_10C31F869BE758EA ON rdv (fk_patient_id)');
        $this->addSql('CREATE INDEX IDX_10C31F86F49DD017 ON rdv (fk_medecin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE app_users (id INTEGER NOT NULL, username VARCHAR(25) NOT NULL COLLATE BINARY, password VARCHAR(64) NOT NULL COLLATE BINARY, email VARCHAR(254) NOT NULL COLLATE BINARY, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824E7927C74 ON app_users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824F85E0677 ON app_users (username)');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_1ADAD7EB63179DEF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__patient AS SELECT id, fk_medecin_traitant_id, civilite, nom, prenom, adresse, date_naissance, num_secu FROM patient');
        $this->addSql('DROP TABLE patient');
        $this->addSql('CREATE TABLE patient (id INTEGER NOT NULL, fk_medecin_traitant_id INTEGER DEFAULT NULL, civilite VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(100) NOT NULL, date_naissance DATE NOT NULL, num_secu INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO patient (id, fk_medecin_traitant_id, civilite, nom, prenom, adresse, date_naissance, num_secu) SELECT id, fk_medecin_traitant_id, civilite, nom, prenom, adresse, date_naissance, num_secu FROM __temp__patient');
        $this->addSql('DROP TABLE __temp__patient');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB63179DEF ON patient (fk_medecin_traitant_id)');
        $this->addSql('DROP INDEX IDX_10C31F869BE758EA');
        $this->addSql('DROP INDEX IDX_10C31F86F49DD017');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rdv AS SELECT id, fk_patient_id, fk_medecin_id, date, heure, duree FROM rdv');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('CREATE TABLE rdv (id INTEGER NOT NULL, fk_patient_id INTEGER NOT NULL, fk_medecin_id INTEGER NOT NULL, date DATE NOT NULL, heure DATETIME NOT NULL, duree TIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO rdv (id, fk_patient_id, fk_medecin_id, date, heure, duree) SELECT id, fk_patient_id, fk_medecin_id, date, heure, duree FROM __temp__rdv');
        $this->addSql('DROP TABLE __temp__rdv');
        $this->addSql('CREATE INDEX IDX_10C31F869BE758EA ON rdv (fk_patient_id)');
        $this->addSql('CREATE INDEX IDX_10C31F86F49DD017 ON rdv (fk_medecin_id)');
    }
}
