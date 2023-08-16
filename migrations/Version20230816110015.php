<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816110015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, vacancies_id INT NOT NULL, status VARCHAR(50) NOT NULL, date DATE NOT NULL, INDEX IDX_B5F1AFE567B3B43D (users_id), INDEX IDX_B5F1AFE5B1ACD019 (vacancies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, date_of_birth VARCHAR(10) NOT NULL, phone_number INT NOT NULL, address VARCHAR(50) NOT NULL, postal_code VARCHAR(6) NOT NULL, residence VARCHAR(50) NOT NULL, motivation LONGTEXT NOT NULL, picture LONGBLOB NOT NULL, cv LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0F67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5B1ACD019 FOREIGN KEY (vacancies_id) REFERENCES vacancies (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE567B3B43D');
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5B1ACD019');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F67B3B43D');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE profile');
    }
}
