<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200517205618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE list_of_product');
        $this->addSql('DROP TABLE photo');
        $this->addSql('ALTER TABLE `order` ADD city VARCHAR(255) NOT NULL, ADD zip INT NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD price INT NOT NULL, ADD subtotal INT NOT NULL');
        $this->addSql('ALTER TABLE shop_list ADD product_id INT NOT NULL, ADD order_id_id INT NOT NULL, ADD count INT NOT NULL');
        $this->addSql('ALTER TABLE shop_list ADD CONSTRAINT FK_853A1E634584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE shop_list ADD CONSTRAINT FK_853A1E63FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_853A1E634584665A ON shop_list (product_id)');
        $this->addSql('CREATE INDEX IDX_853A1E63FCDAEAAA ON shop_list (order_id_id)');
        $this->addSql('ALTER TABLE user CHANGE about about TINYTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE list_of_product (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `order` DROP city, DROP zip, DROP phone, DROP price, DROP subtotal');
        $this->addSql('ALTER TABLE shop_list DROP FOREIGN KEY FK_853A1E634584665A');
        $this->addSql('ALTER TABLE shop_list DROP FOREIGN KEY FK_853A1E63FCDAEAAA');
        $this->addSql('DROP INDEX IDX_853A1E634584665A ON shop_list');
        $this->addSql('DROP INDEX IDX_853A1E63FCDAEAAA ON shop_list');
        $this->addSql('ALTER TABLE shop_list DROP product_id, DROP order_id_id, DROP count');
        $this->addSql('ALTER TABLE user CHANGE about about VARCHAR(180) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`');
    }
}
