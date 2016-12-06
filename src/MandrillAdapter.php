<?php
/**
 * @link      http://buildwithcraft.com/
 * @copyright Copyright (c) 2015 Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license
 */
namespace craftcms\mandrill;

use Craft;
use craft\mail\transportadapters\BaseTransportAdapter;

/**
 * MandrillAdapter implements a Mandrill transport adapter into Craft’s mailer.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class MandrillAdapter extends BaseTransportAdapter
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName()
    {
        return 'Mandrill';
    }

    // Properties
    // =========================================================================

    /**
     * @var string The API key that should be used
     */
    public $apiKey;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apiKey' => Craft::t('mandrill', 'API Key'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiKey'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('mandrill/settings', [
            'adapter' => $this
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getTransportConfig()
    {
        return [
            'class' => 'Accord\MandrillSwiftMailer\SwiftMailer\MandrillTransport',
            'constructArgs' => [
                [
                    'class' => 'Swift_Events_SimpleEventDispatcher'
                ]
            ],
            'apiKey' => $this->apiKey,
        ];
    }
}
