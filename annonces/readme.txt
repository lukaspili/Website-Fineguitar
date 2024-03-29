﻿OpenClassifieds 1.7.5.1
Release date:   02/04/2012
License:        GPL v3
Installation:   http://open-classifieds.com/install/
Español:        http://open-classifieds.com/es/
Support at:     http://open-classifieds.com/forum/


Changelog:
###############################################

1.7.5.1
updated phpSEO
Paypal bug
Datezonez bug

updated files:
includes/classes/phpSEO.php
includes/item-common.php	
includes/paypal.php
includes/common.php
includes/functions.php
ipn.php
	
###############################################
1.7.5
Prices for categories
dates bug (standarizeDate)
improved phpSEO, now faster
contact form, bug wrong URL on folder install
fixed bug on new post if no category was chosed
problems with email sender fixed $mail->IsSMTP(); moved
improved time zone selector
improved installation process
new favicon
limited the size of the sitemap.xml
CSRF check now with admin password as salt
improved login (should always work the login now)

###############################################
1.7.4
deleted Options All -Indexes from htaccess
fixed problem with adsense in settings.
on install login enabled
Content php files to override theme functions was missplaced
added function isHome()
header doesn't load the wordcloud css if not selected on the sidebar
back to the old register way to post (was just changed at 1.7.3)

###############################################
1.7.3
Optional login http://open-classifieds.com/forum/topic/optional-login
Problem with register link
SQL injection prevent for admin as well http://open-classifieds.com/forum/topic/critical-sql-injection-vulnerable/
Install shows date
On install we don't insert all the countries but just some examples
improved filecache, now stores cache by folder

###############################################
1.7.2
Updated phpSEO to v3
Need and offer now is optional
Fixed bug with RN char in IE, mynltobr
Better params cleaner
fixed bug with pagination with location seted
Fixed bug with siblings location filter
Paypal IPN typo
Bug,link removed when parent cat selected
Improved security for CSRF in all forms
Date format error on standarizedate
Fixed some links errors
Installation autostart.

###############################################
1.7.1.1
Fixed bug on install to select the language
Added the updated transaltion set for 1.7.1
Fixed bug with Line break. Replaced with <br />


###############################################
1.7.1
Pay to post using paypal
Improved software security
Improved install
Home meta description
Locations in feed, sitemap and advanced search
View other posts by this publisher
Listing actions in admin
disable confirming post by link from the email
No publish parents categories
Expiration days post
Updated phpMyDB
Updated fileCache
Usage of wrapperCache Class
Improved internationalization with php-gettext
RSS for sidebar
DB backup from admin
Templates override for any page
Math captcha can be disabled and it's been improved
Allow links in the new items post
Advanced spam by country
Move categories or places on delete
Allowed to filter by category/palce in admin

###############################################
1.7.0.3
Fixed some bugs
Improved hacker defense with allowed tags
Now in locations displays siblings ads
Post to Twitter erased :(
Improved installer

###############################################
1.7.0.2
Languages added
Fixed die(); after login unsuccess
Fixed issue with dates and images

###############################################
1.7.0.1
Minors bugs fixed

###############################################
V 1.7
Url generators moved from common.php to seo.php
Changed default theme to wpClassifieds
Improved $rewritebase configuration on install
Improved guess installation URL on install
New rewriter rules to support 'location' parameter
Modified install database script to add locations support
Added support for custom SMTP host configuration
Added support for SMTP auth configuration
Adjusted wpClassifieds style to enhance input, select tags presentation
Changed sidebar.php section titles format from <b> to <h4>
Improved admin catSlug function
Added new admin section to manage locations
Added three new funtions to common.php:
getLocationName,getLocationFriendlyName,getLocationNum
Handled "location" parameter setup in "possible parameters for the app" controller.php section
Added new sidebar function to show location links (locations)
Added some rewrite conds to the htaccess in order to avoid some redirects in images
Changed way the images are stored, also deleted table images.
Added Site Stats in admin
Added expire headers for better cache
Now prices allows float numbers 
No hacker defense in admin
Account management, create new users account to post!
Email templates
Improved installer step by step.
New look for Admin and installer.
Advertisement setting for AdSense in admin.

###############################################
V 1.6.4
Bug generating friendly URL's post slug.
Fixed some TYPOs in the admin.
Fixed bug when you try to escape mobile edition.
In the notification email to the admin about a new advertisement, added links to delete spam or edit the ad.
Now you can browse the advertisements from the admin panel, in the tab Listing.
Changed disqus and google analytics script to an Asynchronous one.
Moved files from /includes/admin to admin.
On save settings now redirects you to settings with a message.
Feeds from dashboard now uses feedburner, lot faster.
Bug in install was not deleting the config.php on error.
Sitemap.xml include images post.
Improved path detection on install.
Improved installation error messages.

###############################################
V 1.6.3
Deleted +SymLinksIfOwnerMatch from htaccess
Fixed URLs for contact and maps
Updated the way SEO.php and controller.php detects url using now script name
Smart 404 in /content/404.php with advanced search and SEO title
Fixed bug on install the contact rewrite was wrong
New way to upload files, more secure
Allowed 1 youtube video in the posts
Dutch translation thanks to jaco havenaar
New widget to write your HTML advertisements in the sidebar
New favicon

###############################################
V 1.6.2
Bug in themes.php, displayed mobile theme to IE browsers
To install do not require curl
Compressed pages to browser that support it, using ob_gzhandler

###############################################
V 1.6.1
Improved all seo thanks to senormunoz.com
Languages now they use the acronym ex Spanish = ES
Header HTML with the language name.
Bug: was not possible to erase images on post delete.
Bug: the script file name is not always the same for all servers, now works different in controller.php
Fixed few bugs short tags related
Renamed define ENVIRONMENT for DEBUG, now accepts only true or false, in functions.php
Fixed some problems with sitemap when you disable friendly url
New function that returns the item URL, in common.php
New URL structure to improve SEO, old URL will redirect 301 to the new ones ;)
Changes in .htaccess for better SEO, and replaced Options +FollowSymlinks for Options +SymLinksIfOwnerMatch
Changed the meta description length
Changes in /admin/, optimize db, new admin index
Ping to google sitemap, new functionality and new define
Sitemap compressed using gzip, sitemap.xml.gz
Type will not use sessions anymore since there's plenty of problems when browsing.
Added to filter by type in advanced search.
Updated to phpMyDB 0.3
On install you can choose to use some sample data to start working
Improved installation, checking all the requirements before continue
Contact, Sitemap, Privacy, Search, Rss,New Item, Manage Item and Error now in folder /content/
Gmail can be configured from the settings
Settings panel in admin with new feel and look.
Mobile theme by default activated if its a mobile device

