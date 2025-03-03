<?php
/*
 *   Crafted On Sat Mar 01 2025
 *   From his finger tips, through his IDE to your deployment environment at full throttle with no bugs, loss of data,
 *   fluctuations, signal interference, or doubt—it can only be
 *   the legendary coding wizard, Martin Mbithi (martin@devlan.co.ke, www.martmbithi.github.io)
 *   
 *   www.devlan.co.ke
 *   hello@devlan.co.ke
 *
 *
 *   The Devlan Solutions LTD Super Duper User License Agreement
 *   Copyright (c) 2022 Devlan Solutions LTD
 *
 *
 *   1. LICENSE TO BE AWESOME
 *   Congrats, you lucky human! Devlan Solutions LTD hereby bestows upon you the magical,
 *   revocable, personal, non-exclusive, and totally non-transferable right to install this epic system
 *   on not one, but TWO separate computers for your personal, non-commercial shenanigans.
 *   Unless, of course, you've leveled up with a commercial license from Devlan Solutions LTD.
 *   Sharing this software with others or letting them even peek at it? Nope, that's a big no-no.
 *   And don't even think about putting this on a network or letting a crowd join the fun unless you
 *   first scored a multi-user license from us. Sharing is caring, but rules are rules!
 *
 *   2. COPYRIGHT POWER-UP
 *   This Software is the prized possession of Devlan Solutions LTD and is shielded by copyright law
 *   and the forces of international copyright treaties. You better not try to hide or mess with
 *   any of our awesome proprietary notices, labels, or marks. Respect the swag!
 *
 *
 *   3. RESTRICTIONS, NO CHEAT CODES ALLOWED
 *   You may not, and you shall not let anyone else:
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or do any sneaky stuff to
 *   figure out the source code of this software;
 *   (b) modify, remix, distribute, or create your own funky version of this masterpiece;
 *   (c) copy (except for that one precious backup), distribute, show off in public, transmit, sell, rent,
 *   lease, or otherwise exploit the Software like it's your own.
 *
 *
 *   4. THE ENDGAME
 *   This License lasts until one of us says 'Game Over'. You can call it quits anytime by
 *   destroying the Software and all the copies you made (no hiding them under your bed).
 *   If you break any of these sacred rules, this License self-destructs, and you must obliterate
 *   every copy of the Software, no questions asked.
 *
 *
 *   5. NO GUARANTEES, JUST PIXELS
 *   DEVLAN SOLUTIONS LTD doesn’t guarantee this Software is flawless—it might have a few
 *   quirks, but who doesn’t? DEVLAN SOLUTIONS LTD washes its hands of any other warranties,
 *   implied or otherwise. That means no promises of perfect performance, marketability, or
 *   non-infringement. Some places have different rules, so you might have extra rights, but don’t
 *   count on us for backup if things go sideways. Use at your own risk, brave adventurer!
 *
 *
 *   6. SEVERABILITY—KEEP THE GOOD STUFF
 *   If any part of this License gets tossed out by a judge, don’t worry—the rest of the agreement
 *   still stands like a boss. Just because one piece fails doesn’t mean the whole thing crumbles.
 *
 *
 *   7. NO DAMAGE, NO DRAMA
 *   Under no circumstances will Devlan Solutions LTD or its squad be held responsible for any wild,
 *   indirect, or accidental chaos that might come from using this software—even if we warned you!
 *   And if you ever think you’ve got a claim, the most you’re getting out of us is the license fee you
 *   paid—if any. No drama, no big payouts, just pixels and code.
 *
 */

session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/codeGen.php');
require_once('../app/settings/checklogin.php');
checklogin();

