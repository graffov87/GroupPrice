<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /**
         * Create table 'import_jobs'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('chervit_profiles')
        )->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Entity Id'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Title'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Is Profile Active'
        )->addColumn(
                'cron',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => true],
                'Cron schedule'
        )->addColumn(
                'source_data',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Source Data (json)'
        )->setComment(
                'Profile'
        )->addIndex(
                $setup->getIdxName('chervit_profiles', ['entity_id']),
                ['entity_id']
        );
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
