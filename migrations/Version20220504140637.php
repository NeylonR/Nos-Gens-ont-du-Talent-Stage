<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504140637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agency_talent (agency_id INT NOT NULL, talent_id INT NOT NULL, INDEX IDX_CA01C3B5CDEADB2A (agency_id), INDEX IDX_CA01C3B518777CEF (talent_id), PRIMARY KEY(agency_id, talent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_company (project_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_D9A1052A166D1F9C (project_id), INDEX IDX_D9A1052A979B1AD6 (company_id), PRIMARY KEY(project_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_talent (project_id INT NOT NULL, talent_id INT NOT NULL, INDEX IDX_17DE9BF166D1F9C (project_id), INDEX IDX_17DE9BF18777CEF (talent_id), PRIMARY KEY(project_id, talent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agency_talent ADD CONSTRAINT FK_CA01C3B5CDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agency_talent ADD CONSTRAINT FK_CA01C3B518777CEF FOREIGN KEY (talent_id) REFERENCES talent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_company ADD CONSTRAINT FK_D9A1052A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_company ADD CONSTRAINT FK_D9A1052A979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_talent ADD CONSTRAINT FK_17DE9BF166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_talent ADD CONSTRAINT FK_17DE9BF18777CEF FOREIGN KEY (talent_id) REFERENCES talent (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE agency_talent');
        $this->addSql('DROP TABLE project_company');
        $this->addSql('DROP TABLE project_talent');
    }
}
