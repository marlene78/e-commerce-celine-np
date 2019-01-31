<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131000600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE model_bas DROP FOREIGN KEY FK_543BD6C382EA2E54');
        $this->addSql('DROP INDEX IDX_543BD6C382EA2E54 ON model_bas');
        $this->addSql('ALTER TABLE model_bas DROP commande_id');
        $this->addSql('ALTER TABLE model_haut DROP FOREIGN KEY FK_BEB4B59682EA2E54');
        $this->addSql('DROP INDEX IDX_BEB4B59682EA2E54 ON model_haut');
        $this->addSql('ALTER TABLE model_haut DROP commande_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE model_bas ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model_bas ADD CONSTRAINT FK_543BD6C382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_543BD6C382EA2E54 ON model_bas (commande_id)');
        $this->addSql('ALTER TABLE model_haut ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model_haut ADD CONSTRAINT FK_BEB4B59682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_BEB4B59682EA2E54 ON model_haut (commande_id)');
    }
}
