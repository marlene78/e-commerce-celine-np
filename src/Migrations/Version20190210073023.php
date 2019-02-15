<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190210073023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensurations ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mensurations ADD CONSTRAINT FK_8DC1CC1DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8DC1CC1DA76ED395 ON mensurations (user_id)');
        $this->addSql('ALTER TABLE user_identity ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_identity ADD CONSTRAINT FK_8A180DC4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A180DC4A76ED395 ON user_identity (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mensurations DROP FOREIGN KEY FK_8DC1CC1DA76ED395');
        $this->addSql('ALTER TABLE user_identity DROP FOREIGN KEY FK_8A180DC4A76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_8DC1CC1DA76ED395 ON mensurations');
        $this->addSql('ALTER TABLE mensurations DROP user_id');
        $this->addSql('DROP INDEX UNIQ_8A180DC4A76ED395 ON user_identity');
        $this->addSql('ALTER TABLE user_identity DROP user_id');
    }
}
