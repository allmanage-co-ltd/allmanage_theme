<?php
//パンくずリスト
function breadcrumb()
{

	global $post;
	$str = '';

	if (!is_home() && !is_front_page() && !is_page(array('application', 'maintenance')) && !is_admin()) { /* !is_admin は管理ページ以外という条件分岐 */

		$str .= '<div class="breadcrumb-list">';
		$str .= '<ul class="breadcrumb">';
		$str .= '<li><a href="' . home_url() . '/">TOP</a></li>';

		if (is_search()) {

			$str .= '<li>「' . get_search_query() . '」で検索した結果</li>';
		} elseif (is_tag()) {

			$str .= '<li>タグ : ' . single_tag_title('', false) . '</li>';
		} elseif (is_404()) {

			$str .= '<li>404 Not found</li>';
		} elseif (is_date()) {

			if (get_query_var('day') != 0) {

				$str .= '<li><a href="' . get_year_link(get_query_var('year')) . '">' . get_query_var('year') . '年</a></li>';
				$str .= '<li><a href="' . get_month_link(get_query_var('year'), get_query_var('monthnum')) . '">' . get_query_var('monthnum') . '月</a></li>';
				$str .= '<li>' . get_query_var('day') . '日</li>';
			} elseif (get_query_var('monthnum') != 0) {

				$str .= '<li><a href="' . get_year_link(get_query_var('year')) . '">' . get_query_var('year') . '年</a></li>';
				$str .= '<li>' . get_query_var('monthnum') . '月</li>';
			} else {

				$str .= '<li>' . get_query_var('year') . '年</li>';
			}
		} elseif (is_category()) {

			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			if ($cat->parent != 0) {
				$ancestors = array_reverse(get_ancestors($cat->term_id, 'category'));
				$cat_id = $ancestors[0];
			}
			$str .= '<li>' . get_cat_name($cat_id) . '</li>';
		} elseif (is_author()) {

			$str .= '<li>投稿者 : ' . get_the_author_meta('display_name', get_query_var('author')) . '</li>';
		} elseif (is_page()) {

			if ($post->post_parent != 0) {
				$ancestors = array_reverse(get_post_ancestors($post->ID));
				foreach ($ancestors as $ancestor) {
					$str .= '<li>></li><li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
				}
			}
			$str .= '<li>></li><li>' . $post->post_title . '</li>';
		} elseif (is_attachment()) {

			if ($post->post_parent != 0) {
				$str .= '<li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>';
			}
			$str .= '<li>' . $post->post_title . '</li>';
		} elseif (is_single()) {

			if (is_singular('post')) {

				$categories = get_the_category($post->ID);

				if (!empty($categories)) {

					$cat = $categories[0];
					if ($cat->parent != 0) {
						$ancestors = (is_singular('post')) ? array_reverse(get_ancestors($cat->cat_ID, 'category')) : array_reverse(get_ancestors($cat->term_id, $term));
						/*foreach($ancestors as $ancestor){
											$str.='<li><a href="'. get_term_link($ancestor,$cat->taxonomy).'">'. get_cat_name($ancestor). '</a></li>';
									}*/
						$cat = get_category($ancestors[0], false);
					}
					$str .= '<li>></li><li><a href="' . home() . 'news">' . $cat->name . '</a></li>';
				}
			} else {
				$obj = get_post_type_object(get_post_type());
				$str .= '<li>></li><li><a href="' . home() . 'news">' . $obj->label . '</a></li>';
			}
			$str .= '<li>></li><li>' . $post->post_title . '</li>';
		} elseif (is_tax()) {

			global $wp_query;
			$taxonomy = get_taxonomy(get_query_var('taxonomy'));
			$post_type = $taxonomy->object_type[0];
			$cat = get_queried_object();
			if (empty($cat->term_id)) {
				$cat_name = $cat->label;
				$str .= '<li>' . $cat_name . '</li>';
			} else {
				$cat_name = $cat->name;
				$obj = get_post_type_object($post_type);
				$str .= '<li><a href="' . get_post_type_archive_link($post_type) . '">' . $obj->label . '</a></li>';
				if ($cat->parent != 0) {
					$ancestors = array_reverse(get_ancestors($cat->term_id, $cat->taxonomy));
					foreach ($ancestors as $ancestor) {
						if (get_cat_name($ancestor) !== $obj->label) {
							$str .= '<li><a href="' . get_term_link($ancestor, $cat->taxonomy) . '">' . get_cat_name($ancestor) . '</a></li>';
						}
					}
				}
				$str .= '<li>' . $cat_name . '</li>';
			}
		} elseif (is_archive()) {

			$cat = get_queried_object();
			if (empty($cat->term_id)) {
				$cat_name = $cat->label;
				$str .= '<li>' . $cat_name . '</li>';
			} else {
				$cat_name = $cat->name;
				$obj = get_post_type_object($post->post_type);
				$str .= '<li><a href="' . get_post_type_archive_link($post->post_type) . '">' . $obj->label . '</a></li>';
				if ($cat->parent != 0) {
					$ancestors = array_reverse(get_ancestors($cat->term_id, $cat->taxonomy));
					foreach ($ancestors as $ancestor) {
						if (get_cat_name($ancestor) !== $obj->label) {
							$str .= '<li><a href="' . get_term_link($ancestor, $cat->taxonomy) . '">' . get_cat_name($ancestor) . '</a></li>';
						}
					}
				}
				$str .= '<li>' . $cat_name . '</li>';
			}
		} else {

			$str .= '<li>' . wp_title('', false) . '</li>';
		}

		$str .= '</ul></div>';
	}

	echo $str;
}