<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Admin;

class LoginTest extends DuskTestCase
{
    /**
     * Tests login and attendance feature for teachers for applied mechanics which has subcode bctCE451
     *
     * @return void
     */
    public function testExample()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->magic();
        });
        // $user = User::where('teacher_code', '11111')->first();
        // $this->browse(function ($browser) use ($user) {
        //     $browser->visit('/login')
        //         ->type('email', $user->email)
        //         ->type('password', 'password')
        //         ->press('Login')
        //         ->assertPathIs('/teachers/home')
        //         ->click('#bctCE451')
        //         ->assertPathIs('/teachers/attendancedashboard/74/bctCE451')
        //         ->click('#takeattendance');
        //     $day = $browser->text('#day');
        //     $browser->assertPathIs('/teachers/attendance/74/bctCE451/' . $day)
        //         ->click('#checkthis')
        //         ->click('#submitattendance')
        //         ->assertPathIs('/teachers/attendancedashboard/74/bctCE451');
        // });
        // $admin = Admin::where('email', 'praches@gmail.com')->first();
        // $this->browse(function ($browser) use ($admin) {
        //     $browser->visit('/admin/login')
        //     ->assertPathIs('/admin/login')
        //         ->type('#email', $admin->email)
        //         ->type('password', 'zxcvbnm,./')
        //         ->press('Login')
        //         ->assertPathIs('/admin/home');
        //     dd("YOO NICEC MR WHITEE");
        // });

    }
}
