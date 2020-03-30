<?php

use Illuminate\Support\Facades\Blade;

Blade::directive('mixin', function ($exp) {
    return <<<CODE
<?php
list(\$_mixName) = (fn(\$name) => [\$name])({$exp});
\$_mixins[\$_mixName.'-'.md5(__FILE__)] = function (\$_mixData) use (&\$_mixins) { extract(\$_mixData, EXTR_SKIP);
?>
CODE;
});

Blade::directive('endmixin', function () {
    return <<<CODE
<?php
};
?>
CODE;
});

Blade::directive('plus', function ($exp) {
    return <<<CODE
<?php
list(\$_mixName, \$_mixData) = (fn(\$name, array \$data = []) => [\$name, \$data])({$exp});
\$_mixData = array_replace(get_defined_vars(), \$_mixData);
\$_mixins[\$_mixName.'-'.md5(__FILE__)](\$_mixData);
?>
CODE;
});
