<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701092411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d649d5e258c5');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d64963379586');
        $this->addSql('DROP INDEX idx_8d93d649d5e258c5');
        $this->addSql('DROP INDEX idx_8d93d64963379586');
        $this->addSql('ALTER TABLE "user" DROP posts_id');
        $this->addSql('ALTER TABLE "user" DROP comments_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ADD posts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD comments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d649d5e258c5 FOREIGN KEY (posts_id) REFERENCES blog_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d64963379586 FOREIGN KEY (comments_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8d93d649d5e258c5 ON "user" (posts_id)');
        $this->addSql('CREATE INDEX idx_8d93d64963379586 ON "user" (comments_id)');
    }
}
