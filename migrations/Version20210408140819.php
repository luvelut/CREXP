<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408140819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, subject_id INT NOT NULL, state VARCHAR(10) NOT NULL, published_at DATE NOT NULL, response VARCHAR(250) NOT NULL, INDEX IDX_AEDAD51CCB944F1A (student_id), INDEX IDX_AEDAD51C23EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, name VARCHAR(40) NOT NULL, INDEX IDX_B723AF33296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, teacher_id INT NOT NULL, number_values INT NOT NULL, title VARCHAR(40) NOT NULL, comment VARCHAR(100) NOT NULL, document_path VARCHAR(30) NOT NULL, published_at DATE NOT NULL, INDEX IDX_FBCE3E7A296CD8AE (team_id), INDEX IDX_FBCE3E7A41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, teacher_id INT NOT NULL, name VARCHAR(20) NOT NULL, INDEX IDX_C4E0A61F41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, student_id INT DEFAULT NULL, login VARCHAR(20) NOT NULL, password VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_8D93D64941807E1D (teacher_id), UNIQUE INDEX UNIQ_8D93D649CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64941807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CCB944F1A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CB944F1A');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C23EDC87');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A41807E1D');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F41807E1D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64941807E1D');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33296CD8AE');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A296CD8AE');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
    }
}
