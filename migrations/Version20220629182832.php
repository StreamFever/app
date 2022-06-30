<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629182832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logs_user (logs_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_80A68842E340FC6D (logs_id), INDEX IDX_80A68842A76ED395 (user_id), PRIMARY KEY(logs_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE logs_user ADD CONSTRAINT FK_80A68842E340FC6D FOREIGN KEY (logs_id) REFERENCES logs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logs_user ADD CONSTRAINT FK_80A68842A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE logs_user');
    }
}