###############################################
V 1.6
Romanian language thank to tutankanon, russian thanks to levgen, italian thanks to paolo
Now languages are in /languages/
Created include controller that loads the needed data (before was called data.php)
Db class phpMyDb
new cache class integrated with database class
Mark as spam sends to akismet
no install if minimun requirements (PHP > 5 and writable in /includes/)
prefix for database tables (allows you to have more than one install in the same DB)
AdSense deleted, there was problems with google. please donate
Sidebar allows to change theme
config.php define in admin
categories allow duplicates, changes the post slug
advanced search /search/
fixed few mistakes at sitemap.php
addthis instead of the older slower service add to any
Now templates can have their own index (listing) and template for items
Using j.mp instead of bit.ly to short urls
sort ads by price asc or desc in advanced search
Improved seo now friendly urls for new, contact, sitemap, privacy, advanced search...
ip address function deleted, not needed
Settings now updates htaccess

###############################################
V 1.5.4

filter need offer keeps filtered with a session
changes in ocdb.php
if an item is tagged as spam you cannot edit anymore
price box made bigger
When you insert code now redirects you to /error/ where we can set other messages
Improved seo title in categories new, index, item...
contact opened always (you can close it)

###############################################
V 1.5.3
New languages: Turkish, thanks to Ozan and Arabic thanks Hassouna
Noscript with google indexoff
Improvements in the installation
Auto htaccess in the installation
Set timezone
Google translate widget
Added Go Back to the hacker defense message
Share now using addtoany service
Mark as Spam isavailable=2 check on new
IMPORTANT UPDATE: TYPE_OFFER_NAME and TYPE_NEED_NAME now must be in the language file, if not would appear in english

###############################################
V 1.5.2
Fixed small bugs
Disqus integration in item and sidebar
Easier intall with more suggestions
Noscript in different place after the menu in the body
Got rid off tables usage in index.php
h1 for item name in item.php

To upgrade, config.php define, item.php, sidebar.php, index.php

###############################################
V 1.5.1
Fixed some Install problems
Install sends email after install to admin@open-classifieds.com
Improved google maps integration with drag and drop
Fixed some bugs in /rss/
/map/ shows the items from RSS
Link to a map different for each category

###############################################
V 1.5
Fixed bug in greybox now works in sub directory as well
Installation created /install/
Generated automatically robots.txt
Google Maps integrated

###############################################
V 1.4.3
Error in RSS/index.php fixed
Error in sidebar missing some globals
Emails now accepts up to 4 chars in the extension ex: name@your-domain.info
phpSEO applied http:/neo22s.com/phpseo
Improved overall SEO work
.htacces few changes

