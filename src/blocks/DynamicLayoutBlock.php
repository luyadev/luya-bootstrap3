<?php

namespace luya\bootstrap3\blocks;

use luya\bootstrap3\Module;
use luya\bootstrap3\BaseBootstrap3Block;
use luya\cms\frontend\blockgroups\LayoutGroup;

/**
 * Dynamic Layout/Grid Block.
 *
 * @author Bennet Klarhölter <boehsermoe@me.com>
 * @since 1.0.5
 */
final class DynamicLayoutBlock extends BaseBootstrap3Block
{
    /**
     * @inheritdoc
     */
    public $isContainer = true;

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('block_dynamic_layout_name');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'view_compact';
    }

    /**
     * @inheritdoc
     */
    public function config()
    {
        $this->buildConfig();
    
        return [
            'vars' => [],
            'cfgs' => [],
            'placeholders' => $this->buildPlaceholders(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraVars()
    {
        return [
            'columnCount' => $this->getCfgValue('columnCount', 3),
        ];
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '';
    }
    
    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return LayoutGroup::class;
    }
    
    private $configIsInit = false;
    
    private function buildConfig()
    {
        if ($this->configIsInit) {
            return;
        }
        
        $this->addCfg([
            'var' => 'columnCount',
            'label' => Module::t('block_dynamic_layout_left_column_count'),
            'initvalue' => 3,
            'type' => 'zaa-select',
            'options' => [
                ['value' => 1, 'label' => '1'],
                ['value' => 2, 'label' => '2'],
                ['value' => 3, 'label' => '3'],
                ['value' => 4, 'label' => '4'],
                ['value' => 5, 'label' => '5'],
                ['value' => 6, 'label' => '6'],
                ['value' => 7, 'label' => '7'],
                ['value' => 8, 'label' => '8'],
                ['value' => 9, 'label' => '9'],
                ['value' => 10, 'label' => '10'],
                ['value' => 11, 'label' => '11'],
                ['value' => 12, 'label' => '12'],
            ],
        ]);
        $this->addCfg(['var' => 'rowDivClass', 'label' => Module::t('block_layout_row_column_css_class'), 'type' => 'zaa-text']);
        
        $columnCount = $this->getExtraValue('columnCount');
        for ($i = 0; $i < $columnCount; $i++) {
            $this->addCfg(['var' => $i . 'ColumnClasses', 'label' => Module::t('block_dynamic_layout_column_css_class', ['number' => ($i + 1)]), 'type' => 'zaa-text']);
            $this->addVar([
                'var' => 'columnWidth' . $i,
                'label' => Module::t('block_dynamic_layout_width_label', ['number' => ($i + 1), 'max' => 12]),
                'initvalue' => 4,
                'type' => 'zaa-select',
                'options' => [
                    ['value' => 1, 'label' => '1'],
                    ['value' => 2, 'label' => '2'],
                    ['value' => 3, 'label' => '3'],
                    ['value' => 4, 'label' => '4'],
                    ['value' => 5, 'label' => '5'],
                    ['value' => 6, 'label' => '6'],
                    ['value' => 7, 'label' => '7'],
                    ['value' => 8, 'label' => '8'],
                    ['value' => 9, 'label' => '9'],
                    ['value' => 10, 'label' => '10'],
                    ['value' => 11, 'label' => '11'],
                    ['value' => 12, 'label' => '12'],
                ],
            ]);
        }
        
        $this->configIsInit = true;
    }
    
    /**
     * @return array
     */
    private function buildPlaceholders() : array
    {
        $placeholders = [];
        
        $columnCount = $this->getExtraValue('columnCount');
        for ($i = 0; $i < $columnCount; $i++) {
            $placeholders[] = [
                'var' => 'column' . $i,
                'cols' => max(1, $this->getVarValue('columnWidth' . $i, 6)),
                'label' => Module::t('block_dynamic_layout_placeholders_column', ['number' => ($i + 1)])
            ];
        }
        
        return [$placeholders];
    }
}