/* Global Variables */
require_once('../vendor/autoload.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$type = mysqli_real_escape_string($mysqli, $_GET['type']);
$module = mysqli_real_escape_string($mysqli, $_GET['module']);


/* Staffs Reports */
if ($module == 'Staffs') {
    if ($type == 'PDF') {
        /* Get Staffs Reports In PDF */
        $html = '
        <style type="text/css">
            table {
                font-size: 12px;
                padding: 4px;
            }          

            th {
                text-align: left;
                padding: 4pt;
            }

            td {
                padding: 5pt;
            }

            #b_border {
                border-bottom: dashed thin;
            }

            legend {
                color: #0b77b7;
                font-size: 1.2em;
            }

            #error_msg {
                text-align: left;
                font-size: 11px;
                color: red;
            }

            .header {
                margin-bottom: 20px;
                width: 100%;
                text-align: left;
                position: absolute;
                top: 0px;
            }

            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                bottom: 5px;
            }

            #no_border_table {
                border: none;
            }

            #bold_row {
                font-weight: bold;
            }

            #amount {
                text-align: right;
                font-weight: bold;
            }

            .pagenum:before {
                content: counter(page);
            }

            /* Thick red border */
            hr.red {
                border: 1px solid red;
            }
            .list_header{
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            }
        </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Staffs Reports
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:10%">No</th>
                    <th style="width:100%">Full Names</th>
                    <th style="width:100%">Email</th>
                    <th style="width:100%">Phone</th>
                    <th style="width:100%">DOB</th>
                    <th style="width:100%">Access Level</th>
                </tr>
            </thead>
        <tbody>
        ';
        $cnt = 1;
        $user_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level != 'Customer'
        ORDER BY user_first_name ASC"
        );
        if (mysqli_num_rows($user_sql) > 0) {
            while ($staffs = mysqli_fetch_array($user_sql)) {
                $html .=
                    '
                <tr>
                    <td>' . $cnt . '</td>
                    <td>' . $staffs['user_first_name'] . ' ' . $staffs['user_last_name'] . '</td>
                    <td>' . $staffs['user_email'] . '</td>
                    <td>' . $staffs['user_phone_number'] . '</td>
                    <td>' . date('M d Y', strtotime($staffs['user_dob'])) . '</td>
                    <td>' . $staffs['user_access_level'] . '</td>
                </tr>
            ';
                $cnt = $cnt + 1;
            }
        }
        $html .= '
            </tbody>
        </table>
    ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Staff Reports ', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } else if ($type == 'CSV' && $module == 'Staffs') {

        /* Get Staffs Reports In CSV */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Staffs Reports.xls";

        /* Excel Column Name */
        $header = array("Staffs Reports");
        $fields = array('#', 'Full Names', 'Email', 'Phone', 'DOB', 'Access Level');

        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        $cnt = 1;
        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level != 'Customer'
        ORDER BY user_first_name ASC");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($cnt, $row['user_first_name'] . ' ' . $row['user_last_name'], $row['user_email'], $row['user_phone_number'], date('M d Y', strtotime($row['user_dob'])), $row['user_access_level']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
                $cnt = $cnt + 1;
            }
        } else {
            $excelData .= 'No Staffs Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;
        exit;
    } else {
        /* Load Error */
        $_SESSION['error'] = 'Please specify report type';
        header('Location: backoffice_reports');
        exit;
    }
}

