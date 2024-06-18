<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->fulltext('street');
            $table->fulltext('type');
            $table->fulltext('property_phase');
            $table->fulltext('house_no_or_name');
            $table->fulltext('no_bric_beds');
            $table->fulltext('no_bric_bathrooms');

        });

        Schema::table('developments', function (Blueprint $table) {
            $table->fulltext('development_status');
            $table->fulltext('existing_beds');
            $table->fulltext('existing_stories');
            $table->fulltext('bric_stories');
            $table->fulltext('bric_beds');
            $table->fulltext('project_start_date');
            $table->fulltext('projected_completion_date');
            $table->fulltext('over_running');
            $table->fulltext('pc_company');
            $table->fulltext('pc_name');
            $table->fulltext('pc_email');
            $table->fulltext('pc_mobile');
            $table->fulltext('bc_company');
            $table->fulltext('bc_name');
            $table->fulltext('bc_mobile');
            $table->fulltext('bc_email');
            $table->fulltext('overall_budget');
            $table->fulltext('actual_spend');
        });

        Schema::table('acquisitions', function (Blueprint $table) {
            $table->fulltext('acquisition_status');
            $table->fulltext('single_asset_portfolio');
            $table->fulltext('portfolio');
            $table->fulltext('existing_bedroom_no');
            $table->fulltext('asking_price');
            $table->fulltext('offer_price');
            $table->fulltext('agreed_purchase_price');
            $table->fulltext('difference');
            $table->fulltext('stamp_duty');
            $table->fulltext('acquisition_cost');
            $table->fulltext('agent');
            $table->fulltext('agent_fee');
            $table->fulltext('agent_fee_percentage');
            $table->fulltext('bridge_loan');
            $table->fulltext('estimated_period');
            $table->fulltext('loan_percentage');
            $table->fulltext('estimated_interest');
            $table->fulltext('estimated_tpc');
            $table->fulltext('offer_date');
            $table->fulltext('target_completion_date');
            $table->fulltext('completion_date');
            $table->fulltext('financing_status');
            $table->fulltext('capex_budget');
            $table->fulltext('bric_purchase_yield_percentage');
            $table->fulltext('tpc_bedspace');
            $table->fulltext('purchase_price_bedspace');
            $table->fulltext('bric_y1_proposed_rent_pppw');
            $table->fulltext('tenancy_length_weeks');
            $table->fulltext('tennure');
            $table->fulltext('ground_rent');
            $table->fulltext('ground_rent_due');
            $table->fulltext('bridge_loan_status');
            $table->fulltext('equity');
            
        });

        Schema::table('lettings', function (Blueprint $table) {
            $table->fulltext('version');
            $table->fulltext('property_contract_status');
            $table->fulltext('target_weekly_rent');
            $table->fulltext('achieved_weekly_rent');
            $table->fulltext('floorplan');
            $table->fulltext('date_of_refurb');
            // $table->fulltext('tv');
            // $table->fulltext('archive');
        });

        Schema::table('letting_statuses', function (Blueprint $table) {
            $table->fulltext('letting_status_name');
        });

        Schema::table('operation_utilities', function (Blueprint $table) {
            $table->fulltext('gas_provider');
            $table->fulltext('gas_contract_start_date');
            $table->fulltext('gas_contract_end_date');
            $table->fulltext('gas_account_number');
            $table->fulltext('electric_provider');
            $table->fulltext('electric_contract_start_date');
            $table->fulltext('electric_contract_end_date');
            $table->fulltext('electric_account_number');
            $table->fulltext('water_provider');
            $table->fulltext('water_account_number');

            $table->fulltext('tv_licence');
            $table->fulltext('tv_licence_contract_start_date');
            $table->fulltext('tv_licence_contract_end_date');
            $table->fulltext('broadband_provider');
            $table->fulltext('broadband_account_number');
            $table->fulltext('insurance_in_place');
            $table->fulltext('insurance_provider');
            $table->fulltext('insurance_annual_cost');
            $table->fulltext('insurance_start_date');
            $table->fulltext('insurance_end_date');

            $table->fulltext('insurance_policy_no');
            $table->fulltext('insurance_account_no');
            $table->fulltext('insurance_value');
            $table->fulltext('insurance_renewal_date');
            $table->fulltext('bills_received');
            $table->fulltext('exempt');
            $table->fulltext('exemption_date');
            $table->fulltext('council_account_no');
        });

        Schema::table('operation_insurances', function (Blueprint $table) {
            $table->fulltext('insurer');
            $table->fulltext('insurance_in_place');
            $table->fulltext('insurance_account_no');
            $table->fulltext('insurance_value');
            $table->fulltext('insurance_annual_cost');
            $table->fulltext('insurance_renewal_date');
        });

        Schema::table('operation_expenditures', function (Blueprint $table) {
            $table->fulltext('expenditure_year');
            $table->fulltext('hmo_licence_fee');
            $table->fulltext('hmo_licence_period');
            $table->fulltext('hmo_fee_per_year');
            $table->fulltext('maintenance_property_year');
            $table->fulltext('maintenance_bed_year');
            $table->fulltext('gas_property_year');
            $table->fulltext('gas_bed_year');
            $table->fulltext('electric_bed_year');
            $table->fulltext('water_property_year');

            $table->fulltext('water_bed_year');
            $table->fulltext('internet_property_year');
            $table->fulltext('internet_bed_year');
            $table->fulltext('tv_licence_per_house');
            $table->fulltext('property_insurance_annual_cost');
            $table->fulltext('total_opex_budget');

        });

        Schema::table('operation_budgets', function (Blueprint $table) {
            $table->fulltext('budget_year');
            $table->fulltext('hmo_licence_fee');
            $table->fulltext('hmo_licence_period');
            $table->fulltext('hmo_fee_per_year');
            $table->fulltext('maintenance_property_year');
            $table->fulltext('maintenance_bed_year');
            $table->fulltext('gas_property_year');
            $table->fulltext('gas_bed_year');
            $table->fulltext('electric_bed_year');
            $table->fulltext('water_property_year');

            $table->fulltext('water_bed_year');
            $table->fulltext('internet_property_year');
            $table->fulltext('internet_bed_year');
            $table->fulltext('tv_licence_per_house');
            $table->fulltext('property_insurance_annual_cost');
            $table->fulltext('total_opex_budget');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropfulltext(['street']);
            $table->dropfulltext(['type']);
            $table->dropfulltext(['property_phase']);
            $table->dropfulltext(['house_no_or_name']);
            $table->dropfulltext(['no_bric_beds']);
            $table->dropfulltext(['no_bric_bathrooms']);
        });

        Schema::table('developments', function (Blueprint $table) {
            $table->dropfulltext(['development_status']); 
            $table->dropfulltext(['existing_beds']); 
            $table->dropfulltext(['existing_stories']); 
            $table->dropfulltext(['bric_stories']); 
            $table->dropfulltext(['bric_beds']); 
            $table->dropfulltext(['project_start_date']); 
            $table->dropfulltext(['projected_completion_date']); 
            $table->dropfulltext(['over_running']); 
            $table->dropfulltext(['pc_company']); 
            $table->dropfulltext(['pc_name']); 
            $table->dropfulltext(['pc_email']); 
            $table->dropfulltext(['pc_mobile']); 
            $table->dropfulltext(['bc_company']); 
            $table->dropfulltext(['bc_name']); 
            $table->dropfulltext(['bc_mobile']); 
            $table->dropfulltext(['bc_email']); 
            $table->dropfulltext(['overall_budget']); 
            $table->dropfulltext(['actual_spend']); 
        });

        Schema::table('acquisitions', function (Blueprint $table) {
            $table->dropfulltext(['acquisition_status']);
            $table->dropfulltext(['single_asset_portfolio']);
            $table->dropfulltext(['portfolio']);
            $table->dropfulltext(['existing_bedroom_no']);
            $table->dropfulltext(['asking_price']);
            $table->dropfulltext(['offer_price']);
            $table->dropfulltext(['agreed_purchase_price']);
            $table->dropfulltext(['difference']);
            $table->dropfulltext(['stamp_duty']);
            $table->dropfulltext(['acquisition_cost']);
            $table->dropfulltext(['agent']);
            $table->dropfulltext(['agent_fee']);
            $table->dropfulltext(['agent_fee_percentage']);
            $table->dropfulltext(['bridge_loan']);
            $table->dropfulltext(['estimated_period']);
            $table->dropfulltext(['loan_percentage']);
            $table->dropfulltext(['estimated_interest']);
            $table->dropfulltext(['estimated_tpc']);
            $table->dropfulltext(['offer_date']);
            $table->dropfulltext(['target_completion_date']);
            $table->dropfulltext(['completion_date']);
            $table->dropfulltext(['financing_status']);
            $table->dropfulltext(['capex_budget']);
            $table->dropfulltext(['bric_purchase_yield_percentage']);
            $table->dropfulltext(['tpc_bedspace']);
            $table->dropfulltext(['purchase_price_bedspace']);
            $table->dropfulltext(['bric_y1_proposed_rent_pppw']);
            $table->dropfulltext(['tenancy_length_weeks']);
            $table->dropfulltext(['tennure']);
            $table->dropfulltext(['ground_rent']);
            $table->dropfulltext(['ground_rent_due']);
            $table->dropfulltext(['bridge_loan_status']);
            $table->dropfulltext(['equity']);
            
        });

        Schema::table('lettings', function (Blueprint $table) {
            $table->dropfulltext(['version']);
            $table->dropfulltext(['property_contract_status']);
            $table->dropfulltext(['target_weekly_rent']);
            $table->dropfulltext(['achieved_weekly_rent']);
            $table->dropfulltext(['floorplan']);
            $table->dropfulltext(['date_of_refurb']);
            // $table->dropfulltext(['tv']);
            // $table->dropfulltext(['archive']);
        });

        Schema::table('letting_statuses', function (Blueprint $table) {
            $table->dropfulltext(['letting_status_name']);
        });

        Schema::table('operation_utilities', function (Blueprint $table) {
            $table->dropfulltext(['gas_provider']);
            $table->dropfulltext(['gas_contract_start_date']);
            $table->dropfulltext(['gas_contract_end_date']);
            $table->dropfulltext(['gas_account_number']);
            $table->dropfulltext(['electric_provider']);
            $table->dropfulltext(['electric_contract_start_date']);
            $table->dropfulltext(['electric_contract_end_date']);
            $table->dropfulltext(['electric_account_number']);
            $table->dropfulltext(['water_provider']);
            $table->dropfulltext(['water_account_number']);

            $table->dropfulltext(['tv_license']);
            $table->dropfulltext(['tv_license_contract_start_date']);
            $table->dropfulltext(['tv_license_contract_end_date']);
            $table->dropfulltext(['broadband_provider']);
            $table->dropfulltext(['broadband_account_number']);
            $table->dropfulltext(['insurance_in_place']);
            $table->dropfulltext(['insurance_provider']);
            $table->dropfulltext(['insurance_annual_cost']);
            $table->dropfulltext(['insurance_start_date']);
            $table->dropfulltext(['insurance_end_date']);

            $table->dropfulltext(['insurance_policy_no']);
            $table->dropfulltext(['insurance_account_no']);
            $table->dropfulltext(['insurance_value']);
            $table->dropfulltext(['insurance_renewal_date']);
            $table->dropfulltext(['bills_received']);
            $table->dropfulltext(['exempt']);
            $table->dropfulltext(['exemption_date']);
            $table->dropfulltext(['council_account_no']);
        });

        Schema::table('operation_insurances', function (Blueprint $table) {
            $table->dropfulltext(['insurer']);
            $table->dropfulltext(['insurance_in_place']);
            $table->dropfulltext(['insurance_account_no']);
            $table->dropfulltext(['insurance_value']);
            $table->dropfulltext(['insurance_annual_cost']);
            $table->dropfulltext(['insurance_renewal_date']);
        });

        Schema::table('operation_expenditures', function (Blueprint $table) {
            $table->dropfulltext(['expenditure_year']);
            $table->dropfulltext(['hmo_license_fee']);
            $table->dropfulltext(['hmo_license_period']);
            $table->dropfulltext(['hmo_fee_per_year']);
            $table->dropfulltext(['maintenance_property_year']);
            $table->dropfulltext(['maintenance_bed_year']);
            $table->dropfulltext(['gas_property_year']);
            $table->dropfulltext(['gas_bed_year']);
            $table->dropfulltext(['electric_bed_year']);
            $table->dropfulltext(['water_property_year']);

            $table->dropfulltext(['water_bed_year']);
            $table->dropfulltext(['internet_property_year']);
            $table->dropfulltext(['internet_bed_year']);
            $table->dropfulltext(['tv_license_per_house']);
            $table->dropfulltext(['property_insurance_annual_cost']);
            $table->dropfulltext(['total_opex_budget']);

        });

        Schema::table('operation_budgets', function (Blueprint $table) {
            $table->dropfulltext(['budget_year']);
            $table->dropfulltext(['hmo_license_fee']);
            $table->dropfulltext(['hmo_license_period']);
            $table->dropfulltext(['hmo_fee_per_year']);
            $table->dropfulltext(['maintenance_property_year']);
            $table->dropfulltext(['maintenance_bed_year']);
            $table->dropfulltext(['gas_property_year']);
            $table->dropfulltext(['gas_bed_year']);
            $table->dropfulltext(['electric_bed_year']);
            $table->dropfulltext(['water_property_year']);

            $table->dropfulltext(['water_bed_year']);
            $table->dropfulltext(['internet_property_year']);
            $table->dropfulltext(['internet_bed_year']);
            $table->dropfulltext(['tv_license_per_house']);
            $table->dropfulltext(['property_insurance_annual_cost']);
            $table->dropfulltext(['total_opex_budget']);

        });
    }
}
