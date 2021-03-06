<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Providers\Delivery;

class KeyCDN extends Another_CDN {

	/**
	 * Which storage providers does the delivery provider support, empty means all.
	 *
	 * @var array
	 */
	protected static $supported_storage_providers = array(
		// TODO: Add 'aws' after testing and documenting.
		'do',
	);

	/**
	 * @var string
	 */
	protected static $provider_name = 'KeyCDN';

	/**
	 * @var string
	 */
	protected static $provider_short_name = 'KeyCDN';

	/**
	 * Used in filters and settings.
	 *
	 * @var string
	 */
	protected static $provider_key_name = 'keycdn';

	/**
	 * @var string
	 */
	protected static $service_name = 'CDN';

	/**
	 * @var string
	 */
	protected static $service_short_name = 'CDN';

	/**
	 * Used in filters and settings.
	 *
	 * @var string
	 */
	protected static $service_key_name = 'cdn';

	/**
	 * Optional override of "Provider Name" + "Service Name" for friendly name for service.
	 *
	 * @var string
	 */
	protected static $provider_service_name = 'KeyCDN';

	/**
	 * @var string
	 */
	protected static $provider_service_quick_start_slug = 'how-to-set-up-a-custom-domain-for-digitalocean-spaces-with-keycdn';
}
