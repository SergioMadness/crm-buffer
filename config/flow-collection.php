<?php

return [
    (new \professionalweb\IntegrationHub\IntegrationHubDB\Models\Flow([
        'is_default' => true,
        'data'       => [
            'start'                              => [
                'id'        => 'start',
                'next'      => ['bitrix-lead', 'postaffiliate-new-transaction', 'paycloud-payment-link'],
                'prev'      => [],
                'condition' => [
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'contact-created',
                        'result'    => ['remember-contact'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'lms-payment',
                        'result'    => ['lms-bitrix-product-mapper'],
                    ],
                    [
                        'field'     => 'original.email',
                        'operation' => 'in',
                        'value1'    => ['barmajgedon@gmail.com', 'jduredssker@gmail.com', 'tsckatova@yandex.ru', 'test@test.test', 'skatovatat@yandex.ru', 'darlfgskdsker@gmail.com', 'gagraseerdr@gmail.com', 'relofrejk@gmail.com', 'sckatovatat@yandex.ru', 'zawidovski.event@gmail.com', '9198919@mail.ru'],
                        'result'    => [],
                    ],
                    [
                        'field'     => 'original.phone',
                        'operation' => 'in',
                        'value1'    => ['+89124525520', '+12134251453'],
                        'result'    => [],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'invoice_change_status',
                        'result'    => ['get-invoice'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'deal_change_status',
                        'result'    => ['bitrix-get-deal-no-invoice'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'cdo_payment',
                        'result'    => ['bitrix-deal-default-value'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'paycloud_callback',
                        'success'   => [
                            [
                                'field'     => 'original.action',
                                'operation' => '=',
                                'value1'    => 'success',
                                'result'    => ['approve-invoice'],
                            ],
                            [
                                'field'     => 'original.action',
                                'operation' => '!|=',
                                'value1'    => 'success',
                                'result'    => ['decline-invoice'],
                            ],
                        ],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'update_lead',
                        'result'    => ['bitrix-get-lead'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'change_status',
                        'result'    => ['bitrix-get-lead'],
                    ],
                    [
                        'field'     => 'original.InvoiceId',
                        'operation' => '!|empty',
                        'result'    => ['paycloud-payment-link'],
                    ],
                    [
                        'field'     => 'original.OrderId',
                        'operation' => '!|empty',
                        'result'    => ['bitrix-approve-invoice'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'new_lead',
                        'result'    => ['bitrix-get-lead-new-lead'],
                    ],
                    [
                        'field'     => 'original.InvoiceId',
                        'operation' => 'empty',
                        'result'    => ['bitrix-product-mapper'],
                    ],
                ],
            ],
            'lms-bitrix-product-mapper'          => [
                'id'   => 'lms-bitrix-product-mapper',
                'next' => ['bitrix-product-mapper-deal'],
                'prev' => ['start'],
            ],
            'bitrix-product-mapper-deal'         => [
                'id'        => 'bitrix-product-mapper-deal',
                'subsystem' => 'bitrix-product-mapper',
                'next'      => ['bitrix-deal-default-value'],
                'prev'      => ['start'],
            ],
            'remember-contact'                   => [
                'id'   => 'remember-contact',
                'next' => [],
                'prev' => ['start'],
            ],
            'bitrix-lead-default-value'          => [
                'id'        => 'bitrix-lead-default-value',
                'next'      => ['bitrix-set-assigner'],
                'prev'      => ['start'],
                'condition' => [
                    [
                        'field'     => 'original.form_name',
                        'operation' => '=',
                        'value1'    => 'franchise',
                        'result'    => ['bitrix-franchise-set-assigner'],
                    ],
                    [
                        'field'     => 'original.form_name',
                        'operation' => '!|=',
                        'value1'    => 'franchise',
                        'result'    => ['bitrix-set-assigner'],
                    ],
                ],
            ],
            'bitrix-product-mapper'              => [
                'id'   => 'bitrix-product-mapper',
                'next' => ['bitrix-lead-default-value'],
                'prev' => ['start'],
            ],
            'bitrix-set-assigner'                => [
                'id'   => 'bitrix-set-assigner',
                'next' => ['bitrix-check-duplicates'],
                'prev' => ['bitrix-product-mapper'],
            ],
            'bitrix-franchise-set-assigner'      => [
                'id'   => 'bitrix-franchise-set-assigner',
                'next' => ['bitrix-franchise-check-duplicates'],
                'prev' => ['bitrix-product-mapper'],
            ],
            'bitrix-deal-default-value'          => [
                'id'   => 'bitrix-deal-default-value',
                'next' => ['get-contact'],
                'prev' => ['start'],
            ],
            'get-contact'                        => [
                'id'        => 'get-contact',
                'next'      => ['bitrix-create-deal'],
                'prev'      => ['start'],
                'condition' => [
                    [
                        'field'     => 'get-contact.value',
                        'operation' => 'empty',
                        'result'    => ['bitrix-find-contact'],
                    ],
                    [
                        'field'     => 'get-contact.value',
                        'operation' => '!|empty',
                        'result'    => ['get-deal'],
                    ],
                ],
            ],
            'bitrix-find-contact'                => [
                'id'        => 'bitrix-find-contact',
                'subsystem' => 'bitrix-search-contact',
                'next'      => ['bitrix-create-deal'],
                'prev'      => ['get-contact'],
                'condition' => [
                    [
                        'field'     => 'bitrix-find-contact.ID',
                        'operation' => 'empty',
                        'result'    => ['bitrix-contact'],
                    ],
                    [
                        'field'     => 'bitrix-find-contact.ID',
                        'operation' => '!|empty',
                        'result'    => ['remember-contact-after-search'],
                    ],
                ],
            ],
            'remember-contact-after-search'      => [
                'id'        => 'remember-contact-after-search',
                'subsystem' => 'remember-contact',
                'next'      => ['get-deal'],
                'prev'      => ['start'],
            ],
            'get-deal'                           => [
                'id'        => 'get-deal',
                'subsystem' => 'find-deal',
                'next'      => ['remember-deal'],
                'prev'      => ['start'],
                'condition' => [
                    [
                        'field'     => 'get-deal.value',
                        'operation' => 'empty',
                        'result'    => ['bitrix-find-deal'],
                    ],
                    [
                        'field'     => 'get-deal.value',
                        'operation' => '!|empty',
                        'result'    => ['bitrix-invoice-default-value'],
                    ],
                ],
            ],
            'bitrix-find-deal'                   => [
                'id'        => 'bitrix-find-deal',
                'next'      => [],
                'prev'      => [],
                'condition' => [
                    [
                        'field'     => 'bitrix-find-deal.ID',
                        'operation' => 'empty',
                        'result'    => ['bitrix-create-deal'],
                    ],
                    [
                        'field'     => 'bitrix-find-deal.ID',
                        'operation' => '!|empty',
                        'result'    => ['remember-deal'],
                    ],
                ],
            ],
            'remember-deal'                      => [
                'id'   => 'remember-deal',
                'next' => ['bitrix-invoice-default-value'],
                'prev' => [],
            ],
            'bitrix-create-deal'                 => [
                'id'   => 'bitrix-create-deal',
                'next' => ['remember-deal'],
                'prev' => ['bitrix-deal-default-value'],
            ],
            'bitrix-get-lead'                    => [
                'id'   => 'bitrix-get-lead',
                'next' => ['bitrix-lead-to-pap-status'],
                'prev' => ['start'],
            ],
            'bitrix-get-lead-new-lead'           => [
                'id'        => 'bitrix-get-lead-new-lead',
                'next'      => [],
                'prev'      => ['start'],
                'condition' => [
                    [
                        'field'     => 'bitrix-get-lead-new-lead.CREATED_BY_ID',
                        'operation' => '!|=',
                        'value1'    => 69,
                        'result'    => ['bitrix-to-pap-status-readable'],
                    ],
                ],
            ],
            'bitrix-get-new-lead'                => [
                'id'   => 'bitrix-get-new-lead',
                'next' => ['bitrix-to-pap-status-readable'],
                'prev' => ['start'],
            ],
            'bitrix-to-pap-status-readable'      => [
                'id'        => 'bitrix-to-pap-status-readable',
                'next'      => ['postaffiliate-update-event'],
                'prev'      => ['bitrix-get-lead'],
                'condition' => [
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'new_lead',
                        'result'    => ['postaffiliate-new-transaction'],
                    ],
                    [
                        'field'     => 'original.type',
                        'operation' => '!|=',
                        'value1'    => 'new_lead',
                        'result'    => ['postaffiliate-update-event'],
                    ],
                ],
            ],
            'bitrix-invoice-default-value'       => [
                'id'   => 'bitrix-invoice-default-value',
                'next' => ['bitrix-create-invoice'],
                'prev' => ['bitrix-create-deal'],
            ],
            'bitrix-create-invoice'              => [
                'id'        => 'bitrix-create-invoice',
                'next'      => [],
                'prev'      => ['bitrix-invoice-default-value'],
                'condition' => [
                    [
                        'field'     => 'original.advcake_track_id',
                        'operation' => '!|empty',
                        'result'    => ['find-advcake'],
                    ],
                ],
            ],
            'bitrix-approve-invoice'             => [
                'id'   => 'bitrix-approve-invoice',
                'next' => [],
                'prev' => ['start'],
            ],
            'bitrix-contact'                     => [
                'id'   => 'bitrix-contact',
                'next' => ['remember-contact-after-search'],
                'prev' => ['start'],
            ],
            'bitrix-lead-distribution'           => [
                'id'        => 'bitrix-lead-distribution',
                'next'      => ['bitrix-check-duplicates', 'bitrix-lead'],
                'prev'      => ['start'],
                'condition' => [
                    [
                        'field'     => 'bitrix-lead-distribution.assigned_by_id',
                        'operation' => '=',
                        'value1'    => 0,
                        'result'    => ['buffer-set-new'],
                    ],
                    [
                        'field'     => 'bitrix-lead-distribution.assigned_by_id',
                        'operation' => '>',
                        'value1'    => 0,
                        'result'    => ['bitrix-lead'],
                    ],
                ],
            ],
            'buffer-set-new'                     => [
                'id'   => 'buffer-set-new',
                'next' => [],
                'prev' => ['bitrix-lead-distribution'],
            ],
            'bitrix-check-duplicates'            => [
                'id'   => 'bitrix-check-duplicates',
                'next' => ['bitrix-lead'],
                'prev' => ['bitrix-product-mapper'],
            ],
            'bitrix-franchise-check-duplicates'  => [
                'id'        => 'bitrix-franchise-check-duplicates',
                'subsystem' => 'bitrix-check-duplicates',
                'next'      => ['bitrix-franchise-lead'],
                'prev'      => ['bitrix-product-mapper'],
            ],
            'bitrix-franchise-lead'              => [
                'id'   => 'bitrix-franchise-lead',
                'prev' => ['bitrix-check-duplicates'],
                'next' => [],
            ],
            'bitrix-lead'                        => [
                'id'        => 'bitrix-lead',
                'prev'      => ['bitrix-check-duplicates'],
                'next'      => ['postaffiliate-new-transaction'],
                'condition' => [
                    [
                        'field'     => 'original.a_aid',
                        'operation' => '!|empty',
                        'result'    => ['postaffiliate-new-transaction'],
                    ],
                    [
                        'field'     => 'original.a_aid',
                        'operation' => 'empty',
                        'result'    => [],
                        'success'   => [
                            [
                                'field'     => 'original.advcake_track_id',
                                'operation' => '!|empty',
                                'result'    => ['find-advcake'],
                            ],
                        ],
                    ],
                ],
            ],
            'find-advcake'                       => [
                'id'   => 'find-advcake',
                'prev' => ['bitrix-lead'],
                'next' => ['aggregation'],
            ],
            'aggregation'                        => [
                'id'   => 'aggregation',
                'prev' => ['find-advcake'],
                'next' => ['remember-advcake'],
            ],
            'remember-advcake'                   => [
                'id'   => 'remember-advcake',
                'prev' => ['bitrix-lead'],
                'next' => [],
            ],
            'bitrix-workflow'                    => [
                'id'        => 'bitrix-workflow',
                'prev'      => ['bitrix-lead'],
                'next'      => [],
                'condition' => [
                    [
                        'field'     => 'original.visitorId',
                        'operation' => '!|empty',
                        'result'    => ['postaffiliate-new-transaction'],
                    ],
                ],
            ],
            'postaffiliate-new-transaction'      => [
                'id'        => 'postaffiliate-new-transaction',
                'next'      => ['aggregation'],
                'prev'      => ['bitrix-lead'],
                'condition' => [
                    [
                        'field'     => 'original.type',
                        'operation' => '=',
                        'value1'    => 'cdo_lead',
                        'result'    => ['start-create-contact-process'],
                    ],
                    [
                        'field'     => 'original.advcake_track_id',
                        'operation' => '!|empty',
                        'result'    => ['find-advcake'],
                    ],
                ],
            ],
            'start-create-contact-process'       => [
                'id'   => 'start-create-contact-process',
                'next' => [],
                'prev' => ['postaffiliate-new-transaction'],
            ],
            'postaffiliate-find-transaction'     => [
                'id'   => 'postaffiliate-find-transaction',
                'next' => ['postaffiliate-new-transaction'],
                'prev' => ['bitrix-lead'],
            ],
            'postaffiliate-get-transaction'      => [
                'id'   => 'postaffiliate-get-transaction',
                'next' => ['postaffiliate-new-transaction-deal'],
                'prev' => ['bitrix-lead'],
            ],
            'postaffiliate-new-transaction-deal' => [
                'id'   => 'postaffiliate-new-transaction-deal',
                'next' => [],
                'prev' => [],
            ],
//            'payment-link-mail'             => [
//                'id'   => 'payment-link-mail',
//                'next' => [],
//                'prev' => ['paycloud-payment-link'],
//            ],
            'paycloud-payment-link'              => [
                'id'   => 'paycloud-payment-link',
                'next' => ['add-payment-link-to-invoice'],
                'prev' => ['start'],
            ],
            'postaffiliate-set-status'           => [
                'id'   => 'postaffiliate-set-status',
                'next' => [],
                'prev' => ['start'],
            ],
            'postaffiliate-update-event'         => [
                'id'   => 'postaffiliate-update-event',
                'next' => ['find-advcake'],
                'prev' => ['start'],
            ],
            'aggregation-update'                 => [
                'id'   => 'aggregation-update',
                'next' => [],
                'prev' => ['postaffiliate-update-event'],
            ],
            'get-invoice'                        => [
                'id'   => 'get-invoice',
                'next' => ['bitrix-to-pap-status'],
                'prev' => ['start'],
            ],
            'bitrix-get-deal-no-invoice'         => [
                'id'        => 'bitrix-get-deal-no-invoice',
                'subsystem' => 'bitrix-get-deal',
                'next'      => [],
                'prev'      => [],
                'condition' => [
                    [
                        'field'     => 'bitrix-get-deal-no-invoice.STAGE_ID',
                        'operation' => '=',
                        'value1'    => 'PREPARATION',
                        'result'    => ['bitrix-get-contact'],
                    ],
                ],
            ],
            'bitrix-get-contact'                 => [
                'id'   => 'bitrix-get-contact',
                'next' => ['lms-get-user'],
                'prev' => [],
            ],
            'lms-get-user'                       => [
                'id'        => 'lms-get-user',
                'next'      => [],
                'prev'      => [],
                'condition' => [
                    [
                        'field'     => 'lms-get-user.id',
                        'operation' => 'empty',
                        'result'    => ['lms-register-user'],
                    ],
                    [
                        'field'     => 'lms-get-user.id',
                        'operation' => '!|empty',
                        'result'    => ['remember-contact-deal'],
                    ],
                ],
            ],
            'remember-contact-deal'              => [
                'id'        => 'remember-contact-deal',
                'subsystem' => 'remember-contact',
                'next'      => [],
                'prev'      => ['start'],
            ],
            'lms-register-user'                  => [
                'id'   => 'lms-register-user',
                'next' => [],
                'prev' => [],
            ],
            'bitrix-get-deal'                    => [
                'id'        => 'bitrix-get-deal',
                'next'      => ['postaffiliate-get-transaction'],
                'prev'      => ['start'],
                'condition' => [
                    [
                        'field'     => 'get-invoice.STATUS_ID',
                        'operation' => 'in',
                        'value1'    => ['Q', 'S'],
                        'success'   => [
                            [
                                'field'     => 'get-invoice.PRODUCT_ROWS.0.ID',
                                'operation' => 'in',
                                'value1'    => [41, 43, 45, 47, 49, 51, 53, 55, 57, 59, 61, 63, 65, 1070, 1072, 1112, 5494, 11548, 11550, 10392],
                                'result'    => ['paycloud-payment-link-cbs-edu'],
                            ],
                            [
                                'field'     => 'get-invoice.UF_CRM_PAY_URL',
                                'operation' => 'empty',
                                'result'    => ['paycloud-payment-link-no-convert'],
                            ],
                        ],
                    ],
//                    [
//                        'field'     => 'get-invoice.STATUS_ID',
//                        'operation' => '=',
//                        'value1'    => 'P',
//                        'result'    => ['bitrix-to-pap-status'],
//                    ],
                    [
                        'field'     => 'get-invoice.STATUS_ID',
                        'operation' => '=',
                        'value1'    => 'P',
                        'result'    => ['postaffiliate-get-transaction'],
                    ],
                ],
            ],
//            'get-invoice'                        => [
//                'id'        => 'get-invoice',
//                'next'      => [],
//                'prev'      => ['start'],
//                'condition' => [
//                    [
//                        'field'     => 'get-invoice.STATUS_ID',
//                        'operation' => '=',
//                        'value1'    => 'N',
//                        'result'    => ['bitrix-get-deal'],
//                    ],
//                    [
//                        'field'     => 'get-invoice.STATUS_ID',
//                        'operation' => '=',
//                        'value1'    => 'Q',
//                        'success'   => [
//                            [
//                                'field'     => 'get-invoice.UF_CRM_PAY_URL',
//                                'operation' => 'empty',
//                                'result'    => ['paycloud-payment-link-no-convert']
////                                    [
////                                        'field'     => 'get-invoice.UF_CRM_5BE54A65AC69B',
////                                        'operation' => '!|=',
////                                        'value1'    => 'RUB',
////                                        'result'    => ['bitrix-convert-currency'],
////                                    ],
////                                    [
////                                        'field'     => 'get-invoice.UF_CRM_5BE54A65AC69B',
////                                        'operation' => '=',
////                                        'value1'    => 'RUB',
////                                        'result'    => ['paycloud-payment-link-no-convert'],
////                                    ],
////                                ],
//                            ],
//                        ],
//                    ],
//                    [
//                        'field'     => 'get-invoice.STATUS_ID',
//                        'operation' => '!|=',
//                        'value1'    => 'fake',
//                        'result'    => ['bitrix-to-pap-status'],
//                    ],
//                ],
//            ],
            'bitrix-lead-to-pap-status'          => [
                'id'   => 'bitrix-lead-to-pap-status',
                'next' => ['bitrix-to-pap-status-readable'],
                'prev' => [],
            ],
            'bitrix-to-pap-status'               => [
                'id'   => 'bitrix-to-pap-status',
                'next' => ['bitrix-get-deal'],
                'prev' => [],
            ],
            'paycloud-payment-link-no-convert'   => [
                'id'   => 'paycloud-payment-link-no-convert',
                'next' => ['add-payment-link-to-invoice'],
                'prev' => ['start'],
            ],
            'paycloud-payment-link-cbs-edu'      => [
                'id'   => 'paycloud-payment-link-cbs-edu',
                'next' => ['add-payment-link-to-invoice'],
                'prev' => ['start'],
            ],
            'bitrix-convert-currency'            => [
                'id'   => 'bitrix-convert-currency',
                'next' => ['paycloud-payment-link'],
                'prev' => ['get-invoice'],
            ],
            'add-payment-link-to-invoice'        => [
                'id'   => 'add-payment-link-to-invoice',
                'next' => [],
                'prev' => ['convert-currency'],
            ],
            'approve-invoice'                    => [
                'id'   => 'approve-invoice',
                'next' => [],
                'prev' => ['start'],
            ],
            'decline-invoice'                    => [
                'id'   => 'decline-invoice',
                'next' => [],
                'prev' => ['start'],
            ],
        ],
    ]))->setAttribute('id', 1),
];