/* Customers Reports */
if ($module == 'Customers') {
    if ($type == 'PDF') {
        /* Generate Customers Reports In PDF */
        $html = '
        <style type="text/css">
            table {
                font-size: 12px;
                padding: 4px;
            }          

            th {
                text-align: left;
                padding: 4pt;
            }

            td {
                padding: 5pt;
            }

            #b_border {
                border-bottom: dashed thin;
            }

            legend {
                color: #0b77b7;
                font-size: 1.2em;
            }

            #error_msg {
                text-align: left;
                font-size: 11px;
                color: red;
            }

            .header {
                margin-bottom: 20px;
                width: 100%;
                text-align: left;
                position: absolute;
                top: 0px;
            }

            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                bottom: 5px;
            }

            #no_border_table {
                border: none;
            }

            #bold_row {
                font-weight: bold;
            }

            #amount {
                text-align: right;
                font-weight: bold;
            }

            .pagenum:before {
                content: counter(page);
            }

            /* Thick red border */
            hr.red {
                border: 1px solid red;
            }
            .list_header{
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            }
        </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Customers Reports
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:10%">No</th>
                    <th style="width:100%">Full Names</th>
                    <th style="width:100%">Email</th>
                    <th style="width:100%">Phone</th>
                    <th style="width:100%">DOB</th>
                    <th style="width:100%">Date Joined</th>
                </tr>
            </thead>
        <tbody>
        ';
        $cnt = 1;
        $user_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level = 'Customer'
        ORDER BY user_first_name ASC"
        );
        if (mysqli_num_rows($user_sql) > 0) {
            while ($customers = mysqli_fetch_array($user_sql)) {
                $html .=
                    '
                <tr>
                    <td>' . $cnt . '</td>
                    <td>' . $customers['user_first_name'] . ' ' . $customers['user_last_name'] . '</td>
                    <td>' . $customers['user_email'] . '</td>
                    <td>' . $customers['user_phone_number'] . '</td>
                    <td>' . date('M d Y', strtotime($customers['user_dob'])) . '</td>
                    <td>' . date('M d Y', strtotime($customers['user_date_joined'])) . '</td>
                </tr>
            ';
                $cnt = $cnt + 1;
            }
        }
        $html .= '
            </tbody>
        </table>
    ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Customers Reports ', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($type == 'CSV') {
        /* Generate Customers Reports In XLS / CSV */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) {
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
        }

        /* Excel File Name */
        $fileName = "Customers Reports.xls";

        /* Excel Column Name */
        $header = array("Customers Reports");
        $fields = array('#', 'Full Names', 'Email', 'Phone', 'DOB', 'Date Registered');

        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        $cnt = 1;
        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level = 'Customer'
        ORDER BY user_first_name ASC");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($cnt, $row['user_first_name'] . ' ' . $row['user_last_name'], $row['user_email'], $row['user_phone_number'], date('M d Y', strtotime($row['user_dob'])), date('M d Y', strtotime($row['user_date_joined'])));
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
                $cnt = $cnt + 1;
            }
        } else {
            $excelData .= 'No Customers Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;
        exit;
    } else {
        /* Load Error */
        $_SESSION['error'] = 'Please specify report type';
        header('Location: backoffice_reports');
        exit;
    }
}

/* Product Categories */
if ($module == 'Categories') {
    if ($type == 'PDF') {
        /* Generate Customers Reports In PDF */
        $html = '
        <style type="text/css">
            table {
                font-size: 12px;
                padding: 4px;
            }          

            th {
                text-align: left;
                padding: 4pt;
            }

            td {
                padding: 5pt;
            }

            #b_border {
                border-bottom: dashed thin;
            }

            legend {
                color: #0b77b7;
                font-size: 1.2em;
            }

            #error_msg {
                text-align: left;
                font-size: 11px;
                color: red;
            }

            .header {
                margin-bottom: 20px;
                width: 100%;
                text-align: left;
                position: absolute;
                top: 0px;
            }

            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                bottom: 5px;
            }

            #no_border_table {
                border: none;
            }

            #bold_row {
                font-weight: bold;
            }

            #amount {
                text-align: right;
                font-weight: bold;
            }

            .pagenum:before {
                content: counter(page);
            }

            /* Thick red border */
            hr.red {
                border: 1px solid red;
            }
            .list_header{
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            }
        </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Categories Reports
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:10%">No</th>
                    <th style="width:20%">Category Code</th>
                    <th style="width:30%">Category Name</th>
                    <th style="width:100%">Category Details</th>
                </tr>
            </thead>
        <tbody>
        ';
        $cnt = 1;
        $categories_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM categories WHERE category_delete_status = '0' ORDER BY category_name ASC"
        );
        if (mysqli_num_rows($categories_sql) > 0) {
            while ($categories = mysqli_fetch_array($categories_sql)) {
                $html .=
                    '
                <tr>
                    <td>' . $cnt . '</td>
                    <td>' . $categories['category_code'] . '</td>
                    <td>' . $categories['category_name'] . '</td>
                    <td>' . $categories['category_details'] . '</td>
                </tr>
            ';
                $cnt = $cnt + 1;
            }
        }
        $html .= '
            </tbody>
        </table>
    ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Categories Report ', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($type == 'CSV') {
        /* Generate Categories Reports In XLS / CSV */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) {
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
        }

        /* Excel File Name */
        $fileName = "Categories Reports.xls";

        /* Excel Column Name */
        $header = array("Categories Reports");
        $fields = array('#', 'Category Code', 'Category Name');

        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        $cnt = 1;
        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM categories WHERE category_delete_status = '0' ORDER BY category_name ASC");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($cnt, $row['category_code'], $row['category_name']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
                $cnt = $cnt + 1;
            }
        } else {
            $excelData .= 'No Categories Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;
        exit;
    } else {
        /* Load Error */
        $_SESSION['error'] = 'Please specify report type';
        header('Location: backoffice_reports');
        exit;
    }
}

