/* eslint-disable camelcase */
'use strict';

( function( $ ) {
	let el_membership_categories;
	let el_lp_pmpro_courses_data_search_ajax;

	$.fn._getElements = function() {
		el_lp_pmpro_courses_data_search_ajax = $( '.lp-pmpro-courses-data-search-ajax' );
		el_membership_categories = $( '.membership_categories' );
	};

	$.fn._courses_setting_on_pms = function() {
		el_membership_categories.find( '.select2 ' ).attr( 'style', 'width: auto !important' );

		const el_ul_list_courses = el_membership_categories.find( '.select2-selection__rendered' );

		const numberCoursesAdded = el_ul_list_courses.find( 'li' ).length - 1;

		el_ul_list_courses.after( '<p style="margin-left: 5px"">Total courses: <span class="total-courses-level">' + numberCoursesAdded + '</span></p>' );

		el_lp_pmpro_courses_data_search_ajax.on( 'change', function() {
			const el_ul_list_courses = el_membership_categories.find( '.select2-selection__rendered' );

			const numberCoursesAdded = el_ul_list_courses.find( 'li' ).length - 1;

			el_membership_categories.find( '.total-courses-level' ).text( numberCoursesAdded );
		} );
	};

	$( document ).ready( function() {
		$.fn._getElements();

		// Membership Settings Admin
		const $wrap = $( '#learn-press-pmpro-settings-admin' ),
			$buyThoughMembership = $( '#learn_press_buy_through_membership', $wrap ),
			$btnBuyCourse = $( '#learn_press_button_buy_course', $wrap );

		$buyThoughMembership.on( 'change', function() {
			console.log( $btnBuyCourse.closest( 'tr' ) );

			if ( $( this ).prop( 'checked' ) ) {
				$btnBuyCourse.closest( 'tr' ).addClass( 'hide-if-js' );
			} else {
				$btnBuyCourse.closest( 'tr' ).removeClass( 'hide-if-js' );
			}
		} ).trigger( 'change' );

		function formatCourse( repo ) {
			if ( repo.loading ) {
				return repo.text;
			}
			const markup = "<div class='select2-result-course_title'>" + repo.ID + ' - ' + repo.post_title + '</div>';
			return markup;
		}

		function formatCourseSelection( repo ) {
			return repo.name || repo.text;
		}

		el_lp_pmpro_courses_data_search_ajax.select2( {
			ajax: {
				method: 'post',
				url: ajaxurl,
				dataType: 'json',
				delay: 250,
				data( params ) {
					const level_id = $( this ).data( 'level_id' );
					const ex = $( this ).val();

					return {
						action: 'learn_press_pmpro_search_courses_action',
						level_id,
						q: params.term,
						ex,
						page: params.page,
						limit: params.limit,
					};
				},
				processResults( data, params ) {
					params.page = params.page || 1;

					return {
						results: data.items,
						pagination: {
							more: ( params.page * 30 ) < data.total_count,
						},
					};
				},
				cache: true,
			},
			escapeMarkup( markup ) {
				return markup;
			},
			// minimumInputLength: 1,
			templateResult: formatCourse, // omitted for brevity, see the source of this page
			templateSelection: formatCourseSelection, // omitted for brevity, see the source of this page
		} );

		$.fn._courses_setting_on_pms();
	} );
}( jQuery ) );
