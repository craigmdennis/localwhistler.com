# Local Whistler Wordpress Theme

### A custom theme developed by [Simple Bit](http://simplebitdesign.com)

## Functions

All functions that normally appear in one `functions.php` file are now in the `/functions/` folder and only 'required' in the `functions.php` file. This is so we can keep everything organised.

All function files must be namespaced with `lw_*` so as to reduce the risk of conflict.

## Options
Coming soon

## Custom Post Types
Each custom post type must be in its own file and be initialised from that file.

All post_type files must be namespaced with `lw_post_type_*` to keep them organised and to maintain a consistent naming conventions.
