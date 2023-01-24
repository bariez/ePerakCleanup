<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'title-index' => 'Balance summary by ledger type',

    'table-header-bil' => 'No',
    'table-header-type' => 'Ledger Type',
    'table-header-sum' => 'Balance Summary',
    'table-header-bal' => 'Tax Balance',
    'table-header-unused' => 'Unearned Payment',
    'table-header-lej' => 'Ledger Balance',

    'table-income' => 'Income Tax',
    'table-ckht' => 'Real Property Gains Tax',

    'table-nocom' => 'No Company Information',
    'table-com' => 'Company Information',

    'table-record' => 'No Record',

    'note' => 'Note',
    'note-1' => '<b>1.  Tax Balance</b> = Total of Tax Outstanding / -Tax Payment Excess, after consider <b>Assessment & Others</b> and <b>Payment & Others</b> for the
same assessment year. This amount not yet consider payment, eligible tax increase or raised assessment after the date of ledger updated,
if any',
    'note-2' => '<b>2.  Unearned Payment</b> =  Tax payment such as Monthly Tax Deduction (MTD) payment/CP204 instalment payment. This payment will be
deducted with Tax Assessment when the assessment is raised/deemed',
    'note-3' => '<b>3.  Ledger Balance</b> =  Balance as at tax payer ledger include total amount of <b>Tax Balance<sup>1</sup></b> and <b>Unearned Payment<sup>2</sup></b>',


    'title-penutup' => 'Ledger Type',
    'title-calview' => 'Detailed ledger display by calendar year',
    'title-sum-current' => 'Balance summary by assessment year (Tax position as at',

    'table-penutup-col1' => 'Balance Summary',
    'table-penutup-col2' => 'Assessment<p style="margin-bottom:2px">Year</p>',
    'table-penutup-col3' => 'Assessment & <p style="margin-bottom:2px">Others',
    'table-penutup-col4' => 'Payment & <p style="margin-bottom:2px">Others',
    'table-penutup-col5' => 'Balance',
    'table-penutup-col6' => 'Unearned Payment',
    'table-penutup-col7' => 'Payment Excess /<p style="margin-bottom:2px"> Tax Balance',
    'table-penutup-total' => 'Total',

    'note-penutup-1' => '<b>1.  Assessment & Others</b> = Tax assessment /tax increase/refund/adjustment and others.<br>',
    'note-penutup-2' => '<b>2.  Payment & Others</b> = Tax payment/tax reduction/adjustment and others.<br>',
    'note-penutup-3' => '<b>3.  Balance</b> = Differences between <b>Assessment & Others<sup>1</sup></b> and <b>Payment & Others<sup>2</sup></b>.<br>',
    'note-penutup-4' => '<b>4.  Balance Summary</b> = Details position of <b>Balance<sup>3</sup></b> which consist <b>Unearned Payment<sup>5</sup></b> and /or <b>Payment Excess/Tax Balance<sup>6</sup></b>.<br>',
    'note-penutup-5' => '<b>5.  Unearned Payment</b> =  Tax payment such as Monthly Tax Deduction (MTD) payment/CP204 instalment payment. This payment will
be deducted with Tax Assessment when the assessment is raised/deemed.<br>',
    'note-penutup-6' => '<b>6.  Payment Excess/Tax Balance<sup>6</sup></b> = Total of Tax Outstanding / -Tax Payment Excess, after consider <b>Assessment & Others<sup>1</sup></b> and <b>Payment & Others<sup>2</sup></b> 2
