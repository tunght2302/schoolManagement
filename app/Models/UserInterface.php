<?php

namespace App\Http\Models;

interface UserInterface
{
    public function store();
    public function update();
    public function destroy();
}
