<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130181212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE finitions (id INT AUTO_INCREMENT NOT NULL, picture_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_C9232A0EEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_bas_tissu (model_bas_id INT NOT NULL, tissu_id INT NOT NULL, INDEX IDX_A9FA83A793C166C0 (model_bas_id), INDEX IDX_A9FA83A7A533E0C9 (tissu_id), PRIMARY KEY(model_bas_id, tissu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_haut_tissu (model_haut_id INT NOT NULL, tissu_id INT NOT NULL, INDEX IDX_3A64E465CA612CA4 (model_haut_id), INDEX IDX_3A64E465A533E0C9 (tissu_id), PRIMARY KEY(model_haut_id, tissu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tissu (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, UNIQUE INDEX UNIQ_FE947014EE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE finitions ADD CONSTRAINT FK_C9232A0EEE45BDBF FOREIGN KEY (picture_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE model_bas_tissu ADD CONSTRAINT FK_A9FA83A793C166C0 FOREIGN KEY (model_bas_id) REFERENCES model_bas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_bas_tissu ADD CONSTRAINT FK_A9FA83A7A533E0C9 FOREIGN KEY (tissu_id) REFERENCES tissu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_haut_tissu ADD CONSTRAINT FK_3A64E465CA612CA4 FOREIGN KEY (model_haut_id) REFERENCES model_haut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_haut_tissu ADD CONSTRAINT FK_3A64E465A533E0C9 FOREIGN KEY (tissu_id) REFERENCES tissu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tissu ADD CONSTRAINT FK_FE947014EE45BDBF FOREIGN KEY (picture_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE model_bas ADD finition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model_bas ADD CONSTRAINT FK_543BD6C3CB56F5AF FOREIGN KEY (finition_id) REFERENCES finitions (id)');
        $this->addSql('CREATE INDEX IDX_543BD6C3CB56F5AF ON model_bas (finition_id)');
        $this->addSql('ALTER TABLE model_haut ADD finition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model_haut ADD CONSTRAINT FK_BEB4B596CB56F5AF FOREIGN KEY (finition_id) REFERENCES finitions (id)');
        $this->addSql('CREATE INDEX IDX_BEB4B596CB56F5AF ON model_haut (finition_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE model_bas DROP FOREIGN KEY FK_543BD6C3CB56F5AF');
        $this->addSql('ALTER TABLE model_haut DROP FOREIGN KEY FK_BEB4B596CB56F5AF');
        $this->addSql('ALTER TABLE model_bas_tissu DROP FOREIGN KEY FK_A9FA83A7A533E0C9');
        $this->addSql('ALTER TABLE model_haut_tissu DROP FOREIGN KEY FK_3A64E465A533E0C9');
        $this->addSql('DROP TABLE finitions');
        $this->addSql('DROP TABLE model_bas_tissu');
        $this->addSql('DROP TABLE model_haut_tissu');
        $this->addSql('DROP TABLE tissu');
        $this->addSql('DROP INDEX IDX_543BD6C3CB56F5AF ON model_bas');
        $this->addSql('ALTER TABLE model_bas DROP finition_id');
        $this->addSql('DROP INDEX IDX_BEB4B596CB56F5AF ON model_haut');
        $this->addSql('ALTER TABLE model_haut DROP finition_id');
    }
}
