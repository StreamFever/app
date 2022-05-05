<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505175335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logs (id INT AUTO_INCREMENT NOT NULL, logs_timestamp DATETIME NOT NULL, logs_level VARCHAR(255) NOT NULL, logs_text LONGTEXT NOT NULL, logs_overlay VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logs_user (logs_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_80A68842E340FC6D (logs_id), INDEX IDX_80A68842A76ED395 (user_id), PRIMARY KEY(logs_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE logs_user ADD CONSTRAINT FK_80A68842E340FC6D FOREIGN KEY (logs_id) REFERENCES logs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logs_user ADD CONSTRAINT FK_80A68842A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logs_user DROP FOREIGN KEY FK_80A68842E340FC6D');
        $this->addSql('DROP TABLE logs');
        $this->addSql('DROP TABLE logs_user');
    }
}
