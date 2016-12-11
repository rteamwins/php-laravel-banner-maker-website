<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Site settings.
        Schema::create('settings', function(Blueprint $table) {
            $table->string('name', 255);
            $table->string('setting', 255);
            $table->string('description', 400);
            $table->primary('name');
            $table->timestamps();
        });

        // Populate with initial settings.

        DB::table('settings')->insert(array(
            array('name'    =>    'adminname',
            'setting'    =>    'Terry Joudry',
            'description'    =>    'Admin Name'),
            array('name'    =>    'domain',
                'setting'    =>    'http://sadiesbannercreator.com',
                'description'    =>    'Website Main Domain URL (with http:// and NO trailing slash)'),
            array('name'    =>    'sitename',
                'setting'    =>    "Sadie's Banner Creator",
                'description'    =>    'Website Name'),
            array('name'    =>    'adminemail',
                'setting'    =>    'phpsitescripts@outlook.com',
                'description'    =>    'Admin Support Email'),
            array('name'    =>    'adminpaypal',
                'setting'    =>    'payments@pearlsofwealth.com',
                'description'    =>    'Admin Paypal Account'),
            array('name'    =>    'adminpayza',
                'setting'    =>    'payments@pearlsofwealth.com',
                'description'    =>    'Admin Payza Account'),
            array('name'    =>    'downlinemailhowoften',
                'setting'    =>    '24',
                'description'    =>    'Hours Between Mailing Downline'),
            array('name'    =>    'licenseprice',
                'setting'    =>    '9.99',
                'description'    =>    'License Price to Remove Banner Watermark'),
            array('name'    =>    'licensepriceinterval',
                'setting'    =>    'lifetime',
                'description'    =>    'How Often to Pay for License'),
            array('name'    =>    'licensecommission',
                'setting'    =>    '0.00',
                'description'    =>  'Commission for Referral Purchasing License'),
            array('name'    =>    'licensedlbsilverprice',
                'setting'    =>    '9.99',
                'description'    =>    'Price of Downline Builder Silver License'),
            array('name'    =>    'licensedlbsilverpriceinterval',
                'setting'    =>    'lifetime',
                'description'    =>    'How Often to Pay for Downline Builder Silver License'),
            array('name'    =>    'licensedlbsilvercommission',
                'setting'    =>    '0.00',
                'description'    =>  'Commission for Referral Purchasing Silver License'),
            array('name'    =>    'licensedlbgoldprice',
                'setting'    =>    '12.99',
                'description'    =>    'Price of Downline Builder Gold License'),
            array('name'    =>    'licensedlbgoldpriceinterval',
                'setting'    =>    'lifetime',
                'description'    =>    'How Often to Pay for Downline Builder Gold License'),
            array('name'    =>    'licensedlbgoldcommission',
                'setting'    =>    '0.00',
                'description'    =>  'Commission for Referral Purchasing Gold License'),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
