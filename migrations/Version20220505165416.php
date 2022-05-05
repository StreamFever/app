<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505165416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE overlay (id INT AUTO_INCREMENT NOT NULL, widget_owner_id INT DEFAULT NULL, widget_name VARCHAR(255) NOT NULL, widget_visible TINYINT(1) NOT NULL, INDEX IDX_B9FF3CBE9251BCD8 (widget_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE overlay_user (overlay_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4E237622F77080E1 (overlay_id), INDEX IDX_4E237622A76ED395 (user_id), PRIMARY KEY(overlay_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE overlay ADD CONSTRAINT FK_B9FF3CBE9251BCD8 FOREIGN KEY (widget_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE overlay_user ADD CONSTRAINT FK_4E237622F77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE overlay_user ADD CONSTRAINT FK_4E237622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD user_first_name VARCHAR(255) DEFAULT NULL, ADD user_last_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE overlay_user DROP FOREIGN KEY FK_4E237622F77080E1');
        $this->addSql('DROP TABLE overlay');
        $this->addSql('DROP TABLE overlay_user');
        $this->addSql('ALTER TABLE user DROP user_first_name, DROP user_last_name');
    }
}
