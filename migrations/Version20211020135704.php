<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020135704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE mood_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE mood (id INT NOT NULL, user_id_id INT NOT NULL, feeling VARCHAR(255) NOT NULL, emoji VARCHAR(255) NOT NULL, description TEXT NOT NULL, likes_count INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_339AEF69D86650F ON mood (user_id_id)');
        $this->addSql('CREATE TABLE user_profile (id INT NOT NULL, username VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE friendship (sender_id INT NOT NULL, receiver_id INT NOT NULL, PRIMARY KEY(sender_id, receiver_id))');
        $this->addSql('CREATE INDEX IDX_7234A45FF624B39D ON friendship (sender_id)');
        $this->addSql('CREATE INDEX IDX_7234A45FCD53EDB6 ON friendship (receiver_id)');
        $this->addSql('ALTER TABLE mood ADD CONSTRAINT FK_339AEF69D86650F FOREIGN KEY (user_id_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FF624B39D FOREIGN KEY (sender_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mood DROP CONSTRAINT FK_339AEF69D86650F');
        $this->addSql('ALTER TABLE friendship DROP CONSTRAINT FK_7234A45FF624B39D');
        $this->addSql('ALTER TABLE friendship DROP CONSTRAINT FK_7234A45FCD53EDB6');
        $this->addSql('DROP SEQUENCE mood_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_profile_id_seq CASCADE');
        $this->addSql('DROP TABLE mood');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE friendship');
    }
}
