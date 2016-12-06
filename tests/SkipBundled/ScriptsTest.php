<?php
namespace Trendwerk\SkipBundled\Test;

use Trendwerk\SkipBundled\Scripts;

class ScriptsTest extends \WP_UnitTestCase
{
    public function testFilter()
    {
        $bundled = ['jquery', 'testHandle'];

        $scripts = new Scripts();
        $scripts->init();
        
        // Add bundled
        foreach ($bundled as $handle) {
            $scripts->add($handle);
        }

        // Test bundled
        foreach ($bundled as $handle) {
            $src = apply_filters('script_loader_src', 'testSrc', $handle);
            $this->assertFalse($src);
        }
    }

    public function testOutput()
    {
        $handle = 'testScript';
        $src = home_url('testSrc.js');

        // Enqueue fake script (like a plugin would)
        wp_enqueue_script($handle, $src);

        // Set this script as bundled
        $scripts = new Scripts();
        $scripts->init();
        $scripts->add($handle);

        // Test output
        ob_start();
        wp_print_scripts();
        $output = ob_get_clean();

        $this->assertNotContains($src, $output);
    }
}
