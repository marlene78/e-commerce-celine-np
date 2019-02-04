<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190204135856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE model_bas_finitions (model_bas_id INT NOT NULL, finitions_id INT NOT NULL, INDEX IDX_7F17848D93C166C0 (model_bas_id), INDEX IDX_7F17848DA1D355A9 (finitions_id), PRIMARY KEY(model_bas_id, finitions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finitions (id INT AUTO_INCREMENT NOT NULL, picture_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_C9232A0EEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_haut_finitions (model_haut_id INT NOT NULL, finitions_id INT NOT NULL, INDEX IDX_680F1ACFCA612CA4 (model_haut_id), INDEX IDX_680F1ACFA1D355A9 (finitions_id), PRIMARY KEY(model_haut_id, finitions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model_bas_finitions ADD CONSTRAINT FK_7F17848D93C166C0 FOREIGN KEY (model_bas_id) REFERENCES model_bas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_bas_finitions ADD CONSTRAINT FK_7F17848DA1D355A9 FOREIGN KEY (finitions_id) REFERENCES finitions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE finitions ADD CONSTRAINT FK_C9232A0EEE45BDBF FOREIGN KEY (picture_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE model_haut_finitions ADD CONSTRAINT FK_680F1ACFCA612CA4 FOREIGN KEY (model_haut_id) REFERENCES model_haut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_haut_finitions ADD CONSTRAINT FK_680F1ACFA1D355A9 FOREIGN KEY (finitions_id) REFERENCES finitions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_bas DROP FOREIGN KEY FK_543BD6C3CB56F5AF');
        $this->addSql('DROP INDEX IDX_543BD6C3CB56F5AF ON model_bas');
        $this->addSql('ALTER TABLE model_bas DROP finition_id');
        $this->addSql('ALTER TABLE model_haut DROP FOREIGN KEY FK_BEB4B596CB56F5AF');
        $this->addSql('DROP INDEX IDX_BEB4B596CB56F5AF ON model_haut');
        $this->addSql('ALTER TABLE model_haut DROP finition_id');
        $this->addSql('ALTER TABLE commande CHANGE accessoire accessoire VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE model_bas_finitions DROP FOREIGN KEY FK_7F17848DA1D355A9');
        $this->addSql('ALTER TABLE model_haut_finitions DROP FOREIGN KEY FK_680F1ACFA1D355A9');
        $this->addSql('DROP TABLE model_bas_finitions');
        $this->addSql('DROP TABLE finitions');
        $this->addSql('DROP TABLE model_haut_finitions');
        $this->addSql('ALTER TABLE commande CHANGE accessoire accessoire VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE model_bas ADD finition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model_bas ADD CONSTRAINT FK_543BD6C3CB56F5AF FOREIGN KEY (finition_id) REFERENCES finitions (id)');
        $this->addSql('CREATE INDEX IDX_543BD6C3CB56F5AF ON model_bas (finition_id)');
        $this->addSql('ALTER TABLE model_haut ADD finition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model_haut ADD CONSTRAINT FK_BEB4B596CB56F5AF FOREIGN KEY (finition_id) REFERENCES finitions (id)');
        $this->addSql('CREATE INDEX IDX_BEB4B596CB56F5AF ON model_haut (finition_id)');
    }
}
