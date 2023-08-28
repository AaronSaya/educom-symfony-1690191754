<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828132719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, vacancy_id INT NOT NULL, status VARCHAR(50) NOT NULL, INDEX IDX_B5F1AFE5433B78C4 (vacancy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activities_profile (activities_id INT NOT NULL, profile_id INT NOT NULL, INDEX IDX_89258E282A4DB562 (activities_id), INDEX IDX_89258E28CCFA12B8 (profile_id), PRIMARY KEY(activities_id, profile_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_id INT NOT NULL, vacancies_id INT NOT NULL, name VARCHAR(50) NOT NULL, logo_url VARCHAR(255) NOT NULL, location VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), INDEX IDX_4FBF094FB897366B (date_id), INDEX IDX_4FBF094FB1ACD019 (vacancies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, date_of_birth VARCHAR(10) NOT NULL, phonenumber VARCHAR(20) NOT NULL, address VARCHAR(50) NOT NULL, postalcode VARCHAR(10) NOT NULL, location VARCHAR(50) NOT NULL, motivation LONGTEXT NOT NULL, foto_url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8157AA0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancies (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, level VARCHAR(30) NOT NULL, location VARCHAR(50) NOT NULL, discription LONGTEXT NOT NULL, logo_url VARCHAR(255) NOT NULL, title VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5433B78C4 FOREIGN KEY (vacancy_id) REFERENCES vacancies (id)');
        $this->addSql('ALTER TABLE activities_profile ADD CONSTRAINT FK_89258E282A4DB562 FOREIGN KEY (activities_id) REFERENCES activities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activities_profile ADD CONSTRAINT FK_89258E28CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB897366B FOREIGN KEY (date_id) REFERENCES vacancies (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB1ACD019 FOREIGN KEY (vacancies_id) REFERENCES vacancies (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5433B78C4');
        $this->addSql('ALTER TABLE activities_profile DROP FOREIGN KEY FK_89258E282A4DB562');
        $this->addSql('ALTER TABLE activities_profile DROP FOREIGN KEY FK_89258E28CCFA12B8');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB897366B');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB1ACD019');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE activities_profile');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE vacancies');
    }
}
