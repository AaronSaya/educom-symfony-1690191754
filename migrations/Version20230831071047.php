<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831071047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, address VARCHAR(50) NOT NULL, location VARCHAR(50) NOT NULL, postal_code VARCHAR(10) NOT NULL, email VARCHAR(100) NOT NULL, phonenumber VARCHAR(20) NOT NULL, logo_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile CHANGE first_name first_name VARCHAR(30) NOT NULL, CHANGE last_name last_name VARCHAR(30) NOT NULL, CHANGE date_of_birth date_of_birth VARCHAR(10) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) NOT NULL, CHANGE foto_url foto_url VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(50) NOT NULL, CHANGE postalcode postalcode VARCHAR(8) NOT NULL, CHANGE location location VARCHAR(50) NOT NULL, CHANGE motivation motivation VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company');
        $this->addSql('ALTER TABLE profile CHANGE first_name first_name VARCHAR(30) DEFAULT NULL, CHANGE last_name last_name VARCHAR(30) DEFAULT NULL, CHANGE date_of_birth date_of_birth VARCHAR(10) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE foto_url foto_url VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(50) DEFAULT NULL, CHANGE postalcode postalcode VARCHAR(8) DEFAULT NULL, CHANGE location location VARCHAR(50) DEFAULT NULL, CHANGE motivation motivation VARCHAR(255) DEFAULT NULL');
    }
}
