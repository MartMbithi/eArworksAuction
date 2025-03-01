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


/* Load Composer Autoload */
require('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


/* Handle Bulk Staff Imports */
if (isset($_POST['Bulk_Import_Staffs'])) {
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    /* Avoid Names Duplication And Replacement */
    $temp_user_file = explode('.', $_FILES['file']['name']);
    $new_user_file = 'BULK_IMPORT_USERS' . (round(microtime(true)) . '.' . end($temp_user_file));

    /* Is File Extension Allowed */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $targetPath = "../public/uploads/users/xls_files/" . $new_user_file;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);


        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);


        for ($i = 1; $i <= $sheetCount; $i++) {

            $user_first_name  = "";
            if (isset($spreadSheetAry[$i][0])) {
                $user_first_name  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][0]);
            }

            $user_last_name  = "";
            if (isset($spreadSheetAry[$i][1])) {
                $user_last_name  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][1]);
            }

            $user_email   = "";
            if (isset($spreadSheetAry[$i][2])) {
                $user_email   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][2]);
            }

            $user_dob   = "";
            if (isset($spreadSheetAry[$i][3])) {
                $user_dob   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][3]);
            }

            $user_phone_number   = "";
            if (isset($spreadSheetAry[$i][4])) {
                $user_phone_number   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][4]);
            }

            $user_default_address   = "";
            if (isset($spreadSheetAry[$i][5])) {
                $user_default_address   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][5]);
            }

            /* Hidden Values That Cannot Be Posted Via XLS */
            $user_password  = sha1(md5(mysqli_real_escape_string($mysqli, 'Demo123@'))); /* ALL PASSWORDS ARE SET TO DEFAULT SYSTEM PASSWORD */
            $user_access_level = mysqli_real_escape_string($mysqli, 'Staff');


            /* Prevent Double Entries -  This may or not be triggered but the duplicate value will be skipped */
            $sql = "SELECT * FROM users  WHERE user_email ='{$user_email}'  ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($user_email == $row['user_email']  || $user_phone_number == $row['user_phone_number']) {
                    $err = 'User With This Email : ' . $user_email . ' Or This  ' . $user_phone_number . 'Phone Number Already Exists';
                }
            } else {
                if (!empty($user_email) || !empty($user_first_name) || !empty($user_phone_number)) {
                    /* Persist Bulk Imports If No Duplicates */
                    $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_password,  user_default_address, user_access_level)
                    VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_password}', '{$user_default_address}', '{$user_access_level}')";

                    /* Prepare */
                    if (mysqli_query($mysqli, $insert_sql)) {
                        $success = "Users data imported successfully";
                    } else {
                        $err = "Failed, please try again";
                    }
                }
            }
        }
        /* Delete This File */
        unlink($targetPath);
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}

/* Bulk Import Customers */
if (isset($_POST['Bulk_Import_Customers'])) {
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    /* Avoid Names Duplication And Replacement */
    $temp_user_file = explode('.', $_FILES['file']['name']);
    $new_user_file = 'BULK_IMPORT_USERS' . (round(microtime(true)) . '.' . end($temp_user_file));

    /* Is File Extension Allowed */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $targetPath = "../public/uploads/users/xls_files/" . $new_user_file;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);


        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);


        for ($i = 1; $i <= $sheetCount; $i++) {

            $user_first_name  = "";
            if (isset($spreadSheetAry[$i][0])) {
                $user_first_name  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][0]);
            }

            $user_last_name  = "";
            if (isset($spreadSheetAry[$i][1])) {
                $user_last_name  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][1]);
            }

            $user_email   = "";
            if (isset($spreadSheetAry[$i][2])) {
                $user_email   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][2]);
            }

            $user_dob   = "";
            if (isset($spreadSheetAry[$i][3])) {
                $user_dob   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][3]);
            }

            $user_phone_number   = "";
            if (isset($spreadSheetAry[$i][4])) {
                $user_phone_number   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][4]);
            }

            $user_default_address   = "";
            if (isset($spreadSheetAry[$i][5])) {
                $user_default_address   = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][5]);
            }

            /* Hidden Values That Cannot Be Posted Via XLS */
            $user_password  = sha1(md5(mysqli_real_escape_string($mysqli, 'Demo123@'))); /* ALL PASSWORDS ARE SET TO DEFAULT SYSTEM PASSWORD */
            $user_access_level = mysqli_real_escape_string($mysqli, 'Customer');


            /* Prevent Double Entries -  This may or not be triggered but the duplicate value will be skipped */
            $sql = "SELECT * FROM users  WHERE user_email ='{$user_email}'  ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($user_email == $row['user_email']  || $user_phone_number == $row['user_phone_number']) {
                    $err = 'User With This Email : ' . $user_email . ' Or This  ' . $user_phone_number . 'Phone Number Already Exists';
                }
            } else {
                if (!empty($user_email) || !empty($user_first_name) || !empty($user_phone_number)) {
                    /* Persist Bulk Imports If No Duplicates */
                    $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_password,  user_default_address, user_access_level)
                    VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_password}', '{$user_default_address}', '{$user_access_level}')";

                    /* Prepare */
                    if (mysqli_query($mysqli, $insert_sql)) {
                        $success = "Customers data imported successfully";
                    } else {
                        $err = "Failed, please try again";
                    }
                }
            }
        }
        /* Delete This File */
        unlink($targetPath);
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}

