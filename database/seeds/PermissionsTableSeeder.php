<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'borrower_access',
            ],
            [
                'id'    => '18',
                'title' => 'asset_access',
            ],
            [
                'id'    => '19',
                'title' => 'loan_access',
            ],
            [
                'id'    => '20',
                'title' => 'payment_access',
            ],
            [
                'id'    => '21',
                'title' => 'messaging_access',
            ],
            [
                'id'    => '22',
                'title' => 'guarantor_create',
            ],
            [
                'id'    => '23',
                'title' => 'guarantor_edit',
            ],
            [
                'id'    => '24',
                'title' => 'guarantor_show',
            ],
            [
                'id'    => '25',
                'title' => 'guarantor_delete',
            ],
            [
                'id'    => '26',
                'title' => 'guarantor_access',
            ],
            [
                'id'    => '27',
                'title' => 'missed_payment_access',
            ],
            [
                'id'    => '28',
                'title' => 'active_loan_access',
            ],
            [
                'id'    => '29',
                'title' => 'inactive_loan_access',
            ],
            [
                'id'    => '30',
                'title' => 'dorman_loan_access',
            ],
            [
                'id'    => '31',
                'title' => 'branch_access',
            ],
            [
                'id'    => '32',
                'title' => 'target_access',
            ],
            [
                'id'    => '33',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '34',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '35',
                'title' => 'client_create',
            ],
            [
                'id'    => '36',
                'title' => 'client_edit',
            ],
            [
                'id'    => '37',
                'title' => 'client_show',
            ],
            [
                'id'    => '38',
                'title' => 'client_delete',
            ],
            [
                'id'    => '39',
                'title' => 'client_access',
            ],
            [
                'id'    => '40',
                'title' => 'fund_create',
            ],
            [
                'id'    => '41',
                'title' => 'fund_edit',
            ],
            [
                'id'    => '42',
                'title' => 'fund_show',
            ],
            [
                'id'    => '43',
                'title' => 'fund_delete',
            ],
            [
                'id'    => '44',
                'title' => 'fund_access',
            ],
            [
                'id'    => '45',
                'title' => 'product_create',
            ],
            [
                'id'    => '46',
                'title' => 'product_edit',
            ],
            [
                'id'    => '47',
                'title' => 'product_show',
            ],
            [
                'id'    => '48',
                'title' => 'product_delete',
            ],
            [
                'id'    => '49',
                'title' => 'product_access',
            ],
            [
                'id'    => '50',
                'title' => 'credit_create',
            ],
            [
                'id'    => '51',
                'title' => 'credit_edit',
            ],
            [
                'id'    => '52',
                'title' => 'credit_show',
            ],
            [
                'id'    => '53',
                'title' => 'credit_delete',
            ],
            [
                'id'    => '54',
                'title' => 'credit_access',
            ],
            [
                'id'    => '55',
                'title' => 'repayment_create',
            ],
            [
                'id'    => '56',
                'title' => 'repayment_edit',
            ],
            [
                'id'    => '57',
                'title' => 'repayment_show',
            ],
            [
                'id'    => '58',
                'title' => 'repayment_delete',
            ],
            [
                'id'    => '59',
                'title' => 'repayment_access',
            ],
            [
                'id'    => '60',
                'title' => 'location_create',
            ],
            [
                'id'    => '61',
                'title' => 'location_edit',
            ],
            [
                'id'    => '62',
                'title' => 'location_show',
            ],
            [
                'id'    => '63',
                'title' => 'location_delete',
            ],
            [
                'id'    => '64',
                'title' => 'location_access',
            ],
            [
                'id'    => '65',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
