<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913114644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities CHANGE invitation invitation VARBINARY(255) NOT NULL');
        $this->addSql('ALTER TABLE company CHANGE name name VARCHAR(50) NOT NULL, CHANGE address address VARCHAR(50) NOT NULL, CHANGE location location VARCHAR(50) NOT NULL, CHANGE postal_code postal_code VARCHAR(10) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) NOT NULL, CHANGE logo_url logo_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE profile ADD cv_file VARCHAR(255) NOT NULL, ADD image_file VARCHAR(255) NOT NULL, CHANGE first_name first_name VARCHAR(30) NOT NULL, CHANGE last_name last_name VARCHAR(30) NOT NULL, CHANGE date_of_birth date_of_birth VARCHAR(10) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) NOT NULL, CHANGE foto_url foto_url VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(50) NOT NULL, CHANGE postalcode postalcode VARCHAR(8) NOT NULL, CHANGE location location VARCHAR(50) NOT NULL, CHANGE motivation motivation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vacancies CHANGE date date DATE NOT NULL, CHANGE level level VARCHAR(50) NOT NULL, CHANGE title title VARCHAR(50) NOT NULL, CHANGE location location VARCHAR(50) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE logo_function_url logo_function_url VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities CHANGE invitation invitation VARBINARY(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE company CHANGE name name VARCHAR(50) DEFAULT NULL, CHANGE address address VARCHAR(50) DEFAULT NULL, CHANGE location location VARCHAR(50) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(10) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE logo_url logo_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE profile DROP cv_file, DROP image_file, CHANGE first_name first_name VARCHAR(30) DEFAULT NULL, CHANGE last_name last_name VARCHAR(30) DEFAULT NULL, CHANGE date_of_birth date_of_birth VARCHAR(10) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE foto_url foto_url VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(50) DEFAULT NULL, CHANGE postalcode postalcode VARCHAR(8) DEFAULT NULL, CHANGE location location VARCHAR(50) DEFAULT NULL, CHANGE motivation motivation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vacancies CHANGE date date DATE DEFAULT NULL, CHANGE level level VARCHAR(50) DEFAULT NULL, CHANGE title title VARCHAR(50) DEFAULT NULL, CHANGE location location VARCHAR(50) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE logo_function_url logo_function_url VARCHAR(255) DEFAULT NULL');
    }
}
