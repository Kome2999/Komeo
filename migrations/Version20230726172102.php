<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230726172102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allocation (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, keeper_id INT NOT NULL, allocation_date DATE NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_5C44232A634DFEB (dog_id), INDEX IDX_5C44232A7B7C4783 (keeper_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, INDEX IDX_E00CEDDE634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_request (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, approved TINYINT(1) NOT NULL, isolation_kennel_available TINYINT(1) NOT NULL, shared_social_kennel_available TINYINT(1) NOT NULL, vaccination_status VARCHAR(255) NOT NULL, INDEX IDX_6129CABF634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, age INT NOT NULL, breed VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, dietary_requirements LONGTEXT DEFAULT NULL, medicine_requirements LONGTEXT DEFAULT NULL, special_notes LONGTEXT DEFAULT NULL, vaccination_status VARCHAR(255) NOT NULL, INDEX IDX_812C397D7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keeper (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manager (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manager_dog (manager_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_3E3B5F38783E3463 (manager_id), INDEX IDX_3E3B5F38634DFEB (dog_id), PRIMARY KEY(manager_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_record (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, vet_id INT NOT NULL, examination_date DATE DEFAULT NULL, examination_notes VARCHAR(255) DEFAULT NULL, INDEX IDX_F06A283E634DFEB (dog_id), INDEX IDX_F06A283E40369CAB (vet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allocation ADD CONSTRAINT FK_5C44232A634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE allocation ADD CONSTRAINT FK_5C44232A7B7C4783 FOREIGN KEY (keeper_id) REFERENCES keeper (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE booking_request ADD CONSTRAINT FK_6129CABF634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE manager_dog ADD CONSTRAINT FK_3E3B5F38783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id)');
        $this->addSql('ALTER TABLE manager_dog ADD CONSTRAINT FK_3E3B5F38634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE medical_record ADD CONSTRAINT FK_F06A283E634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE medical_record ADD CONSTRAINT FK_F06A283E40369CAB FOREIGN KEY (vet_id) REFERENCES vet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allocation DROP FOREIGN KEY FK_5C44232A634DFEB');
        $this->addSql('ALTER TABLE allocation DROP FOREIGN KEY FK_5C44232A7B7C4783');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE634DFEB');
        $this->addSql('ALTER TABLE booking_request DROP FOREIGN KEY FK_6129CABF634DFEB');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397D7E3C61F9');
        $this->addSql('ALTER TABLE manager_dog DROP FOREIGN KEY FK_3E3B5F38783E3463');
        $this->addSql('ALTER TABLE manager_dog DROP FOREIGN KEY FK_3E3B5F38634DFEB');
        $this->addSql('ALTER TABLE medical_record DROP FOREIGN KEY FK_F06A283E634DFEB');
        $this->addSql('ALTER TABLE medical_record DROP FOREIGN KEY FK_F06A283E40369CAB');
        $this->addSql('DROP TABLE allocation');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_request');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE keeper');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE manager_dog');
        $this->addSql('DROP TABLE medical_record');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vet');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