/* Bulk Import Product Categories */
if (isset($_POST['Bulk_Import_Product_Categories'])) {
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    /* Avoid Names Duplication And Replacement */
    $temp_file = explode('.', $_FILES['file']['name']);
    $new_category_file = 'BULK_IMPORT_CATEGORIES' . (round(microtime(true)) . '.' . end($temp_file));

    /* Is File Extension Allowed */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $targetPath = "../public/uploads/products/xls_files/" . $new_category_file;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);


        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);


        for ($i = 1; $i <= $sheetCount; $i++) {

            $category_name  = "";
            if (isset($spreadSheetAry[$i][0])) {
                $category_name  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][0]);
            }

            $category_details  = "";
            if (isset($spreadSheetAry[$i][1])) {
                $category_details  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][1]);
            }

            /* Hidden Values That Cannot Be Posted Via XLS */
            $category_code  = 'ART-' . substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, 4);


            /* Prevent Double Entries -  This may or not be triggered but the duplicate value will be skipped */
            $sql = "SELECT * FROM categories  WHERE category_name ='{$category_name}'  ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($category_name == $row['category_name']) {
                    $err = 'Category Name  Already Exists';
                }
            } else {
                if (!empty($category_name) || !empty($category_details) || !empty($category_code)) {
                    /* Persist Bulk Imports If No Duplicates */
                    $insert_sql = "INSERT INTO categories (category_code, category_name, category_details)
                    VALUES('{$category_code}', '{$category_name}', '{$category_details}')";

                    /* Prepare */
                    if (mysqli_query($mysqli, $insert_sql)) {
                        $success = "Product categories data imported successfully";
                    } else {
                        $err = "Failed, please try again";
                    }
                }
            }
        }
        /* Delete This File */
        unlink($targetPath);
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}

/* Bulk Import Products */
if (isset($_POST['Bulk_Import_Products'])) {
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    /* Avoid Names Duplication And Replacement */
    $temp_file = explode('.', $_FILES['file']['name']);
    $new_product_file = 'BULK_IMPORT_PRODUCTS' . (round(microtime(true)) . '.' . end($temp_file));

    /* Is File Extension Allowed */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $targetPath = "../public/uploads/products/xls_files/" . $new_product_file;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);


        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);


        for ($i = 1; $i <= $sheetCount; $i++) {

            $product_name  = "";
            if (isset($spreadSheetAry[$i][0])) {
                $product_name  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][0]);
            }
            
            $product_qty_in_stock  = "";
            if (isset($spreadSheetAry[$i][1])) {
                $product_qty_in_stock  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][1]);
            }

            $product_price  = "";
            if (isset($spreadSheetAry[$i][2])) {
                $product_price  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][2]);
            }

            $product_details  = "";
            if (isset($spreadSheetAry[$i][3])) {
                $product_details  = mysqli_real_escape_string($mysqli, $spreadSheetAry[$i][3]);
            }

            /* Hidden Values That Cannot Be Posted Via XLS */
            $product_sku_code  = 'PRD-' . date('dmY') . '-' . substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, 5);
            $product_category_id = mysqli_real_escape_string($mysqli, $_POST['product_category_id']);
            $product_seller_id = mysqli_real_escape_string($mysqli, $_POST['product_seller_id']);


            /* Prevent Double Entries -  This may or not be triggered but the duplicate value will be skipped */
            $sql = "SELECT * FROM products  WHERE product_sku_code ='{$product_sku_code}'  ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($product_sku_code == $row['product_sku_code']) {
                    $err = 'SKU code already exists';
                }
            } else {
                if (!empty($product_name) || !empty($product_details) || !empty($product_qty_in_stock) || !empty($product_price)) {
                    /* Persist Bulk Imports If No Duplicates */
                    $insert_sql = "INSERT INTO products (product_category_id, product_seller_id, product_sku_code, product_name, product_details, product_qty_in_stock, product_price)
                    VALUES('{$product_category_id}', '{$product_seller_id}', '{$product_sku_code}', '{$product_name}', '{$product_details}', '{$product_qty_in_stock}', '{$product_price}')";

                    /* Prepare */
                    if (mysqli_query($mysqli, $insert_sql)) {
                        $success = "Product data imported successfully";
                    } else {
                        $err = "Failed, please try again";
                    }
                }
            }
        }
        /* Delete This File */
        unlink($targetPath);
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}
