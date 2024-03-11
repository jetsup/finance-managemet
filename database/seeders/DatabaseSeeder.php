<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountTypes;
use App\Models\BankAccounts;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\EmployeeTypes;
use App\Models\Genders;
use App\Models\TransactionTypes;
use App\Models\User;
use Database\Factories\EmployeeMessagesFactory;
use Database\Factories\EmployeesFactory;
use Database\Factories\EmployeePaymentsFactory;
use Database\Factories\UserFactory;
use Database\Factories\TransactionsFactory;
use Database\Factories\BudgetsFactory;
use Database\Factories\ComplainsFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// use Database\Seeders\Str;

class DatabaseSeeder extends Seeder
{
    // set this variable to `false` if you don't want to add dummy data to the database
    const SEED_DATA = true;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create account types
        $this->command->info('Creating account types.................');
        AccountTypes::create(['name' => 'Administrator', 'description' => 'Has full access to the system']);
        AccountTypes::create(['name' => 'Employee', 'description' => 'Constrained to the user account section with employee privileges']);
        AccountTypes::create(['name' => 'Student', 'description' => 'Constrained to the user account section with student privileges']);

        // create genders
        $this->command->info('Creating genders.................');
        Genders::create(['gender' => 'MALE']);
        Genders::create(['gender' => 'FEMALE']);
        Genders::create(['gender' => 'OTHER']);

        // create a default admin user
        $this->command->info('Creating default users.................');
        User::create([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'username' => "admin",
            'phone' => "0790909090",
            'gender_id' => 1,
            'email' => "admin@account.com",
            'email_verified_at' => now(),
            'password' => bcrypt("Admin123."),
            'account_type_id' => 1,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'first_name' => "User",
            'last_name' => "User",
            'username' => "user",
            'phone' => "0790909091",
            'gender_id' => 2,
            'email' => "user@account.com",
            'email_verified_at' => now(),
            'password' => bcrypt("User123."),
            'account_type_id' => 2,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'first_name' => "Student",
            'last_name' => "Student",
            'username' => "student",
            'phone' => "0790909092",
            'gender_id' => 1,
            'email' => "student@account.com",
            'email_verified_at' => now(),
            'password' => bcrypt("Student123."),
            'account_type_id' => 3,
            'remember_token' => Str::random(10)
        ]);
        // create other sample users from the UserFactory
        if(self::SEED_DATA) {
            $this->command->info('Creating dummy users.................');
            UserFactory::new()->count(10)->create();
        }

        // create employee types --sql
        $this->command->info('Creating employee categories.................');
        EmployeeTypes::create(['employee_type' => 'MANAGER']);
        EmployeeTypes::create(['employee_type' => 'BURSAR']);
        EmployeeTypes::create(['employee_type' => 'SECRETARY']);
        EmployeeTypes::create(['employee_type' => 'TEACHER']);
        EmployeeTypes::create(['employee_type' => 'LIBRARIAN']);
        EmployeeTypes::create(['employee_type' => 'LAB TECHNICIAN']);
        EmployeeTypes::create(['employee_type' => 'STORE KEEPER']);
        EmployeeTypes::create(['employee_type' => 'COOK']);
        EmployeeTypes::create(['employee_type' => 'DRIVER']);
        EmployeeTypes::create(['employee_type' => 'CLEANER']);
        EmployeeTypes::create(['employee_type' => 'SECURITY']);
        EmployeeTypes::create(['employee_type' => 'OTHER']);

        // create sample employees from the EmployeeFactory
        $this->command->info('Creating admin employee.................');
        Employees::create([
            "employee_number" => "AD123KAMBITI",
            "user_id" => 1,
            "employee_type_id" => 1,
            "department_id" => 1,
        ]);

        // create departments
        Departments::create(['name' => 'ADMINISTRATION', 'description' => 'Some description of the department', 'head_id' => 1]);
        Departments::create(['name' => 'ACADEMICS', 'description' => 'Some description of the department', 'head_id' => 1]);
        Departments::create(['name' => 'FINANCE', 'description' => 'Some description of the department', 'head_id' => 1]);
        Departments::create(['name' => 'HUMAN RESOURCE', 'description' => 'Some description of the department', 'head_id' => 1]);
        Departments::create(['name' => 'STUDENT AFFAIRS', 'description' => 'Some description of the department', 'head_id' => 1]);
        Departments::create(['name' => 'OTHER', 'description' => 'Some description of the department', 'head_id' => 1]);

