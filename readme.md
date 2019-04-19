## CI STORE
Simple product catalog built with Codeigniter 3

*******************

### Additional Setup 

- `Development Config <https://github.com/arma7x/ci_store/blob/master/application/config/development/config.php#L4-L9>`_
- `Production Config <https://github.com/arma7x/ci_store/blob/master/application/config/production/config.php#L4-L9>`_
- `Demo Website <https://pwalitestore.herokuapp.com/>`_

*******************

### Demo Users

https://pwalitestore.herokuapp.com/authentication/ui_login

##### Admin
- Email: zeon_msi@yahoo.com
- Password: aaaaaaaaaa

##### Moderator
- Email: ahmadmuhamad101@gmail.com
- Password: aaaaaaaaaa

*******************

### PUBLIC REST API

##### /api/product/view/{product-slug-here}
##### /api/product/category
##### /api/product/spotlight
##### /api/product/search?keyword=&category=&ordering=&spotlight=&page=
- keyword(omissible) -> string
- ordering(omissible) -> created_at@desc | created_at@asc | price@desc | price@asc
- spotlight(omissible) -> 1 | 0
- category(omissible) -> id of /api/product/category
- page(omissible) -> integer

##### /api/other/general_information
##### /api/other/essential_information
##### /api/other/essential_information/{essential-information-slug-here}
##### /api/other/social_channel
##### /api/other/inbox_channel

*******************

### Server Requirements

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

**DO NOT USED PHP BUILT IN WEBSERVER**

************

### Installation

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.
************
