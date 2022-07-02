<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702155102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meta ADD widgets_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meta ADD CONSTRAINT FK_D7F21435A98ED6F4 FOREIGN KEY (widgets_id) REFERENCES widgets (id)');
        $this->addSql('CREATE INDEX IDX_D7F21435A98ED6F4 ON meta (widgets_id)');
        $this->addSql('ALTER TABLE widgets ADD overlay_id INT NOT NULL');
        $this->addSql('ALTER TABLE widgets ADD CONSTRAINT FK_9D58E4C1F77080E1 FOREIGN KEY (overlay_id) REFERENCES overlay (id)');
        $this->addSql('CREATE INDEX IDX_9D58E4C1F77080E1 ON widgets (overlay_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meta DROP FOREIGN KEY FK_D7F21435A98ED6F4');
        $this->addSql('DROP INDEX IDX_D7F21435A98ED6F4 ON meta');
        $this->addSql('ALTER TABLE meta DROP widgets_id');
        $this->addSql('ALTER TABLE widgets DROP FOREIGN KEY FK_9D58E4C1F77080E1');
        $this->addSql('DROP INDEX IDX_9D58E4C1F77080E1 ON widgets');
        $this->addSql('ALTER TABLE widgets DROP overlay_id');
    }
}
