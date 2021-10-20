<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006132927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mood (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, feeling VARCHAR(255) NOT NULL, emoji VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_339AEF69D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mood ADD CONSTRAINT FK_339AEF69D86650F FOREIGN KEY (user_id_id) REFERENCES user_profile (id)');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45F13933E7B');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45FB821E5F5');
        $this->addSql('DROP INDEX IDX_7234A45F13933E7B ON friendship');
        $this->addSql('DROP INDEX IDX_7234A45FB821E5F5 ON friendship');
        $this->addSql('ALTER TABLE friendship DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE friendship ADD sender_id INT NOT NULL, ADD receiver_id INT NOT NULL, DROP send_id, DROP received_id');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FF624B39D FOREIGN KEY (sender_id) REFERENCES user_profile (id)');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE INDEX IDX_7234A45FF624B39D ON friendship (sender_id)');
        $this->addSql('CREATE INDEX IDX_7234A45FCD53EDB6 ON friendship (receiver_id)');
        $this->addSql('ALTER TABLE friendship ADD PRIMARY KEY (sender_id, receiver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mood');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45FF624B39D');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45FCD53EDB6');
        $this->addSql('DROP INDEX IDX_7234A45FF624B39D ON friendship');
        $this->addSql('DROP INDEX IDX_7234A45FCD53EDB6 ON friendship');
        $this->addSql('ALTER TABLE friendship DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE friendship ADD send_id INT NOT NULL, ADD received_id INT NOT NULL, DROP sender_id, DROP receiver_id');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45F13933E7B FOREIGN KEY (send_id) REFERENCES user_profile (id)');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FB821E5F5 FOREIGN KEY (received_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE INDEX IDX_7234A45F13933E7B ON friendship (send_id)');
        $this->addSql('CREATE INDEX IDX_7234A45FB821E5F5 ON friendship (received_id)');
        $this->addSql('ALTER TABLE friendship ADD PRIMARY KEY (send_id, received_id)');
    }
}
