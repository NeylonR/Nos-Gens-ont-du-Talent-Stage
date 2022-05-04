<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504134839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, phone_number INT NOT NULL, description LONGTEXT NOT NULL, web_link VARCHAR(255) NOT NULL, facebook_link VARCHAR(255) DEFAULT NULL, twitter_link VARCHAR(255) DEFAULT NULL, youtube_link VARCHAR(255) DEFAULT NULL, linkedin_link VARCHAR(255) DEFAULT NULL, instagram_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agency_category (agency_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_1A56783ACDEADB2A (agency_id), INDEX IDX_1A56783A12469DE2 (category_id), PRIMARY KEY(agency_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, phone_number INT NOT NULL, description LONGTEXT NOT NULL, web_link VARCHAR(255) NOT NULL, facebook_link VARCHAR(255) DEFAULT NULL, twitter_link VARCHAR(255) DEFAULT NULL, youtube_link VARCHAR(255) DEFAULT NULL, linkedin_link VARCHAR(255) DEFAULT NULL, instagram_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talent (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number INT NOT NULL, description LONGTEXT NOT NULL, web_link VARCHAR(255) NOT NULL, facebook_link VARCHAR(255) DEFAULT NULL, twitter_link VARCHAR(255) DEFAULT NULL, youtube_link VARCHAR(255) DEFAULT NULL, linkedin_link VARCHAR(255) DEFAULT NULL, instagram_link VARCHAR(255) DEFAULT NULL, our_talent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agency_category ADD CONSTRAINT FK_1A56783ACDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agency_category ADD CONSTRAINT FK_1A56783A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agency_category DROP FOREIGN KEY FK_1A56783ACDEADB2A');
        $this->addSql('ALTER TABLE agency_category DROP FOREIGN KEY FK_1A56783A12469DE2');
        $this->addSql('DROP TABLE agency');
        $this->addSql('DROP TABLE agency_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE talent');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
