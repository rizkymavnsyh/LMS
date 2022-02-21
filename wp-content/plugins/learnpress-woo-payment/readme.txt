=== LearnPress - WooCommerce Payment Methods Integration ===
Contributors: thimpress
Donate link:
Tags: lms, elearning, e-learning, learning management system, education, course, courses, quiz, quizzes, questions, training, guru, sell courses
Requires at least: 5.6
Tested up to: 5.8.1
Stable tag: trunk
Tested up Woocommerce: 5.8.0
Requires PHP: 7.0
Requires Learnpress: 4.1.5-beta-0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

LearnPress Woo Payment is an extension plugin to integrate Woocommerce to LearnPress as a payment solution.

== Description ==
LearnPress Woo Payment is an extension plugin to integrate Woocommerce to LearnPress as a payment solution.

== Installation ==

**From your WordPress dashboard**
1. Visit 'Plugin > Add new'.
2. Search for 'LearnPress Woo Payment'.
3. Activate LearnPress from your Plugins page.

**From WordPress.org**
1. Search, select and download LearnPress Woo Payment.
2. Activate the plugin through the 'Plugins' menu in WordPress Dashboard.

== Frequently Asked Questions ==

Check out <a href="http://docs.thimpress.com/learnpress" target="_blank">LearnPress</a> sites.

== Screenshots ==
1. Plugin frontend

== Changelog ==

= 4.0.6 =
~ Added: hook 'learnpress/wc-order/can-purchase-product' for 'Addon coming soon' can rewrite.
~ Fixed: error conflict with addon H5P - not show list product when assign courses to product.

= 4.0.5 =
~ Modified: hide_show_price_course function.
~ Fixed: error don't check out of stock with user not login.
~ Added: LP_Order key on WC Order.
~ Fixed: error can't find course like product on the WC Coupon - Backend.

= 4.0.4 =
~ Fixed: use WC_Cart on ajax will be null something
~ Fixed: error Create woo order manual not create LP Order
~ Change hook "add to cart"
~ Remove function LP_Addon_Woo_Payment_Preload::get_template to use default of LP_Addon

= 4.0.3 =
~ Add LP_Addon_Woo_Payment_Preload::get_template.
~ Load assets on the button add-to-cart.
~ Modified "update_lp_order_status" function.
~ Fixed status enable default.
~ Fixed styles.

= 4.0.2 =
~ Show "Order Woocommerce" on the LP Profile page.
~ Added: function assign courses to product, user can buy list course via product, show tab list course on product assigned
~ Added: button add to cart on course archive page.

= 4.0.1 =
~ Fixed minor bugs

= 4.0.0 =
~ Fix compatible LP4

= 3.2.7 =
~ Fix minor bugs

= 3.2.6 =
~ Fix click add-to-cart show login popup if not login - on Eduma theme - Check "Allow customers to place orders without an account" and "Allow customers to create an account during checkout"

= 3.2.5 =
~ Fix click add-to-cart show login popup if not login - on Eduma theme

= 3.2.4 =
~ Click view cart will not open new tab
~ Fix button 'view cart' show right when back to course if added to cart

= 3.2.3 =
~ Fix set price error when WC()->cart null
~ Update file language

= 3.2.2 =
~ Add option redirect to page Checkout when click add to cart
~ Fix js, css view cart with theme

= 3.2.1 =
~ Fixed buy certificate,
~ Fixed buy course (require LP 3.2.7.6)
~ Remove option Purchase button

= 3.2.0 =
+ Ensure get newest status of WC to update to LP order.
+ Fixed learn_press_assets() not found when calling ajax.

= 3.1.9 =
+ Updated language file.

= 3.1.8 =
+ Work with Woocommerce option "Redirect to the cart page after successful addition"

= 3.1.7 =
~ Fixed minor bug: LP_AJAX_START error

= 3.1.6 =
~ Fixed bug: error on add multiple course to cart.

= 3.1.5 =
~ Fixed bug: work not correct when cache is turn on.
~ Fixed bug: Course display without link in the cart, order, email, thankyou page.

= 3.1.4 =
~ Fixed bug: course thumbnail not show in cart

= 3.1.3 =
+ add tax option for course

= 3.1.2 =
~ update learnpress order data

= 3.1.1 =
~ Fixed bug buy course redirect to LP checkout page

= 3.1.0 =
~ Fixed conflict with other plugin.
~ Fixed bug email not send when new order is created.
~ Fixed bug order status is processing.
~ Fixed bug user still can add purchased course to cart.
~ Fixed user create order with Guest user.
~ Fixed click buy course button then redirect to profile page or login page.

= 3.0.2 =
~ Fixed bug order not show item in admin
~ Fixed conflict with other payment methord of Woocommerce.

= 3.0.1 =
+ Update admin notice
~ Clearn code template
~ Fixed minor javascript bug
~ Fixed bug course added to cart when user enroll free course

= 3.0.0 =
+ Compatible with Learnpress 3.0.0

= 2.4.8.4 =
~ Fixed: Column "Purchased" in LearnPress / Orders page  show "Course does not exist" - occurs with Woocommerce 2.6.4
~ Fixed: Order status of Woocommerce not auto completed - occurs with Woocommerce 2.6.4
~ Fixed: fixed load text domain issues.
~ Fixed: "View cart" button not appear after course added to cart.

= 2.4.8.3 =
~ Fixed: Can not load template in theme
~ Fixed: Cart empty when guest login to buy course

= 2.4.8.2 =
~ Fixed: guest user can see enroll button on free course

= 2.4.8 =
~ Fixed: guest user can see enroll button on free course

= 2.4.8 =
+ Fixed: woocommerce message display twice when url have subfix is '?add-to-cart=**'

= 2.4.7 =
+ Fixed: use icons instead of checkboxes to avoid confusion in the list of payments

= 2.4.6 =
+ Fixed: enabled payment gateways are not checked in settings

= 2.4.5 =
~ Fixed bug: notice message in cart

= 2.4.4 =
+ Coupon support for course only

= 2.4.3 =
+ Fixed 'Add to cart' button does not update WC ajax cart

= 2.4.2 =
+ Fixed some minor issue related to compatible with WC 3.x

= 2.4.1 =
+ Fixed issue guest use add free course to cart

= 2.4 =
+ Fixed issue with WC 3.x can not create LP order

= 2.3.1 =
+ Fixed issue cannot buy course

= 2.3 =
+ Fixed issue not compatible with  WC 3

= 2.2.4 =
+ Fixed issue with 'Add to cart' button
+ Temporary disable addon for WC 3.0.0

= 2.2.3.1 =
+ Fixed issue when buying course with Cache plugins
+ Changed text domain from learnpress-woo-payment to learnpress

= 2.0 =
+ Updated to be compatible with LearnPress 2.0
+ Added option to user Cart/Checkout pages of WooCommerce itself

= 1.1 =
+ Using WooCommerce Cart to make payment
+ Compatibility with LearnPress 2.0

= 1.0.1 =
+ Fixed error if WooCommerce is not installed

= 1.0 =
- Compatible with LearnPress 1.0.

= 0.9.1 =
The first beta release.

== Upgrade Notice ==
Later :)

== Other note ==
<a href="http://docs.thimpress.com/learnpress" target="_blank">Documentation</a> is available in ThimPress site.
<a href="https://github.com/LearnPress/LearnPress/" target="_blank">LearnPress github repo.</a>
