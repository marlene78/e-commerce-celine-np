<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303162647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_commande_model_haut (user_commande_id INT NOT NULL, model_haut_id INT NOT NULL, INDEX IDX_CB5F6022BF1E7C1 (user_commande_id), INDEX IDX_CB5F602CA612CA4 (model_haut_id), PRIMARY KEY(user_commande_id, model_haut_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_commande_model_bas (user_commande_id INT NOT NULL, model_bas_id INT NOT NULL, INDEX IDX_E8736A7A2BF1E7C1 (user_commande_id), INDEX IDX_E8736A7A93C166C0 (model_bas_id), PRIMARY KEY(user_commande_id, model_bas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_commande_accessoires (user_commande_id INT NOT NULL, accessoires_id INT NOT NULL, INDEX IDX_41B1EC512BF1E7C1 (user_commande_id), INDEX IDX_41B1EC5139181887 (accessoires_id), PRIMARY KEY(user_commande_id, accessoires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_commande_model_haut ADD CONSTRAINT FK_CB5F6022BF1E7C1 FOREIGN KEY (user_commande_id) REFERENCES admin_user_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_commande_model_haut ADD CONSTRAINT FK_CB5F602CA612CA4 FOREIGN KEY (model_haut_id) REFERENCES model_haut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_commande_model_bas ADD CONSTRAINT FK_E8736A7A2BF1E7C1 FOREIGN KEY (user_commande_id) REFERENCES admin_user_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_commande_model_bas ADD CONSTRAINT FK_E8736A7A93C166C0 FOREIGN KEY (model_bas_id) REFERENCES model_bas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_commande_accessoires ADD CONSTRAINT FK_41B1EC512BF1E7C1 FOREIGN KEY (user_commande_id) REFERENCES admin_user_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_commande_accessoires ADD CONSTRAINT FK_41B1EC5139181887 FOREIGN KEY (accessoires_id) REFERENCES accessoires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_user_commande ADD prix INT NOT NULL, DROP commande');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_commande_model_haut');
        $this->addSql('DROP TABLE user_commande_model_bas');
        $this->addSql('DROP TABLE user_commande_accessoires');
        $this->addSql('ALTER TABLE admin_user_commande ADD commande VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP prix');
    }
}
