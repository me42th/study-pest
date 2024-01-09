<?php

it('gives back succeful response for home page',function(){
    $response = $this->get('/');
    $response->assertStatus(200);
});