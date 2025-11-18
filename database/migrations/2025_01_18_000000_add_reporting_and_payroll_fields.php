<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportingAndPayrollFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name_prefix')) {
                $table->string('name_prefix', 20)->nullable()->after('name');
            }
        });

        Schema::table('payrolls', function (Blueprint $table) {
            if (!Schema::hasColumn('payrolls', 'pay_structure')) {
                $table->string('pay_structure', 20)->default('monthly')->after('employee_type');
            }

            if (!Schema::hasColumn('payrolls', 'daily_rate')) {
                $table->decimal('daily_rate', 12, 2)->nullable()->after('pay_structure');
            }

            if (!Schema::hasColumn('payrolls', 'hourly_rate')) {
                $table->decimal('hourly_rate', 12, 2)->nullable()->after('daily_rate');
            }
        });

        Schema::table('salary_payments', function (Blueprint $table) {
            if (!Schema::hasColumn('salary_payments', 'payment_date')) {
                $table->date('payment_date')->nullable()->after('payment_month');
            }

            if (!Schema::hasColumn('salary_payments', 'work_days')) {
                $table->integer('work_days')->nullable()->after('payment_date');
            }

            if (!Schema::hasColumn('salary_payments', 'work_hours')) {
                $table->decimal('work_hours', 8, 2)->nullable()->after('work_days');
            }

            if (!Schema::hasColumn('salary_payments', 'pay_basis')) {
                $table->string('pay_basis', 20)->nullable()->after('work_hours');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name_prefix')) {
                $table->dropColumn('name_prefix');
            }
        });

        Schema::table('payrolls', function (Blueprint $table) {
            $columns = ['pay_structure', 'daily_rate', 'hourly_rate'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('payrolls', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('salary_payments', function (Blueprint $table) {
            $columns = ['payment_date', 'work_days', 'work_hours', 'pay_basis'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('salary_payments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}