/* Products Reports */
if ($module == 'Products') {
    if ($type == 'PDF') {
        /* Generate Customers Reports In PDF */
        $html = '
        <style type="text/css">
            table {
                font-size: 12px;
                padding: 4px;
            }          

            th {
                text-align: left;
                padding: 4pt;
            }

            td {
                padding: 5pt;
            }

            #b_border {
                border-bottom: dashed thin;
            }

            legend {
                color: #0b77b7;
                font-size: 1.2em;
            }

            #error_msg {
                text-align: left;
                font-size: 11px;
                color: red;
            }

            .header {
                margin-bottom: 20px;
                width: 100%;
                text-align: left;
                position: absolute;
                top: 0px;
            }

            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                bottom: 5px;
            }

            #no_border_table {
                border: none;
            }

            #bold_row {
                font-weight: bold;
            }

            #amount {
                text-align: right;
                font-weight: bold;
            }

            .pagenum:before {
                content: counter(page);
            }

            /* Thick red border */
            hr.red {
                border: 1px solid red;
            }
            .list_header{
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            }
        </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Products Reports
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:10%">No</th>
                    <th style="width:60%">SKU</th>
                    <th style="width:100%">Name</th>
                    <th style="width:20%">QTY</th>
                    <th style="width:50%">Seller</th>
                    <th style="width:50%">Price</th>
                </tr>
            </thead>
        <tbody>
        ';
        $cnt = 1;
        $products_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM products p
            INNER JOIN users u ON u.user_id = p.product_seller_id
            INNER JOIN categories c ON c.category_id = p.product_category_id
            WHERE u.user_delete_status = '0' 
            AND c.category_delete_status = '0'
            AND p.product_delete_status = '0'
            ORDER BY p.product_name ASC"
        );
        if (mysqli_num_rows($products_sql) > 0) {
            while ($products = mysqli_fetch_array($products_sql)) {
                $html .=
                    '
                <tr>
                    <td>' . $cnt . '</td>
                    <td>' . $products['product_sku_code'] . '</td>
                    <td>' . $products['product_name'] . '</td>
                    <td>' . $products['product_qty_in_stock'] . '</td>
                    <td>' . $products['user_first_name'] . ' ' . $products['user_last_name'] . '</td>
                    <td> Ksh ' . number_format($products['product_price'], 2) . '</td>
                </tr>
            ';
                $cnt = $cnt + 1;
            }
        }
        $html .= '
            </tbody>
        </table>
    ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Product Report ', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($type == 'CSV') {
        /* Generate Categories Reports In XLS / CSV */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) {
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
        }

        /* Excel File Name */
        $fileName = "Products Reports.xls";

        /* Excel Column Name */
        $header = array("Products Reports");
        $fields = array('#', 'SKU', 'Name', 'QTY', 'Price', 'Seller Contacts');

        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        $cnt = 1;
        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM products p
        INNER JOIN users u ON u.user_id = p.product_seller_id
        INNER JOIN categories c ON c.category_id = p.product_category_id
        WHERE u.user_delete_status = '0' 
        AND c.category_delete_status = '0'
        AND p.product_delete_status = '0'
        ORDER BY p.product_name ASC");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($cnt, $row['product_sku_code'], $row['product_name'], $row['product_qty_in_stock'], $row['product_price'], $row['user_phone_number']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
                $cnt = $cnt + 1;
            }
        } else {
            $excelData .= 'No Product Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;
        exit;
    } else {
        /* Load Error */
        $_SESSION['error'] = 'Please specify report type';
        header('Location: backoffice_reports');
        exit;
    }
}

