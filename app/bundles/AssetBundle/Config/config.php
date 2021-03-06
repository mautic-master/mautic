<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'routes' => [
        'main' => [
            'mautic_asset_buildertoken_index' => [
                'path' => '/asset/buildertokens/{page}',
                'controller' => 'MauticAssetBundle:SubscribedEvents\BuilderToken:index'
            ],
            'mautic_asset_index' => [
                'path' => '/assets/{page}',
                'controller' => 'MauticAssetBundle:Asset:index'
            ],
            'mautic_asset_remote' => [
                'path' => '/assets/remote',
                'controller' => 'MauticAssetBundle:Asset:remote',
            ],
            'mautic_asset_action' => [
                'path' => '/assets/{objectAction}/{objectId}',
                'controller' => 'MauticAssetBundle:Asset:execute',
            ]
        ],
        'api' => [
            'mautic_api_getassets' => [
                'path' => '/assets',
                'controller' => 'MauticAssetBundle:Api\AssetApi:getEntities'
            ],
            'mautic_api_getasset' => [
                'path' => '/assets/{id}',
                'controller' => 'MauticAssetBundle:Api\AssetApi:getEntity'
            ]
        ],
        'public' => [
            'mautic_asset_download' => [
                'path' => '/asset/{slug}',
                'controller' => 'MauticAssetBundle:Public:download',
                'defaults' => [
                    "slug"    => ''
                ]
            ]
        ]
    ],

    'menu' => [
        'main' => [
            'items'    => [
                'mautic.asset.assets' => [
                    'route'     => 'mautic_asset_index',
                    'access'    => ['asset:assets:viewown', 'asset:assets:viewother'],
                    'parent'    => 'mautic.core.components',
                    'priority'  => 300,
                ]
            ]
        ]
    ],

    'categories' => [
        'asset' => null
    ],

    'services' => [
        'events' => [
            'mautic.asset.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\AssetSubscriber'
            ],
            'mautic.asset.pointbundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\PointSubscriber'
            ],
            'mautic.asset.formbundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\FormSubscriber'
            ],
            'mautic.asset.campaignbundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\CampaignSubscriber'
            ],
            'mautic.asset.reportbundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\ReportSubscriber'
            ],
            'mautic.asset.builder.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\BuilderSubscriber',
                'arguments' => [
                    'mautic.factory',
                    'mautic.asset.helper.token'
                ]
            ],
            'mautic.asset.leadbundle.subscriber' => [
                'class'     => 'Mautic\AssetBundle\EventListener\LeadSubscriber',
                'arguments' => [
                    'mautic.factory',
                    'mautic.asset.model.asset'
                ]
            ],
            'mautic.asset.pagebundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\PageSubscriber'
            ],
            'mautic.asset.emailbundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\EmailSubscriber'
            ],
            'mautic.asset.configbundle.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\ConfigSubscriber'
            ],
            'mautic.asset.search.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\SearchSubscriber'
            ],
            'oneup_uploader.pre_upload' => [
                'class' => 'Mautic\AssetBundle\EventListener\UploadSubscriber',
                'arguments' => [
                    'translator',
                    'mautic.helper.core_parameters',
                    'mautic.asset.model.asset'
                ]
            ],
            'mautic.asset.dashboard.subscriber' => [
                'class' => 'Mautic\AssetBundle\EventListener\DashboardSubscriber'
            ]
        ],
        'forms' => [
            'mautic.form.type.asset' => [
                'class' => 'Mautic\AssetBundle\Form\Type\AssetType',
                'arguments' => [
                    'translator',
                    'mautic.helper.theme',
                    'mautic.asset.model.asset'
                ],
                'alias' => 'asset'
            ],
            'mautic.form.type.pointaction_assetdownload' => [
                'class' => 'Mautic\AssetBundle\Form\Type\PointActionAssetDownloadType',
                'alias' => 'pointaction_assetdownload'
            ],
            'mautic.form.type.campaignevent_assetdownload' => [
                'class' => 'Mautic\AssetBundle\Form\Type\CampaignEventAssetDownloadType',
                'alias' => 'campaignevent_assetdownload'
            ],
            'mautic.form.type.formsubmit_assetdownload' => [
                'class' => 'Mautic\AssetBundle\Form\Type\FormSubmitActionDownloadFileType',
                'alias' => 'asset_submitaction_downloadfile'
            ],
            'mautic.form.type.assetlist' => [
                'class' => 'Mautic\AssetBundle\Form\Type\AssetListType',
                'arguments' => 'mautic.factory',
                'alias' => 'asset_list'
            ],
            'mautic.form.type.assetconfig' => [
                'class' => 'Mautic\AssetBundle\Form\Type\ConfigType',
                'arguments' => 'mautic.factory',
                'alias' => 'assetconfig'
            ],
            'mautic.form.type.asset_dashboard_downloads_in_time_widget' => [
                'class'     => 'Mautic\AssetBundle\Form\Type\DashboardDownloadsInTimeWidgetType',
                'alias'     => 'asset_dashboard_downloads_in_time_widget'
            ]
        ],
        'others' => [
            'mautic.asset.upload.error.handler' => [
                'class' => 'Mautic\AssetBundle\ErrorHandler\DropzoneErrorHandler',
                'arguments' => 'mautic.factory'
            ],
            // Override the DropzoneController
            'oneup_uploader.controller.dropzone.class' => 'Mautic\AssetBundle\Controller\UploadController',
            'mautic.asset.helper.token' => [
                'class'     => 'Mautic\AssetBundle\Helper\TokenHelper',
                'arguments' => 'mautic.asset.model.asset'
            ]
        ],
        'models' =>  [
            'mautic.asset.model.asset' => [
                'class' => 'Mautic\AssetBundle\Model\AssetModel',
                'arguments' => [
                    'mautic.lead.model.lead',
                    'mautic.category.model.category',
                    'request_stack',
                    'mautic.helper.ip_lookup',
                    'mautic.helper.core_parameters'
                ]
            ]
        ]
    ],

    'parameters' => [
        'upload_dir'            => '%kernel.root_dir%/../media/files',
        'max_size'              => '6',
        'allowed_extensions'    => ['csv', 'doc', 'docx', 'epub', 'gif', 'jpg', 'jpeg', 'mpg', 'mpeg', 'mp3', 'odt', 'odp', 'ods', 'pdf', 'png', 'ppt', 'pptx', 'tif', 'tiff', 'txt', 'xls', 'xlsx', 'wav']
    ]
];
