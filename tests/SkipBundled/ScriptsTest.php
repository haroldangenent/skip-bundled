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
}
