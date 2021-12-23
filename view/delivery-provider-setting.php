<?php
$tr_class = ( isset( $tr_class ) ) ? $tr_class : '';

$change_args = array( 'action' => 'change-delivery-provider' );

if ( ! empty( $_GET['orig_delivery_provider'] ) ) {
	$change_args['orig_delivery_provider'] = $_GET['orig_delivery_provider'];
}
?>

<tr class="as3cf-delivery-provider <?php echo $tr_class; ?>">
	<td><h4><?php _e( 'Provider:', 'amazon-s3-and-cloudfront' ); ?></h4></td>
	<td>
		<span id="<?php echo $prefix; ?>-active-delivery-provider" class="as3cf-active-provider">
			<?php echo $this->get_delivery_provider()->get_provider_service_name(); // xss ok ?>
		</span>
	</td>
</tr>
