<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304160136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_user_commande CHANGE commande_modele_haut commande_modele_haut LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE commande_modele_bas commande_modele_bas LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE commande_accessoires commande_accessoires LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_user_commande CHANGE commande_modele_haut commande_modele_haut VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE commande_modele_bas commande_modele_bas VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE commande_accessoires commande_accessoires VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