for the same <br>assessment year. This amount not yet consider payment, eligible tax increase or raised assessment
after the date of ledger updated, if any.',

    'title-calendar' => 'Ledger Type',
    'title-calendar-year-1' => "Ledger",
    'title-calendar-year-2' => "for calendar year",
    'title-calendar-current' => '(Tax position as at',

    'table-calendar-col1' => 'Transaction<p style="margin-bottom:2px">Date</p>',
    'table-calendar-col2' => 'Code',
    'table-calendar-col3' => 'Transaction<p style="margin-bottom:2px">Description</p>',
    'table-calendar-col4' => 'Reference/<p style="margin-bottom:2px">Receipt No.</p>',
    'table-calendar-col5' => 'Assessment<p style="margin-bottom:2px">Year</p>',
    'table-calendar-col6' => 'Month/<p style="margin-bottom:2px">Installment No.</p>',
    'table-calendar-col7' => 'Assessment & <p style="margin-bottom:2px">Others<sup>1</sup></p>',
    'table-calendar-col8' => 'Payment & <p style="margin-bottom:2px">Others<sup>2</sup></p>',
    'table-calendar-col9' => 'Balance (RM)<sup>3</sup>',

    'table-calendar-col10' => 'Balance Summary',
    'table-calendar-col11-o' => 'Outstanding Tax Balance<sup>5</sup>',
    'table-calendar-col11-r' => 'Refundable Tax Balance<sup>5</sup>',
    'table-calendar-col12' => 'Unearned Payment<sup>6</sup>',
    'table-calendar-col13' => 'Ledger Balance ',

    'note-calendar-1' => '<b>1. Assessment & Others </b>= Tax assessment /tax increase/refund/adjustment and others.<br>',
    'note-calendar-2' => '<b>2. Payment & Others </b>= Tax payment/tax reduction/adjustment and others.<br>',
    'note-calendar-3' => '<b>3. Balance </b> = Differences between <b>Assessment & Others<sup>1</sup></b> and <b>Payment & Others<sup>2</sup>.</b><br>',
    'note-calendar-4' => '<b>4. Balance Summary </b> = Details position of <b>Balance<sup>3</sup></b> which consist <b>Unearned Payment<sup>5</sup></b> and /or <b>Tax Balance<sup>6</sup></b><br>',
    'note-calendar-5' => '<b>5. Tax Balance </b> = Total of Tax Outstanding / -Tax Payment Excess, after consider <b>Assessment & Others<sup>1</sup></b> and <b>Payment & Others<sup>2</sup></b> for the same assessment year.<br> This amount not yet consider payment, eligible tax increase or raised assessment after the date of ledger updated, if any.',
    'note-calendar-6' => '<b>6. Unearned Payment </b> = Tax payment such as Monthly Tax Deduction (MTD) payment/CP204 instalment payment. This payment will
be deducted with Tax Assessment when the assessment is raised/deemed.',


    'title-current' => 'Ledger Type',
    'title-current-year-1' => "Ledger",
    'title-current-year-2' => "for assessment year",
    'title-current-current' => '(Tax position as at',
    'table-current-col0' => 'Updated<p style="margin-bottom:2px">Date</p>',
    'table-current-col1' => 'Transaction<p style="margin-bottom:2px">Date</p>',
    'table-current-col2' => 'Code',
    'table-current-col3' => 'Transaction<p style="margin-bottom:2px">Description</p>',
    'table-current-col4' => 'Reference/<p style="margin-bottom:2px">Receipt No.</p>',
    'table-current-col5' => 'Assessment<p style="margin-bottom:2px">Year</p>',
    'table-current-col6' => 'Month/<p>Installment No.</p>',
    'table-current-col7' => 'Assessment & <p style="margin-bottom:2px">Others<sup>1</sup></p>',
    'table-current-col8' => 'Payment & <p style="margin-bottom:2px">Others<sup>2</sup></p>',
    'table-current-col9' => 'Balance (RM)<sup>3</sup>',

    'table-current-col10' => 'Balance Summary',
    'table-current-col11-o' => 'Outstanding Tax Balance<sup>5</sup>',
    'table-current-col11-r' => 'Refundable Tax Balance<sup>5</sup>',
    'table-current-col12' => 'Unearned Payment<sup>6</sup>',
    'table-current-col13' => 'Ledger Balance ',

    'note-current-1' => '<b>1. Assessment & Others </b>= Tax assessment /tax increase/refund/adjustment and others.<br>',
    'note-current-2' => '<b>2. Payment & Others </b>= Tax payment/tax reduction/adjustment and others.<br>',
    'note-current-3' => '<b>3. Balance </b> = Differences between <b>Assessment & Others<sup>1</sup></b> and <b>Payment & Others<sup>2</sup>.</b><br>',
    'note-current-4' => '<b>4. Balance Summary </b> = Details position of <b>Balance<sup>3</sup></b> which consist <b>Unearned Payment<sup>5</sup></b> and /or <b>Tax Balance<sup>6</sup></b><br>',
    'note-current-5' => '<b>5. Tax Balance </b> = Total of Tax Outstanding / -Tax Payment Excess, after consider <b>Assessment & Others<sup>1</sup></b> and <b>Payment & Others<sup>2</sup></b> for the same assessment year.<br> This amount not yet consider payment, eligible tax increase or raised assessment after the date of ledger updated, if any.',
    'note-current-6' => '<b>6. Unearned Payment </b> = Tax payment such as Monthly Tax Deduction (MTD) payment/CP204 instalment payment. This payment will
be deducted with Tax Assessment when the assessment is raised/deemed.',


    'comtable-col1' => 'Company Name',
    'comtable-col2' => 'File Type',
    'comtable-col3' => 'Reference No.',
    'comtable-col4' => 'ROC No.',
    'comtable-col5' => 'Date Of Registration',

    'com-penutup-label1' => 'Company Name',
    'com-penutup-label2' => 'Income Tax No.',
    'com-penutup-label3' => 'Ledger Type',
    'com-penutup-label4' => 'Assessment Branch',
    'com-penutup-label5' => 'Collection Branch',
    'com-penutup-label6' => 'Bank Name',
    'com-penutup-label7' => 'Account No.',

];
