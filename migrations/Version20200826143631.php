<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200826143631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, entraineur_id INT DEFAULT NULL, horse_id INT DEFAULT NULL, jockey_id INT DEFAULT NULL, distance DOUBLE PRECISION NOT NULL, numero INT NOT NULL, gains INT NOT NULL, cote DOUBLE PRECISION NOT NULL, date DATE NOT NULL, INDEX IDX_169E6FB9F8478A1 (entraineur_id), INDEX IDX_169E6FB976B275AD (horse_id), INDEX IDX_169E6FB920070F6B (jockey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entraineur (id INT AUTO_INCREMENT NOT NULL, entraineur_name VARCHAR(255) NOT NULL, entraineur_age INT DEFAULT NULL, entraineur_sexe VARCHAR(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horse (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT DEFAULT NULL, horse_name VARCHAR(255) NOT NULL, sexe VARCHAR(1) NOT NULL, course_resume VARCHAR(255) NOT NULL, age INT NOT NULL, INDEX IDX_629A2F1876C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jockey (id INT AUTO_INCREMENT NOT NULL, jockey_name VARCHAR(255) NOT NULL, jockey_age INT DEFAULT NULL, poids INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre_date (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, proprietaire_name VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialiste (id INT AUTO_INCREMENT NOT NULL, specialiste_name VARCHAR(255) NOT NULL, specialiste_age INT DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialiste_choice (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, specialiste_id INT DEFAULT NULL, rang INT NOT NULL, date_specialiste_choice DATE NOT NULL, INDEX IDX_4AFBAD6B591CC992 (course_id), INDEX IDX_4AFBAD6B6F1A5C10 (specialiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9F8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB976B275AD FOREIGN KEY (horse_id) REFERENCES horse (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB920070F6B FOREIGN KEY (jockey_id) REFERENCES jockey (id)');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F1876C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE specialiste_choice ADD CONSTRAINT FK_4AFBAD6B591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE specialiste_choice ADD CONSTRAINT FK_4AFBAD6B6F1A5C10 FOREIGN KEY (specialiste_id) REFERENCES specialiste (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specialiste_choice DROP FOREIGN KEY FK_4AFBAD6B591CC992');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9F8478A1');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB976B275AD');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB920070F6B');
        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F1876C50E4A');
        $this->addSql('ALTER TABLE specialiste_choice DROP FOREIGN KEY FK_4AFBAD6B6F1A5C10');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE entraineur');
        $this->addSql('DROP TABLE horse');
        $this->addSql('DROP TABLE jockey');
        $this->addSql('DROP TABLE parametre_date');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE specialiste');
        $this->addSql('DROP TABLE specialiste_choice');
    }
}
