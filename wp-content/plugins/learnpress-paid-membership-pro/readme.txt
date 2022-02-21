=== LearnPress - Paid Membership Pro Integration ===
Contributors: thimpress, phonglq, tunnhn, tutv95
Donate link:
Tags: lms, elearning, e-learning, learning management system, education, course, courses, quiz, quizzes, questions, training, guru, sell courses
Requires at least: 4.5
Tested up to: 5.5.3
Tested 'Paid Memberships Pro' plugin up to: 2.4
Tested 'Paid Memberships Pro - WooCommerce Add On' plugin up to: 1.7
Tested 'WooCommerce' plugin up to: 4.3.1
Stable tag: 3.1.16
License: Split License
License URI: https://help.market.envato.com/hc/en-us/articles/202501064-What-is-Split-Licensing-and-the-GPL-

== Description ==

Paid Membership Pro add-on for LearnPress.

== Installation ==

**From your WordPress dashboard**
1. Visit 'Plugin > Add new'.
2. Search for 'LearnPress - Paid Membership Pro'.
3. Activate LearnPress - Paid Membership Pro from your Plugins page.

== Frequently Asked Questions ==

= Can I create an add-on for LearnPress like LearnPress - Paid Membership Pro by myself? =
Yes, you can. Please find the documentation for writing an add-on for LearnPress in our <a href="https://github.com/LearnPress/LearnPress/wiki" target>LearnPress github repo.</a>

== Screenshots ==

== Changelog ==

= 4.0.1 =
~ Fix show sort level from PMS Pro v2.5.8

= 4.0.0 =
~ Fix compatible LP4

= 3.1.18 =
~ Fix minor bugs

= 3.1.17 =
~ Fix get current time set to wp_schedule_single_event() function

= 3.1.16 =
~ Fix can't add courses when edit level on PMS plugin reason by can't load learn-press-pms-script
~ Remove ALTERNATE_WP_CRON

= 3.1.15 =
~ Add: check wp cron-job enable
~ Add feature: Woocomerce order completed has a product in level will create Lp Order store courses on level and cancel level old
~ Fix style Courses Setting on level PMS, show total courses choice
~ Add feature: Update access courses of users when level PMS change list courses
~ Add feature: Admin add new PMS order or change status PMS order to 'completed' or 'success' will create LP order status completed
~ Add feature: Admin change status from 'success' or 'completed' to another will cancel LP order
~ Add feature: Admin change level of User on Users

= 3.1.14 =
~ Fixed miss cron-job task if set time current (reason can by server process slow, so when save task to database and run, time current > time run task)
~ Add option 'Mode run'

= 3.1.13 =
~ Fixed: prefix table postmeta
~ Replace: use Cron-job instead of Curl to add courses to LP Order

= 3.1.12 =
~ Fixed: user subscription with level free can't learn the course

= 3.1.11 =
- Add feature: when user cancel membership will cancel lp order
- Add feature: when user change membership to another level will cancel lp order old

= 3.1.10 =
~ Improve flow data, speed load
~ Add class handle database
~ Add class handle curl
~ Add class handle ajax

= 3.1.9 =
~ Fixed bug: "Add to cart" button show not show after cancell membership.

= 3.1.8 =
~ Fixed bug: "Buy Membership" button show not show.

= 3.1.7 =
~ Fixed bug: Take this course button not show.

= 3.1.6 =
~ Fixed bug: "Buy Membership" button show when user purchased course.

= 3.1.5 =
~ Fixed bug: "Enroll course" button still show in free course when "Buy course via membership" is enabled.

= 3.1.4 =
~ Fixed bug: Order created via Paid Memberships Pro not display Payment method
~ Fixed nimor bugs


= 3.1.3 =
~ Fixed bug: Buy Memberships button display on none membership course
~ Fixed bug: User cannot access course in their memberships level
~ Fixed bug: Remove some notice error message in single course page, course archive page, learnpress profile page

= 3.1.2 =
~ Fixed bug: Free price of course is not display.
~ Fixed bug: redirect to home page instead confirmpage.
~ Fixed bug: Loop redirect.


= 3.1.1 =
~ Fixed bug: some page of paid memberships pro have not content.
+ allow member can retake course after finished course.
+ hide free price of course.


= 3.1 =
~ Fixed bug: the buy course button still appear when the buy course via membership option is enabled
~ Fixed bug: user still can access course when level is expired.
~ Fixed bug: not auto enroll course.
~ Fixed bug: user enroll course when not have required memberships level.
~ Fixed bug: cannot overwrite template file.
~ Fixed bug: button buy membership still show after enrolled/purchased course.
~ Fixed bug: icon is not show in the levels page not show when user not yet login.

= 3.0.2 =
+ Show the Buy Membership button in course archive page.
~ Fixed some minor bugs

= 3.0.1 =
~ Fixed bug can change memberships level of course in edit course page

= 3.0.0 =
+ Compatible with Learnpress 3.0.0

= 2.3.7 =
~ Fixed bug: loop redirects with logged in user

= 2.3.6 =
~ Fixed bug: empty order is created when user enroll course at first time
~ Fixed bug: warning message with parameters does not match when calling a hook

= 2.3.5 =
~ Fixed bug: save courses in memberships level not correct.

= 2.3.4 =
~ Fixed some minor bugs

= 2.3.3 =
+ Hide Free price of course in memberships level
~ Fixed some minor bugs

= 2.3.2 =
~ Fixed bug: notice message at top

= 2.3.1 =
~ Fixed auto update learn press order
+ Prevent access course after memberships level is expired

= 2.3 =
+ Add feature add coures into a Memberships Level in the edit Memberships Level page
~ Fixed bug: user cannot access course in their membership level in case memberships level is not purchase ( in other word is set memberships level manual)

= 2.2.4 =
+ Fixed bug: user cannot access course added to membership level after user join membership level

= 2.2.3 =
+ Fixed bug: user cannot access course of membership level

= 2.2.2 =
+ Changed text domain to learnpress

= 2.2.1 =
+ Fixed issue can not add course to wc cart with non-logged in user

= 1.1 =
+ Updated to be compatible with LearnPress 2.0

= 1.0.0 =
Initialize plugin

== Upgrade Notice ==

== Other note ==
<a href="http://docs.thimpress.com/learnpress" target="_blank">Documentation</a> is available in ThimPress site.
<a href="https://github.com/LearnPress/LearnPress/" target="_blank">LearnPress github repo.</a>