        if(self::SEED_DATA) {
            $this->command->info('Creating dummy employees.................');
            EmployeesFactory::new()->count(11)->create();
        }

        // create sample bank accounts
        if(self::SEED_DATA) {
            $this->command->info('Creating bank accounts.................');
            BankAccounts::create(['account_number' => '2376453768', 'account_name' => 'KAMBITI SCHOOL', 'bank_name' => 'KCB BANK']);
            BankAccounts::create(['account_number' => '0704439347', 'account_name' => 'JETSUP TEST NUMBER', 'bank_name' => 'PROJECT CROSSING ALHA']);
            BankAccounts::create(['account_number' => '2345678901', 'account_name' => 'KLEANSLY CLEANERS', 'bank_name' => 'NCBA BANK']);
            BankAccounts::create(['account_number' => '1234567890', 'account_name' => 'ANESTAR SCHOOL', 'bank_name' => 'CO-OPERATIVE BANK']);
            BankAccounts::create(["account_number" => "3456789012", "account_name" => "THIKA BOYS", "bank_name" => "STANBIC BANK"]);
            BankAccounts::create(["account_number" => "4567890123", "account_name" => "NORO GIRLS", "bank_name" => "DTB BANK"]);
            BankAccounts::create(["account_number" => "5678901234", "account_name" => "NAKURU HIGH", "bank_name" => "BARCLAYS BANK"]);
            BankAccounts::create(["account_number" => "6789012345", "account_name" => "MANG'U HIGH", "bank_name" => "ABSA BANK"]);
            BankAccounts::create(["account_number" => "7890123456", "account_name" => "ALLIANCE BOYS", "bank_name" => "STANDARD CHARTERED BANK"]);
            BankAccounts::create(["account_number" => "8901234567", "account_name" => "ALLIANCE GIRLS", "bank_name" => "CFC BANK"]);
            BankAccounts::create(["account_number" => "9012345678", "account_name" => "MURANG'A BOYS", "bank_name" => "BANK OF AFRICA"]);
            BankAccounts::create(["account_number" => "0123456789", "account_name" => "TECHNOLOGY SCHOOL", "bank_name" => "BANK OF BARODA"]);
            BankAccounts::create(["account_number" => "0987654321", "account_name" => "MUMBAI ELEMENTARY", "bank_name" => "BANK OF INDIA"]);
            BankAccounts::create(["account_number" => "9876543210", "account_name" => "UNIVERSITY OF KIGALI", "bank_name" => "BANK OF KIGALI"]);
            BankAccounts::create(["account_number" => "8765432109", "account_name" => "TANZANIA ELITES", "bank_name" => "BANK OF TANZANIA"]);
            BankAccounts::create(["account_number" => "7654321098", "account_name" => "UGANDA HIGH", "bank_name" => "BANK OF UGANDA"]);
        }
        
        // create sample transaction types --sql
        $this->command->info('Creating transaction types.................');
        TransactionTypes::create(["transaction_type" => "INCOME"]);
        TransactionTypes::create(["transaction_type" => "EXPENSE"]);
        TransactionTypes::create(["transaction_type" => "OTHER"]);

        if(self::SEED_DATA) {
            // create sample transactions
            $this->command->info('Creating dummy transactions.................');
            TransactionsFactory::new()->count(1000)->create();
            // create sample payments
            $this->command->info('Creating dummy employee payments.................');
            EmployeePaymentsFactory::new()->count(100)->create();
            // create sample messages
            $this->command->info('Creating dummy messages.................');
            EmployeeMessagesFactory::new()->count(50)->create();
            // create sample budgets
            $this->command->info('Creating dummy budgets.................');
            BudgetsFactory::new()->count(100)->create();
            // create sample complains
            $this->command->info('Creating dummy complains.................');
            ComplainsFactory::new()->count(50)->create();
        }
    }
}
