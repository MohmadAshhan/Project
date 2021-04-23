<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200718171003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contest (id INT AUTO_INCREMENT NOT NULL, nickname VARCHAR(255) NOT NULL, condition_contest VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prize (id INT AUTO_INCREMENT NOT NULL, contest_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, amount INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_51C88BC11CD0F0DE (contest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prize_image (id INT AUTO_INCREMENT NOT NULL, prize_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_8D00263FBBE43214 (prize_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prize ADD CONSTRAINT FK_51C88BC11CD0F0DE FOREIGN KEY (contest_id) REFERENCES contest (id)');
        $this->addSql('ALTER TABLE prize_image ADD CONSTRAINT FK_8D00263FBBE43214 FOREIGN KEY (prize_id) REFERENCES prize (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prize DROP FOREIGN KEY FK_51C88BC11CD0F0DE');
        $this->addSql('ALTER TABLE prize_image DROP FOREIGN KEY FK_8D00263FBBE43214');
        $this->addSql('DROP TABLE contest');
        $this->addSql('DROP TABLE prize');
        $this->addSql('DROP TABLE prize_image');
        $this->addSql('DROP TABLE user');
    }
}
