<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613190502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meta_overlays (id INT AUTO_INCREMENT NOT NULL, meta_key VARCHAR(255) NOT NULL, meta_value LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meta_overlays_overlay (meta_overlays_id INT NOT NULL, overlay_id INT NOT NULL, INDEX IDX_DE6E93B984C2BBC (meta_overlays_id), INDEX IDX_DE6E93BF77080E1 (overlay_id), PRIMARY KEY(meta_overlays_id, overlay_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meta_overlays_overlay ADD CONSTRAINT FK_DE6E93B984C2BBC FOREIGN KEY (meta_overlays_id) REFERENCES meta_overlays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meta_overlays_overlay ADD CONSTRAINT FK_DE6E93BF77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meta_overlays_overlay DROP FOREIGN KEY FK_DE6E93B984C2BBC');
        $this->addSql('DROP TABLE meta_overlays');
        $this->addSql('DROP TABLE meta_overlays_overlay');
    }
}
