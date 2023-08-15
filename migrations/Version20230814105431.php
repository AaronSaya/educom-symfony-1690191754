<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814105431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE optreden (id INT AUTO_INCREMENT NOT NULL, poppodium_id INT NOT NULL, artiest_id INT NOT NULL, voorprogramma_id INT NOT NULL, omschrijving LONGTEXT NOT NULL, datum DATE NOT NULL, prijs INT NOT NULL, ticket_url VARCHAR(50) NOT NULL, afbeelding_url VARCHAR(100) NOT NULL, INDEX IDX_6286F65DA2EEBB18 (poppodium_id), INDEX IDX_6286F65DAED85528 (artiest_id), INDEX IDX_6286F65DE017CE10 (voorprogramma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DA2EEBB18 FOREIGN KEY (poppodium_id) REFERENCES poppodium (id)');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DAED85528 FOREIGN KEY (artiest_id) REFERENCES artiest (id)');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DE017CE10 FOREIGN KEY (voorprogramma_id) REFERENCES artiest (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE optreden DROP FOREIGN KEY FK_6286F65DA2EEBB18');
        $this->addSql('ALTER TABLE optreden DROP FOREIGN KEY FK_6286F65DAED85528');
        $this->addSql('ALTER TABLE optreden DROP FOREIGN KEY FK_6286F65DE017CE10');
        $this->addSql('DROP TABLE optreden');
    }
}
