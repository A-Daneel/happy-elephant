<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200503234350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, directory VARCHAR(255) DEFAULT NULL, uploader VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE taxonomy CHANGE parent parent CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE relationable relationable TINYINT(1) DEFAULT NULL, CHANGE subgroupable subgroupable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE relation CHANGE person_id person_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE parent_id parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE revision CHANGE accepted accepted DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE log CHANGE auth auth CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE object_id object_id VARCHAR(255) DEFAULT NULL, CHANGE object_type object_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mail CHANGE auth auth CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE recipient CHANGE person_id person_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE mail mail CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE person CHANGE scheme_id scheme_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE shortname_expr shortname_expr VARCHAR(255) DEFAULT NULL, CHANGE name_expr name_expr VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person_field CHANGE scheme_id scheme_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE user_edit_only user_edit_only TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE person_scheme CHANGE shortname_expr shortname_expr VARCHAR(255) DEFAULT NULL, CHANGE name_expr name_expr VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person_value CHANGE field_id field_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE builtin builtin VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE auth CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE password_request_token password_request_token VARCHAR(255) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, directory VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, uploader VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE photo');
        $this->addSql('ALTER TABLE auth CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE password_request_token password_request_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE log CHANGE auth auth CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE object_id object_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE object_type object_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mail CHANGE auth auth CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE person CHANGE scheme_id scheme_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE shortname_expr shortname_expr VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE name_expr name_expr VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE person_field CHANGE scheme_id scheme_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE user_edit_only user_edit_only TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE person_scheme CHANGE shortname_expr shortname_expr VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE name_expr name_expr VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE person_value CHANGE field_id field_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE builtin builtin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE recipient CHANGE person_id person_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE mail mail CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE relation CHANGE person_id person_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE parent_id parent_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE revision CHANGE accepted accepted DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE taxonomy CHANGE parent parent CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', CHANGE relationable relationable TINYINT(1) DEFAULT \'NULL\', CHANGE subgroupable subgroupable TINYINT(1) DEFAULT \'NULL\'');
    }
}
