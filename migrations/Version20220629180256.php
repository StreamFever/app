<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629180256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logs (id INT AUTO_INCREMENT NOT NULL, logs_timestamp DATETIME NOT NULL, logs_level VARCHAR(255) NOT NULL, logs_text LONGTEXT NOT NULL, logs_overlay VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meta (id INT AUTO_INCREMENT NOT NULL, widgets_id INT DEFAULT NULL, meta_key VARCHAR(255) NOT NULL, meta_value LONGTEXT DEFAULT NULL, INDEX IDX_D7F21435A98ED6F4 (widgets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE overlay (id INT AUTO_INCREMENT NOT NULL, overlay_owner_id INT NOT NULL, INDEX IDX_B9FF3CBEADCB7129 (overlay_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE overlay_user (overlay_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4E237622F77080E1 (overlay_id), INDEX IDX_4E237622A76ED395 (user_id), PRIMARY KEY(overlay_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE websocket (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, websocket_id VARCHAR(255) NOT NULL, overl_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widgets (id INT AUTO_INCREMENT NOT NULL, widget_name VARCHAR(255) NOT NULL, widget_visible TINYINT(1) NOT NULL, widget_id_alpha VARCHAR(255) NOT NULL, widget_id_beta VARCHAR(255) DEFAULT NULL, widget_version_alpha VARCHAR(255) NOT NULL, widget_version_beta VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meta ADD CONSTRAINT FK_D7F21435A98ED6F4 FOREIGN KEY (widgets_id) REFERENCES widgets (id)');
        $this->addSql('ALTER TABLE overlay ADD CONSTRAINT FK_B9FF3CBEADCB7129 FOREIGN KEY (overlay_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE overlay_user ADD CONSTRAINT FK_4E237622F77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE overlay_user ADD CONSTRAINT FK_4E237622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE overlay_user DROP FOREIGN KEY FK_4E237622F77080E1');
        $this->addSql('ALTER TABLE overlay DROP FOREIGN KEY FK_B9FF3CBEADCB7129');
        $this->addSql('ALTER TABLE overlay_user DROP FOREIGN KEY FK_4E237622A76ED395');
        $this->addSql('ALTER TABLE meta DROP FOREIGN KEY FK_D7F21435A98ED6F4');
        $this->addSql('DROP TABLE logs');
        $this->addSql('DROP TABLE meta');
        $this->addSql('DROP TABLE overlay');
        $this->addSql('DROP TABLE overlay_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE websocket');
        $this->addSql('DROP TABLE widgets');
    }
}
