<?php
/**
 * Plugin Name:     Container
 * Description:     Example block written with ESNext standard and JSX support – build step required.
 * Version:         0.1.0
 * Author:          The WordPress Contributors
 * License:         GPL-2.0-or-later
 * Text Domain:     create-block
 */

/**
 * Registers block assets to be enqueued
 * @see https://git.io/JvPHi
 * @see https://git.io/JvPHy
 */
add_action('init', function () {
    $dir = dirname(__FILE__);

    if (!$manifestPath = realpath("{$dir}/build/index.asset.php")) {
        new WP_Error(
            'Missing manifest: "create-block/container"',
            "Run `npm build` in ${dir}"
        );
    }

    wp_register_script(
        'create-block-container-block-editor',
        plugins_url('build/index.js', __FILE__),
        ...array_values((array) require $manifestPath)
    );

    foreach (['editor', 'style'] as $asset) {
        wp_register_style(
            "create-block-container-block-{$asset}",
            plugins_url($asset, __FILE__)
        );
    }

    register_block_type('create-block/container', [
        'editor_script' => 'create-block-container-block-editor',
        'editor_style' => 'create-block-container-block-editor',
        'style' => 'create-block-container-block-style',
    ]);
});
