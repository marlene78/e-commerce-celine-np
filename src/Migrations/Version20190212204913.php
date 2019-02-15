<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212204913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, modele_haut VARCHAR(255) NOT NULL, modele_bas VARCHAR(255) NOT NULL, finition_haut VARCHAR(255) DEFAULT NULL, finition_bas VARCHAR(255) DEFAULT NULL, accessoire VARCHAR(255) DEFAULT NULL, tissu_haut VARCHAR(255) NOT NULL, tissu_bas VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE panier');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, modele_haut VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, modele_bas VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, finition_haut VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, finition_bas VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, accessoire VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, tissu_haut VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, tissu_bas VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE commande');
    }
}
