<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Providers\Delivery;

class StackPath extends Another_CDN {

	/**
	 * Which storage providers does the delivery provider support, empty means all.
	 *
	 * @var array
	 */
	protected static $supported_storage_providers = array(
		// TODO: Add 'do' after testing and documenting.
		'aws',
	);

	/**
	 * @var string
	 */
	protected static $provider_name = 'StackPath';

	/**
	 * @var string
	 */
	protected static $provider_short_name = 'StackPath';

	/**
	 * Used in filters and settings.
	 *
	 * @var string
	 */
	protected static $provider_key_name = 'stackpath';

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
	protected static $provider_service_name = 'StackPath';

	/**
	 * @var string
	 */
	protected static $provider_service_quick_start_slug = 'stackpath-setup';
}