/* Orders */
if (isset($_POST['Generate_Order_Reports'])) {
    if ($module == 'Orders') {
        /* Filter Values */
        $start = mysqli_real_escape_string($mysqli, $_POST['start_date']);
        $end = mysqli_real_escape_string($mysqli, $_POST['end_date']);


        if ($type == 'PDF') {
            /* Generate Customers Reports In PDF */
            $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }          

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Orders Reports From Date ' . date('d M Y', strtotime($start)) . ' To ' . date('d M Y', strtotime($end)) . '
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:60%">Order #</th>
                    <th style="width:100%">Products</th>
                    <th style="width:60%">Order Date</th>
                    <th style="width:50%">Status</th>
                    <th style="width:100%">Customer</th>
                    <th style="width:20%">QTY</th>
                    <th style="width:80%">Order Cost</th>
                </tr>
            </thead>
        <tbody>
        ';
            $cnt = 1;
            $orders_sql = mysqli_query(
                $mysqli,
                "SELECT * FROM orders o
                INNER JOIN products p ON p.product_id = o.order_product_id
                INNER JOIN users u ON u.user_id = o.order_user_id
                WHERE o.order_delete_status = '0'
                AND o.order_date BETWEEN '{$start}' AND '{$end}'
                ORDER BY o.order_date ASC "
            );
            if (mysqli_num_rows($orders_sql) > 0) {
                while ($orders = mysqli_fetch_array($orders_sql)) {
                    $html .=
                        '
                            <tr>
                                <td>' . $orders['order_code'] . '</td>
                                <td>' . $orders['product_name'] . '</td>
                                <td>' . date('d M Y', strtotime($orders['order_date'])) . '</td>
                                <td>' . $orders['order_status'] . '</td>
                                <td>' . $orders['user_first_name'] . ' ' . $orders['user_last_name'] . '</td>
                                <td>' . $orders['order_qty'] . '</td>
                                <td> Ksh ' . number_format($orders['order_cost'], 2) . '</td>
                            </tr>
                        ';
                }
            } else {
                $html .=
                    '
                            <tr>
                                <td colspan="7" align="center">No Orders Available For This Duration</td>
                            </tr>
                        ';
            }
            $html .= '
            </tbody>
        </table>
        ';
            $dompdf->load_html($html);
            $dompdf->set_paper('A4');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->render();
            $dompdf->stream('Orders From ' . date('d M Y', strtotime($start)) . ' To ' . date('d M Y', strtotime($end)), array("Attachment" => 1));
            $options = $dompdf->getOptions();
            $options->setDefaultFont('');
            $dompdf->setOptions($options);
        } elseif ($type == 'CSV') {
            /* Load CSV Reports */
            /* Generate Categories Reports In XLS / CSV */
            function filterData(&$str)
            {
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if (strstr($str, '"')) {
                    $str = '"' . str_replace('"', '""', $str) . '"';
                }
            }

            /* Excel File Name */
            $fileName = "Order Reports.xls";

            /* Excel Column Name */
            $header = array("Order Reports");
            $fields = array('Order #', 'Products', 'Order Date', 'Status', 'Customer', 'QTY', 'Order Cost (Ksh)');

            /* Implode Excel Data */
            $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
            $excelData = implode("\t", array_values($fields)) . "\n";

            $cnt = 1;
            /* Fetch All Records From The Database */
            $query = $mysqli->query("SELECT * FROM orders o
            INNER JOIN products p ON p.product_id = o.order_product_id
            INNER JOIN users u ON u.user_id = o.order_user_id
            WHERE o.order_delete_status = '0'
            AND o.order_date BETWEEN '{$start}' AND '{$end}'
            ORDER BY o.order_date ASC");
            if ($query->num_rows > 0) {
                /* Load All Fetched Rows */
                while ($row = $query->fetch_assoc()) {
                    $lineData = array(
                        $row['order_code'], $row['product_name'], date('d M Y', strtotime($row['order_date'])),
                        $row['order_status'], $row['user_first_name'] . ' ' . $row['user_last_name'], $row['order_qty'], $row['order_cost']
                    );
                    array_walk($lineData, 'filterData');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                    $cnt = $cnt + 1;
                }
            } else {
                $excelData .= 'No Orders Records Available...' . "\n";
            }

            /* Generate Header File Encordings For Download */
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$fileName\"");

            /* Render  Excel Data For Download */
            echo $excelDataHeader;
            echo $excelData;
            exit;
        } else {
            /* Load Error */
            $_SESSION['error'] = 'Please specify report type';
            header('Location: backoffice_reports');
            exit;
        }
    }
}

