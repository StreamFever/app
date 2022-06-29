<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616211120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE overlay_websocket (overlay_id INT NOT NULL, websocket_id INT NOT NULL, INDEX IDX_C4CEA57DF77080E1 (overlay_id), INDEX IDX_C4CEA57DEB917711 (websocket_id), PRIMARY KEY(overlay_id, websocket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE overlay_websocket ADD CONSTRAINT FK_C4CEA57DF77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE overlay_websocket ADD CONSTRAINT FK_C4CEA57DEB917711 FOREIGN KEY (websocket_id) REFERENCES websocket (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE overlay_websocket');
    }
}
