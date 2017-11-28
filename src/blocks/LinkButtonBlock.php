<?php

namespace luya\bootstrap3\blocks;

use luya\bootstrap3\Module;
use luya\cms\injectors\LinkInjector;
use luya\bootstrap3\BaseBootstrap3Block;
use luya\bootstrap3\blockgroups\Bootstrap3Group;

/**
 * Simple button element with a link function
 *
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
final class LinkButtonBlock extends BaseBootstrap3Block
{
    /**
     * @inheritdoc
     */
    public $cacheEnabled = true;

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('block_link_button_name');
    }

    public function blockGroup()
    {
        return Bootstrap3Group::class;
    }
    
    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'link';
    }
    
    /**
     * @inheritdoc
     */
    public function injectors()
    {
        return [
            'linkData' => new LinkInjector([
                'varLabel' => Module::t('block_link_button_btnhref_label'),
            ]),
        ];
    }

    /**
     * @inheritdoc
     */
    public function config()
    {
        return [
            'vars' => [
                ['var' => 'label', 'label' => Module::t('block_link_button_btnlabel_label'), 'type' => 'zaa-text'],
            ],
            'cfgs' => [
                [
                    'var' => 'simpleLink',
                    'label' => Module::t('block_link_button_simpleLink_label'),
                    'type' => 'zaa-checkbox'
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraVars()
    {
        return [
            'cssClass' => $this->getCfgValue('simpleLink') ? null : 'btn btn-default',
        ];
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '<p>{% if vars.label is empty or vars.linkData is empty %}' . Module::t('block_link_button_name') . ': ' . Module::t('block_link_button_empty') . '{% else %}' .
        '{% if vars.label is not empty %}<a class="btn disabled">{{ vars.label }}</a>{% endif %}{% endif %}</p>';
    }
}
