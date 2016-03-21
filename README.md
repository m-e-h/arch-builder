# arch-builder
Flexible WP archive pages
## *WIP*
Control the layout of Archives from the WordPress quick-edit box.

Most features of this plugin rely on the Hybrid Core library and should work with most [Hybrid themes](http://themehybrid.com/themes)

Actually, that's not true. **You'll need the [3.1  branch](https://github.com/justintadlock/hybrid-core/tree/3.1)**

If not using a Hybrid theme, the width classes should still work with most Underscores based themes.

### Things that will make this system work a lot better:
- A theme using [Hybrid Core 3.1  branch](https://github.com/justintadlock/hybrid-core/tree/3.1) *(required for everything but the 'width' setting)*
- [Simple Page Ordering](https://wordpress.org/plugins/simple-page-ordering/) plugin or something similar
- [CPT Archives](https://github.com/cedaro/cpt-archives) plugin *(not required but sure makes things nice)*


### Individually set each post's
#### component type
- cards
- tabs
- accordion

*Tabs and accordions will populate with `child-posts` of the designated `parent-post`*


#### width
- 25%
- 33%
- 50%
- 66%
- 75%
- 100%

#### excerpt type
- Excerpt
- Content
- Title Only

#### *and more to come...*

### Add post-types
```
add_filter( 'arch_add_post_types', 'my_arch_cpts' );

function my_arch_cpts() {
	$cpts = array( 'arch', 'portfolio', 'testimonials' );
    return $cpts;
}
```
### Use your own grid
```
function arch_width_options() {
	return array(
		'col-md-1'      => '1/12',
		'col-md-3'      => '1/4',
		'col-md-4'      => '1/3',
		'col-md-6'      => '1/2',
		'col-md-8'      => '2/3',
		'col-md-9'      => '3/4',
	);
}
```
