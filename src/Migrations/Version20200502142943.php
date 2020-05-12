<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502142943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE taxonomy (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', parent CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, readonly TINYINT(1) NOT NULL, relationable TINYINT(1) DEFAULT NULL, subgroupable TINYINT(1) DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_FD12B83D3D8E604F (parent), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', group_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', person_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', description VARCHAR(255) DEFAULT NULL, INDEX IDX_62894749FE54D947 (group_id), INDEX IDX_62894749217BBB47 (person_id), INDEX IDX_62894749727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, latest_revision DATE NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revision (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, accepted DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', auth CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', discr VARCHAR(100) NOT NULL, time DATETIME NOT NULL, object_id VARCHAR(255) DEFAULT NULL, object_type VARCHAR(255) DEFAULT NULL, meta LONGTEXT NOT NULL, INDEX IDX_8F3F68C5F8DEB059 (auth), INDEX search_idx (object_id, object_type), INDEX order_idx (time), INDEX discr_idx (discr), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', auth CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, sender VARCHAR(255) NOT NULL, sent_at DATETIME NOT NULL, INDEX IDX_5126AC48F8DEB059 (auth), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipient (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', person_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', mail CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_6804FB49217BBB47 (person_id), INDEX IDX_6804FB495126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', scheme_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(255) NOT NULL, shortname_expr VARCHAR(255) DEFAULT NULL, name_expr VARCHAR(255) DEFAULT NULL, INDEX IDX_34DCD17665797862 (scheme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_field (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', scheme_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, value_type VARCHAR(255) NOT NULL, user_edit_only TINYINT(1) DEFAULT NULL, INDEX IDX_F7C35A9C65797862 (scheme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_scheme (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, shortname_expr VARCHAR(255) DEFAULT NULL, name_expr VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_value (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', field_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', person_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', value LONGTEXT NOT NULL, builtin VARCHAR(255) DEFAULT NULL, INDEX IDX_B14147F0443707B0 (field_id), INDEX IDX_B14147F0217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auth (person CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', auth_id VARCHAR(180) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, last_login DATETIME DEFAULT NULL, password_request_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F8DEB0598082819C (auth_id), PRIMARY KEY(person)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE taxonomy ADD CONSTRAINT FK_FD12B83D3D8E604F FOREIGN KEY (parent) REFERENCES taxonomy (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749FE54D947 FOREIGN KEY (group_id) REFERENCES taxonomy (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749727ACA70 FOREIGN KEY (parent_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C5F8DEB059 FOREIGN KEY (auth) REFERENCES auth (person)');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48F8DEB059 FOREIGN KEY (auth) REFERENCES auth (person)');
        $this->addSql('ALTER TABLE recipient ADD CONSTRAINT FK_6804FB49217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE recipient ADD CONSTRAINT FK_6804FB495126AC48 FOREIGN KEY (mail) REFERENCES mail (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17665797862 FOREIGN KEY (scheme_id) REFERENCES person_scheme (id)');
        $this->addSql('ALTER TABLE person_field ADD CONSTRAINT FK_F7C35A9C65797862 FOREIGN KEY (scheme_id) REFERENCES person_scheme (id)');
        $this->addSql('ALTER TABLE person_value ADD CONSTRAINT FK_B14147F0443707B0 FOREIGN KEY (field_id) REFERENCES person_field (id)');
        $this->addSql('ALTER TABLE person_value ADD CONSTRAINT FK_B14147F0217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE auth ADD CONSTRAINT FK_F8DEB05934DCD176 FOREIGN KEY (person) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE taxonomy DROP FOREIGN KEY FK_FD12B83D3D8E604F');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749FE54D947');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749727ACA70');
        $this->addSql('ALTER TABLE recipient DROP FOREIGN KEY FK_6804FB495126AC48');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749217BBB47');
        $this->addSql('ALTER TABLE recipient DROP FOREIGN KEY FK_6804FB49217BBB47');
        $this->addSql('ALTER TABLE person_value DROP FOREIGN KEY FK_B14147F0217BBB47');
        $this->addSql('ALTER TABLE auth DROP FOREIGN KEY FK_F8DEB05934DCD176');
        $this->addSql('ALTER TABLE person_value DROP FOREIGN KEY FK_B14147F0443707B0');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17665797862');
        $this->addSql('ALTER TABLE person_field DROP FOREIGN KEY FK_F7C35A9C65797862');
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C5F8DEB059');
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC48F8DEB059');
        $this->addSql('DROP TABLE taxonomy');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE revision');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE recipient');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_field');
        $this->addSql('DROP TABLE person_scheme');
        $this->addSql('DROP TABLE person_value');
        $this->addSql('DROP TABLE auth');
    }
}
