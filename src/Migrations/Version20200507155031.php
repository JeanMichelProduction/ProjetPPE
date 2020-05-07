<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507155031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE classe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE diplome_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE eleves_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE enseignement_comp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etablissement_origine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_formation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE classe (id INT NOT NULL, diplome_id INT DEFAULT NULL, nom_classe VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F87BF9626F859E2 ON classe (diplome_id)');
        $this->addSql('CREATE TABLE diplome (id INT NOT NULL, type_formation_id INT DEFAULT NULL, nom_diplome VARCHAR(255) NOT NULL, lv2_obligatoire INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EB4C4D4ED543922B ON diplome (type_formation_id)');
        $this->addSql('CREATE TABLE eleves (id INT NOT NULL, etablissement_origine_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, enseignement_comp_id INT DEFAULT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, sexe VARCHAR(1) NOT NULL, date_naissance DATE NOT NULL, statut VARCHAR(30) NOT NULL, lv2 VARCHAR(30) DEFAULT NULL, remarque VARCHAR(255) DEFAULT NULL, amenagement_pedagogique VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_383B09B134849FFF ON eleves (etablissement_origine_id)');
        $this->addSql('CREATE INDEX IDX_383B09B18F5EA509 ON eleves (classe_id)');
        $this->addSql('CREATE INDEX IDX_383B09B190E84B90 ON eleves (enseignement_comp_id)');
        $this->addSql('CREATE TABLE enseignement_comp (id INT NOT NULL, diplome_id INT DEFAULT NULL, nom_enseignement_comp VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_86E81FC626F859E2 ON enseignement_comp (diplome_id)');
        $this->addSql('CREATE TABLE etablissement_origine (id INT NOT NULL, nom_etablissement_origine VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_formation (id INT NOT NULL, nom_type_formation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_user (id INT NOT NULL, utilisateur VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tbl_user.roles IS \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9626F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4ED543922B FOREIGN KEY (type_formation_id) REFERENCES type_formation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B134849FFF FOREIGN KEY (etablissement_origine_id) REFERENCES etablissement_origine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B18F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B190E84B90 FOREIGN KEY (enseignement_comp_id) REFERENCES enseignement_comp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enseignement_comp ADD CONSTRAINT FK_86E81FC626F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE eleves DROP CONSTRAINT FK_383B09B18F5EA509');
        $this->addSql('ALTER TABLE classe DROP CONSTRAINT FK_8F87BF9626F859E2');
        $this->addSql('ALTER TABLE enseignement_comp DROP CONSTRAINT FK_86E81FC626F859E2');
        $this->addSql('ALTER TABLE eleves DROP CONSTRAINT FK_383B09B190E84B90');
        $this->addSql('ALTER TABLE eleves DROP CONSTRAINT FK_383B09B134849FFF');
        $this->addSql('ALTER TABLE diplome DROP CONSTRAINT FK_EB4C4D4ED543922B');
        $this->addSql('DROP SEQUENCE classe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE diplome_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE eleves_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE enseignement_comp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etablissement_origine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_formation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_user_id_seq CASCADE');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE eleves');
        $this->addSql('DROP TABLE enseignement_comp');
        $this->addSql('DROP TABLE etablissement_origine');
        $this->addSql('DROP TABLE type_formation');
        $this->addSql('DROP TABLE tbl_user');
    }
}
