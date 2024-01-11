<?php

use function Pest\Laravel\get;

it('gives back succeful response for home page', function () {
    // Act & Assert
    get(route('home'))->assertOk();
});
