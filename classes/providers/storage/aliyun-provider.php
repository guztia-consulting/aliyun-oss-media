<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Providers\Storage;

class Aliyun_Provider extends AWS_Provider {

	/**
	 * @var string
	 */
	protected static $provider_name = 'Aliyun';

	/**
	 * @var string
	 */
	protected static $provider_short_name = 'Aliyun';

	/**
	 * Used in filters and settings.
	 *
	 * @var string
	 */
	protected static $provider_key_name = 'aliyun';

	/**
	 * @var string
	 */
	protected static $service_name = 'OSS';

	/**
	 * @var string
	 */
	protected static $service_short_name = 'OSS';

	/**
	 * Used in filters and settings.
	 *
	 * @var string
	 */
	protected static $service_key_name = 'oss';

	/**
	 * Optional override of "Provider Name" + "Service Name" for friendly name for service.
	 *
	 * @var string
	 */
	protected static $provider_service_name = '';

	/**
	 * The slug for the service's quick start guide doc.
	 *
	 * @var string
	 */
	protected static $provider_service_quick_start_slug = 'aliyun-oss-quick-start-guide';

	/**
	 * @var array
	 */
	protected static $access_key_id_constants = array(
		'ALIYUN_ACCESS_KEY_ID',
	);

	/**
	 * @var array
	 */
	protected static $secret_access_key_constants = array(
		'ALIYUN_ACCESS_KEY_SECRET',
	);

	/**
	 * @var array
	 */
	protected static $use_server_roles_constants = array();

	/**
	 * @var bool
	 */
	protected static $block_public_access_allowed = false;

	/**
	 * @var array
	 */
	protected $regions = array(
		'cn-qingdao' => 'China (Qingdao)',
		'cn-beijing' => 'China (Beijing)',
		'cn-zhangjiakou' => 'China (Zhangjiakou)',
		'cn-huhehaote' => 'China (Hohhot)',
		'cn-wulanchabu' => 'China (Ulanqab)',
		'cn-hangzhou' => 'China (Hangzhou)',
		'cn-shanghai' => 'China (Shanghai)',
		'cn-shenzhen' => 'China (Shenzhen)',
		'cn-heyuan' => 'China (Heyuan)',
		'cn-guangzhou' => 'China (Guangzhou)',
		'cn-chengdu' => 'China (Chengdu)',
		'cn-nanjing' => 'China (Nanjing)',
	);

    /**
     * @var bool
     */
    protected $region_required = true;

	/**
	 * @var string
	 */
	protected $default_region = 'cn-shanghai';

	/**
	 * @var string
	 */
	protected $default_domain = 'aliyuncs.com';

	/**
	 * @var string
	 */
	protected $console_url = 'https://oss.console.aliyun.com/overview';

	/**
	 * @var string
	 */
	protected $console_url_prefix_param = '?path=';

    /**
     * @var array
     */
    private $client_args = array();

    /**
     * Process the args before instantiating a new client for the provider's SDK.
     *
     * @param array $args
     *
     * @return array
     */
    protected function init_client_args( Array $args ) {
        if ( empty( $args['endpoint'] ) ) {
            // Alibaba Cloud endpoints always require a region.
            $args['region'] = empty( $args['region'] ) ? $this->default_region : $args['region'];

            $args['endpoint'] = 'https://oss-' . $args['region'] . '.' . $this->default_domain;
        }

        $this->client_args = $args;

        return $this->client_args;
    }

    /**
     * Process the args before instantiating a new service specific client.
     *
     * @param array $args
     *
     * @return array
     */
    protected function init_service_client_args( Array $args ) {
        return $args;
    }

    /**
     * Get the region specific prefix for raw URL
     *
     * @param string   $region
     * @param null|int $expires
     *
     * @return string
     */
    protected function url_prefix( $region = '', $expires = null ) {
        $prefix = 'oss';

        if ( '' !== $region ) {
            $prefix .= '-' . $region;
        }

        return $prefix;
    }
}
