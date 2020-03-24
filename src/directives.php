<?php

use Illuminate\Support\Facades\Blade;

Blade::directive('mixin', function ($exp) {
    return <<<CODE
<?php
list(\$_mixName) = (fn(\$name) => [\$name])({$exp});
\$__data['_mixins'][\$_mixName.'-'.md5(__FILE__)] = function (\$_mix_data) use (&\$__data) { extract(array_replace(\$__data, \$_mix_data));
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
\$__data['_mixins'][\$_mixName.'-'.md5(__FILE__)](\$_mixData);
?>
CODE;
});