/* Payments */
if (isset($_POST['Generate_Payments_Reports'])) {
    if ($module == 'Payments') {
        /* Filter Values */
        $start = mysqli_real_escape_string($mysqli, $_POST['start_date']);
        $end = mysqli_real_escape_string($mysqli, $_POST['end_date']);


        if ($type == 'PDF') {
            /* Generate Customers Reports In PDF */
            $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }          

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Payments Reports From Date ' . date('d M Y', strtotime($start)) . ' To ' . date('d M Y', strtotime($end)) . '
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:100%">Order #</th>
                    <th style="width:100%">Payment Ref #</th>
                    <th style="width:100%">Payment Date</th>
                    <th style="width:100%">Payment Amount</th>
                </tr>
            </thead>
        <tbody>
        ';
            $cnt = 1;
            $payments_sql = mysqli_query(
                $mysqli,
                "SELECT * FROM payments
                WHERE payment_delete_status = '0'
                AND payment_date  BETWEEN '{$start}' AND '{$end}'
                ORDER BY payment_date ASC"
            );
            if (mysqli_num_rows($payments_sql) > 0) {
                while ($payments = mysqli_fetch_array($payments_sql)) {
                    $html .=
                        '
                            <tr>
                                <td>' . $payments['payment_order_code'] . '</td>
                                <td>' . $payments['payment_ref_code'] . '</td>
                                <td>' . date('d M Y g:ia', strtotime($payments['payment_date'])) . '</td>
                                <td> Ksh ' . number_format($payments['payment_amount'], 2) . '</td>
                            </tr>
                        ';
                }
            } else {
                $html .=
                    '
                            <tr>
                                <td colspan="4" align="center">No Payments Recorded  For This Duration</td>
                            </tr>
                        ';
            }
            $html .= '
            </tbody>
        </table>
        ';
            $dompdf->load_html($html);
            $dompdf->set_paper('A4');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->render();
            $dompdf->stream('Payment From ' . date('d M Y', strtotime($start)) . ' To ' . date('d M Y', strtotime($end)), array("Attachment" => 1));
            $options = $dompdf->getOptions();
            $options->setDefaultFont('');
            $dompdf->setOptions($options);
        } elseif ($type == 'CSV') {
            /* Load CSV Reports */
            function filterData(&$str)
            {
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if (strstr($str, '"')) {
                    $str = '"' . str_replace('"', '""', $str) . '"';
                }
            }

            /* Excel File Name */
            $fileName = "Payments Reports.xls";

            /* Excel Column Name */
            $header = array("Payments Reports");
            $fields = array('Order #', 'Payment Ref #', 'Payment Date', 'Payment Amount (Ksh)');

            /* Implode Excel Data */
            $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
            $excelData = implode("\t", array_values($fields)) . "\n";

            $cnt = 1;
            /* Fetch All Records From The Database */
            $query = $mysqli->query("SELECT * FROM payments
            WHERE payment_delete_status = '0'
            AND payment_date  BETWEEN '{$start}' AND '{$end}'
            ORDER BY payment_date ASC");
            if ($query->num_rows > 0) {
                /* Load All Fetched Rows */
                while ($row = $query->fetch_assoc()) {
                    $lineData = array(
                        $row['payment_order_code'], $row['payment_ref_code'], date('d M Y g:ia', strtotime($row['payment_date'])),
                        $row['payment_amount']
                    );
                    array_walk($lineData, 'filterData');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                    $cnt = $cnt + 1;
                }
            } else {
                $excelData .= 'No Payments Records Available...' . "\n";
            }

            /* Generate Header File Encordings For Download */
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$fileName\"");

            /* Render  Excel Data For Download */
            echo $excelDataHeader;
            echo $excelData;
            exit;
        } else {
            /* Load Error */
            $_SESSION['error'] = 'Please specify report type';
            header('Location: backoffice_reports');
            exit;
        }
    }
}


