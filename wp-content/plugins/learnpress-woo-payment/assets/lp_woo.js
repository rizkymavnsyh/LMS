;(function ($) {
	let $el_form_lp_woo_add_course_to_cart,
	$el_thim_login_popup

	$.fn._add_course_to_cart = function () {
		$(document).on( 'submit', 'form[name=form-add-course-to-cart]',
			function (e) {
				$el_form_lp_woo_add_course_to_cart = $(this);
				e.preventDefault()
				var self_form = $(this);

				/**
				 * For theme Eduma
				 * When user not login, click add-to-cart will show popup login
				 * Set params submit course
				 */
				if ($el_thim_login_popup.length && 'yes' !== localize_lp_woo_js.woo_enable_signup_and_login_from_checkout &&
				'yes' !== localize_lp_woo_js.woocommerce_enable_guest_checkout) {
					if ($( 'body:not(".logged-in")' )) {
						$el_thim_login_popup.trigger( 'click' )

						// Add param add course to cart to login form
						let $popupUpForm = $( 'form[name=loginpopopform]' )

						if ( ! $popupUpForm.find( '.params-purchase-code' ).length) {
							let course_id = $el_form_lp_woo_add_course_to_cart.find(
								'input[name=course-id]'
							).val()
								  // let course_to_cart_nonce = $el_form_lp_woo_add_course_to_cart.find(
								  // 'input[name=add-course-to-cart-nonce]' ).val();

								  $popupUpForm.append( '<p class="params-purchase-code"></p>' )
								let $params_purchase_course = $popupUpForm.find(
									'.params-purchase-code'
								)
								$params_purchase_course.append(
									'<input type="hidden" name="add-to-cart" value="' + course_id +
									'" />'
								)
								$params_purchase_course.append(
									'<input type="hidden" name="purchase-course" value="' +
									course_id + '" />'
								)
								  // $params_purchase_course.append(
								  // '<input type="hidden" name="add-course-to-cart-nonce" value="' +
								  // course_to_cart_nonce + '" />' );
						}

						return false
					}
				}

				let el_btn_add_course_to_cart_woo = $el_form_lp_woo_add_course_to_cart.find(
					'.btn-add-course-to-cart'
				)

				let data = $( this ).serialize()
				data    += '&action=lpWooAddCourseToCart'

				$.ajax(
					{
						url: localize_lp_woo_js.url_ajax,
						data: data,
						method: 'post',
						dataType: 'json',
						success: function (rs) {
							if (rs.code === 1) {
								if (undefined !== rs.redirect_to && rs.redirect_to !== '') {
									window.location = rs.redirect_to
								} else {
									$('.wrap-btn-add-course-to-cart').each( function( e ) {
										let el = $(this);
										let course_id = el.find('[name=course-id]').val();
										let course_id_added_to_cart = $el_form_lp_woo_add_course_to_cart.find('[name=course-id]').val();

										if(course_id === course_id_added_to_cart) {
											el.append( rs.button_view_cart );
										}
									} );
									//$('.wrap-btn-add-course-to-cart').append( rs.button_view_cart );
									$el_form_lp_woo_add_course_to_cart.remove();

									$('div.widget_shopping_cart_content').html(rs.widget_shopping_cart_content);
									$('.minicart_hover .items-number').html(rs.count_items);
								}
							} else {
								alert( rs.message )
							}
						},
						beforeSend: function () {
							el_btn_add_course_to_cart_woo.append(
								'<span class="fa fa-spinner"></span>'
							)
						},
						complete: function () {
							el_btn_add_course_to_cart_woo.find( 'span' ).removeClass( 'fa fa-spinner' )
						},
						error: function (e) {
							console.log( e )
						},
					}
				)
				return false
			}
		)
	}

	let check_reload_browser = function () {
		window.addEventListener(
			'pageshow',
			function (event) {
				const hasCache = event.persisted ||
				(typeof window.performance != 'undefined' && String(window.performance.getEntriesByType( 'navigation' )[0].type) == 'back_forward')

				if (hasCache) {
					location.reload()
				}
			}
		)
	}

	// Fix event browser back - load page to show 'view cart' button if added to cart
	check_reload_browser()

	$(function() {
		// For theme eduma
		$el_thim_login_popup = $( '.thim-login-popup .login' )

		$.fn._add_course_to_cart()
	});
}(jQuery))
