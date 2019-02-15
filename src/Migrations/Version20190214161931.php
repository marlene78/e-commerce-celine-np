<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214161931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tissu ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE finitions ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE model_haut ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE model_bas ADD slugslug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE finitions DROP slug');
        $this->addSql('ALTER TABLE model_bas DROP slugslug');
        $this->addSql('ALTER TABLE model_haut DROP slug');
        $this->addSql('ALTER TABLE tissu DROP slug');
    }
}
