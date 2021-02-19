<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginExample()
    {
        $user = User::where('user_role_id', config('constants.user_types.admin'))->first();
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit(route('dashboard'))
                    ->assertSee('Users');
        });
    }
}
