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

$order_code = mysqli_real_escape_string($mysqli, $_GET['view']);
$order_sql = mysqli_query(
    $mysqli,
    "SELECT * FROM orders o  
    INNER JOIN products p ON p.product_id = o.order_product_id
    INNER JOIN users u ON u.user_id = o.order_user_id
    INNER JOIN categories c ON c.category_id = p.product_category_id
    WHERE u.user_delete_status = '0' 
    AND c.category_delete_status = '0'
    AND p.product_delete_status = '0'
    AND o.order_delete_status = '0' 
    AND o.order_code = '{$order_code}'
    GROUP BY o.order_code"
);
if (mysqli_num_rows($order_sql) > 0) {
    while ($order = mysqli_fetch_array($order_sql)) {
        /* Dump To PDF */
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
                eArtworks <br> Delivery Note For Order # ' . $order_code . '
            </h3>
        </div>
        <div class="list_header" align="left">
            <hr style="width:100%" , color=black>
            <h5>
                Consignee: ' . $order['user_first_name'] . ' ' . $order['user_last_name'] . ' <br>
                Order Date: ' . date('M d Y', strtotime($order['order_date'])) . ' <br>
                Delivery Address: ' . $order['user_default_address'] . '
            </h5>
        </div>
        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th style="width:10%">No</th>
                    <th style="width:100%">SKU</th>
                    <th style="width:100%">Product Name</th>
                    <th style="width:30%">Quantity</th>
                </tr>
            </thead>
        <tbody>
        ';
        $ret = "SELECT * FROM orders o  
            INNER JOIN products p ON p.product_id = o.order_product_id
            INNER JOIN users u ON u.user_id = o.order_user_id
            INNER JOIN categories c ON c.category_id = p.product_category_id
            WHERE u.user_delete_status = '0' 
            AND c.category_delete_status = '0'
            AND p.product_delete_status = '0'
            AND o.order_delete_status = '0'
            AND o.order_code = '{$order_code}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($items = $res->fetch_object()) {
            $html .=
                '
                <tr>
                    <td>' . $cnt . '</td>
                    <td>' . $items->product_sku_code . '</td>
                    <td>' . $items->product_name . '</td>
                    <td>' . $items->order_qty . '</td>
                </tr>
            ';
            $cnt = $cnt + 1;
        }
        $html .= '
            </tbody>
        </table>
        <br>
        <div align="left">
            <p>
                This is not a purchase invoice. It is the seller`s obligation to issue and deliver an invoice to 
                the client. It is the duty of the seller to establish if the price of the things sold is subject to VAT,
                custom charges, and other taxes. It is also the seller`s duty to pay any applicable VAT, custom duties,
                fees, or other taxes.
            </p>
        </div>
    ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Order Number' . $order_code . ' Delivery Note', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    }
}