###############################################
V 1.4.2
Added umask on create the dir for the images since for some hosting didint work as it is now.
Fixed /sitemap/ was out of dated
Fixed /contact/ was out of dated
Akismet for preventing spam, in all the forms new, contact,contact item
admin_access.php, for people that was using another folder didn't work.
Added reply to in the contact (for email send)
Deleted remember edit form contact (many people was forwarding this link :S )
Created new folder /admin in includes for all admin stuff
Login only the form to login
New header and footer for admin
Changes in sidebar.php
admin_sitemap.php for sitemap generation
noscript message in header.
delete and deactivate possible from the index if you are login as administrator ;)

###############################################
V 1.4.1
Bug in contact form
Different hard-return/line-feed character, fixed thanks to fastkc
French language added
Post to twitter! see config.php
Pagination has a limit of pages to display see config.php
Now the combobox for new is by default empty. Is to make the people choose one category.

###############################################
V 1.4
Fixed bug for isMail fucntion on validation
Portugues and deutsch languages added
Now each theme can have a functions.php file that would be loaded
jsTabs (neo22s.com/jstabs/) in minimalistic theme
getSecTime(). now just returns microtime, was worng before...
Dynamic sidebar, new define in config.php
Improved seo for the title
Added lot of comments in the source code

###############################################
V 1.3.2 (Stable)
Fixed footer in main theme now works in chrome aswell
Delete Cache on new post and on update/new category
Cache_expire define can be set to false, and then is not deleted by time
Generate sitemap on new post and on update/new category
SITEMAP_EXPIRE define can be set to false, and then is not deleted by time
Problem with double spaces, replaced &nbsp; by " "
Function getPrice($amount), to display amount in the correct format, applied in all the project 1 new define to set the format
Share on twitter
Changes in footer in the main theme in order to improve SEO

###############################################
V 1.3.1 (Stable)
UTF 8 problem fixed
Added configuration for size of the resized images

###############################################
V 1.3 (Stable)
Greybox for images
Notification of new ad, email with link for the administrator
Always appears a image in the lists no_pic.png
Improved SEO
Everything uses UTF8, no more latin, changes everywhere to make this possible
Fixed some problems with the editor on categories
Some changes in the main theme
Added a hacker defense that checks all the posts params, now is not posible to add malintecious code on the posts.
Catalan language included (thanks Kiko)

###############################################
V 1.2 (Stable)
Stripslashes added to the text areas
Changed math Captcha a bit more complicated
Fixed bug in IE with nicEdit
Able to edit an advertisement after post
Fix problem with upload images 
Reminder email with links to edit and deactivate

###############################################
V 1.1.2 (Stable)
Changed css default theme minimalistic
Nofollow added in possible links in ads
Pagination for search
Code to prevent reload of the page after post ad/contact
Theme selector, now you can change the theme simply using /?theme=, it will keep a cookie for next time
Fixed bug in contact
Fixed bug in menu popular
Search by location, example: something, barcelona
Google analytics enabled from the config.php
New theme simplyfluid
New theme edit_80

###############################################
V 1.1.1 (Stable)
Fixed bug in rss
Javascript for the field name disabled
.htaccess forgot in the previous release (sorry)
New translation for albanian provided by PERKTHEU AGON XHELADINI
Added Gmail as a way to send emails if you do not have email server
Problem with contact email (security bug)
Improved sitemap
Sql for installation in UTF8 and latin1
New theme roundhouse

###############################################
V 1.1 (Stable)
NOTICE: The themes Still compatible with this version but if you use them in a folder (new feature) is recommended to update them
Implemented HTML Rich area (http://nicedit.com) (optional from the config.php)
Fixed bug categories latin chars
Fixed bug sometimes duplied categories
Replaced <? for <?php and <?= for <?php echo because of short_open_tag 

Changes in config.php:
Possible to specify a installation folder define('BASE','');
HTML Editor possible to deactivate define('HTML_EDITOR', true);
Possible to choos your charset (currently latin 1)

###############################################
V 1.0 (Stable)
Few Bugs
contact form, was not appearing the email from who was
Replaced the /n for 1 br in function cPH
Replaced € by html code
html_entity_decode in contact form
Ñ Ç on keypress Javascript
Category cloud with http://www.lotsofcode.com/demo/tag-cloud-v2/
Small changes in design
Share in facebook or by mail
Dynamic Privacy Policy generated with http://www.bennadel.com/coldfusion/privacy-policy-generator.htm
Search in categories aswell
Added ugly favicon wit OC
Added new Themes
Changed menu.php, now stores arrays in the cache no the entire html

###############################################
V 0.9 Beta
Image viewer http://www.dynamicdrive.com/dynamicindex4/thumbnail.htm
Fixed spelling mistakes in English file
Changed some links in footer.php
themes enabled, new var in config.php
bug in the categories description on add
RSS by category and type
Sitemap auto generated with expire date
404 redirected on htaccess
Error handler during execution with email sender
Price is not longer obligated
Report bad use or spam
New ad when is confirmed redirect to the ad
Fixed lot of bugs bugs
In admin new function to delete old ads that are not confirmed
Spanish language added
