<?php

namespace App\Service;

/**-----------------------------------
 *
 *----------------------------------*/
class Render extends Service
{
    public function __construct() {}

    /**
     *
     */
    public static function component(string $name, array $data = []): mixed
    {
        return get_template_part("view/component/{$name}.php", "{$name}", $data);
    }

    /**
     *
     */
    public static function layout(string $name): mixed
    {
        return include_once theme_dir() . "/view/layout/{$name}.php";
    }

    /**
     *
     */
    public static function view(): void
    {
        $header = theme_dir() . '/header.php';
        $footer = theme_dir() . '/footer.php';

        $file = self::resolve();

        if (!$file || !file_exists($file)) {
            $file = theme_dir() . '/view/page/404.php';
        }

        foreach ([$header, $file, $footer] as $f) {
            include_once $f;
        }
    }

    /**
     *
     */
    private static function resolve(): ?string
    {
        // トップページ
        if (is_front_page()) {
            return theme_dir() . '/view/page/index.php';
        }

        // 固定ページ
        if (is_page()) {
            return self::page();
        }

        // 投稿詳細
        if (is_single()) {
            return self::single();
        }

        // 投稿タイプアーカイブ
        if (is_post_type_archive()) {
            return self::archive();
        }

        // タクソノミー
        if (is_tax() || is_category() || is_tag()) {
            return self::tax();
        }

        return null;
    }

    /**
     *
     */
    private static function page(): ?string
    {
        global $post;

        if (!$post) {
            return null;
        }

        $base = theme_dir() . '/view/page/';
        $slugs = [];

        // 親ページを上から積む
        if ($ancestors = get_post_ancestors($post->ID)) {
            foreach (array_reverse($ancestors) as $ancestor) {
                $slugs[] = get_post($ancestor)->post_name;
            }
        }

        // 自分の slug
        $slugs[] = $post->post_name;

        // 1. 親/子/index.php
        $path = $base . implode('/', $slugs) . '/index.php';
        if (file_exists($path)) {
            return $path;
        }

        // 2. 親/子.php
        $path = $base . implode('/', $slugs) . '.php';
        if (file_exists($path)) {
            return $path;
        }

        // 3. 子/index.php
        $child = end($slugs);
        $path = $base . $child . '/index.php';
        if (file_exists($path)) {
            return $path;
        }

        // 4. 子.php
        $path = $base . $child . '.php';
        if (file_exists($path)) {
            return $path;
        }

        // 5. page/index.php
        $path = $base . 'index.php';
        if (file_exists($path)) {
            return $path;
        }

        // 6. page.php
        $path = theme_dir() . '/view/page.php';
        if (file_exists($path)) {
            return $path;
        }

        return null;
    }

    /**
     *
     */
    private static function archive(): ?string
    {
        $post_type = get_query_var('post_type');

        $path = theme_dir() . "/view/archive/{$post_type}.php";

        return file_exists($path) ? $path : null;
    }

    /**
     *
     */
    private static function single(): ?string
    {
        $post_type = get_post_type();

        $path = theme_dir() . "/view/single/{$post_type}.php";

        return file_exists($path) ? $path : null;
    }

    /**
     *
     */
    private static function tax(): ?string
    {
        $term = get_queried_object();

        // taxonomy 単位
        $path = theme_dir() . "/view/taxonomy/{$term->taxonomy}.php";
        if (file_exists($path)) {
            return $path;
        }

        // taxonomy + term
        $path = theme_dir() . "/view/taxonomy/{$term->taxonomy}/{$term->slug}.php";
        if (file_exists($path)) {
            return $path;
        }

        return null;
    }
}