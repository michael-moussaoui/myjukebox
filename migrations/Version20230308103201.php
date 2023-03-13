<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308103201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, genre VARCHAR(255) NOT NULL, artist VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, song VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, song_name VARCHAR(255) DEFAULT NULL, song_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', test VARCHAR(255) DEFAULT NULL, INDEX IDX_CD52224A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        // $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224A12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE music');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
