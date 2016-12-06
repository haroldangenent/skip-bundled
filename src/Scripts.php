<?php
namespace Trendwerk\SkipBundled;

final class Scripts
{
    private $bundled;

    public function init()
    {
        add_filter('script_loader_src', [$this, 'skip'], 10, 2);
    }

    public function add($handle)
    {
        $this->bundled[] = $handle;
    }

    public function skip($src, $handle)
    {
        if (is_admin() || is_user_logged_in()) {
            return $src;
        }

        if (in_array($handle, $this->bundled)) {
            return false;
        }

        return $src;
    }
}
