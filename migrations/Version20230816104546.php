<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816104546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, logo_url VARCHAR(100) NOT NULL, name VARCHAR(50) NOT NULL, location VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, pswd VARCHAR(150) NOT NULL, role VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancies (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, date DATE NOT NULL, level VARCHAR(50) NOT NULL, location VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, logo_url VARCHAR(100) NOT NULL, title VARCHAR(50) NOT NULL, INDEX IDX_99165A59979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vacancies ADD CONSTRAINT FK_99165A59979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vacancies DROP FOREIGN KEY FK_99165A59979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE vacancies');
    }
}