/* Sellers */
if ($module == 'Sellers') {
    if ($type == 'PDF') {
        /* Generate Customers Reports In PDF */
        $html = '
        <style type="text/css">
            table {
                font-size: 12px;
                padding: 4px;
            }          

            th {
                text-align: left;
                padding: 4pt;
            }

            td {
                padding: 5pt;
            }

            #b_border {
                border-bottom: dashed thin;
            }

            legend {
                color: #0b77b7;
                font-size: 1.2em;
            }

            #error_msg {
                text-align: left;
                font-size: 11px;
                color: red;
            }

            .header {
                margin-bottom: 20px;
                width: 100%;
                text-align: left;
                position: absolute;
                top: 0px;
            }

            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                bottom: 5px;
            }

            #no_border_table {
                border: none;
            }

            #bold_row {
                font-weight: bold;
            }

            #amount {
                text-align: right;
                font-weight: bold;
            }

            .pagenum:before {
                content: counter(page);
            }

            /* Thick red border */
            hr.red {
                border: 1px solid red;
            }
            .list_header{
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            }
        </style>
        <div class="list_header" align="center">
            <h3>
                eArtworks <br> Seller Reports
            </h3>
        </div>
        
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:10%">No</th>
                    <th style="width:100%">Full Names</th>
                    <th style="width:100%">Email</th>
                    <th style="width:100%">Phone</th>
                    <th style="width:100%">DOB</th>
                    <th style="width:100%">Date Joined</th>
                </tr>
            </thead>
        <tbody>
        ';
        $cnt = 1;
        $user_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level = 'Seller'
        ORDER BY user_first_name ASC"
        );
        if (mysqli_num_rows($user_sql) > 0) {
            while ($customers = mysqli_fetch_array($user_sql)) {
                $html .=
                    '
                <tr>
                    <td>' . $cnt . '</td>
                    <td>' . $customers['user_first_name'] . ' ' . $customers['user_last_name'] . '</td>
                    <td>' . $customers['user_email'] . '</td>
                    <td>' . $customers['user_phone_number'] . '</td>
                    <td>' . date('M d Y', strtotime($customers['user_dob'])) . '</td>
                    <td>' . date('M d Y', strtotime($customers['user_date_joined'])) . '</td>
                </tr>
            ';
                $cnt = $cnt + 1;
            }
        }
        $html .= '
            </tbody>
        </table>
    ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Customers Reports ', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($type == 'CSV') {
        /* Generate Customers Reports In XLS / CSV */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) {
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
        }

        /* Excel File Name */
        $fileName = "Seller Reports.xls";

        /* Excel Column Name */
        $header = array("Customers Reports");
        $fields = array('#', 'Full Names', 'Email', 'Phone', 'DOB', 'Date Registered');

        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        $cnt = 1;
        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM users WHERE user_delete_status = '0' AND user_access_level = 'Seller'
        ORDER BY user_first_name ASC");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($cnt, $row['user_first_name'] . ' ' . $row['user_last_name'], $row['user_email'], $row['user_phone_number'], date('M d Y', strtotime($row['user_dob'])), date('M d Y', strtotime($row['user_date_joined'])));
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
                $cnt = $cnt + 1;
            }
        } else {
            $excelData .= 'No Customers Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;
        exit;
    } else {
        /* Load Error */
        $_SESSION['error'] = 'Please specify report type';
        header('Location: backoffice_reports');
        exit;
    }
}
