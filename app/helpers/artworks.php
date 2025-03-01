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


/* ---------------------------- Categories Helpers -------------------------------------------------------- */

/* Add Category */
if (isset($_POST['Register_New_Category'])) {
    $category_code  = 'ART-' . substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, 4);
    $category_name = mysqli_real_escape_string($mysqli, $_POST['category_name']);
    $category_details = mysqli_real_escape_string($mysqli, $_POST['category_details']);

    /* Prevent Double Entries */
    $sql = "SELECT * FROM categories  WHERE category_name ='{$category_name}'  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($category_name == $row['category_name']) {
            $err = 'Category Name  Already Exists';
        }
    } else {
        /* Persist */
        $sql = "INSERT INTO categories (category_code, category_name, category_details)
        VALUES('{$category_code}', '{$category_name}', '{$category_details}')";

        if (mysqli_query($mysqli, $sql)) {
            $success = "Category added";
        } else {
            $err = "Failed, try again";
        }
    }
}

/* Update Category */
if (isset($_POST['Update_Product_Category'])) {
    $category_id = mysqli_real_escape_string($mysqli, $_POST['category_id']);
    $category_name = mysqli_real_escape_string($mysqli, $_POST['category_name']);
    $category_details = mysqli_real_escape_string($mysqli, $_POST['category_details']);

    /* Persist */
    $sql = "UPDATE categories SET category_name = '{$category_name}', category_details = '{$category_details}' WHERE category_id = '{$category_id}'";
    if (mysqli_query($mysqli, $sql)) {
        $success = "Category updated";
    } else {
        $err = "Failed, try again";
    }
}


/* Delete Category */
if (isset($_POST['Delete_Product_Category'])) {
    $category_id = mysqli_real_escape_string($mysqli, $_POST['category_id']);
    $category_delete_status = mysqli_real_escape_string($mysqli, '1');

    /* Persist*/
    $sql = "UPDATE categories SET category_delete_status = '{$category_delete_status}' WHERE category_id = '{$category_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Product category moved to trash";
    } else {
        $err = "Failed, try again later";
    }
}



/* ----------------------------- Product Helpers ------------------------------------------------ */
/* Add Product */
if (isset($_POST['Register_New_Product'])) {
    $product_category_id = mysqli_real_escape_string($mysqli, $_POST['product_category_id']);
    $product_seller_id = mysqli_real_escape_string($mysqli, $_POST['product_seller_id']);
    $product_sku_code = mysqli_real_escape_string($mysqli, $_POST['product_sku_code']);
    $product_name = mysqli_real_escape_string($mysqli, $_POST['product_name']);
    $product_details = mysqli_real_escape_string($mysqli, $_POST['product_details']);
    $product_qty_in_stock = mysqli_real_escape_string($mysqli, $_POST['product_qty_in_stock']);
    $product_price = mysqli_real_escape_string($mysqli, $_POST['product_price']);
    $product_available_from = date('Y-m-d g:ia', strtotime(mysqli_real_escape_string($mysqli, $_POST['product_available_from'])));

    /* Process Product Image */
    $temp_product_image = explode('.', $_FILES['product_image']['name']);
    $new_product_image = $product_sku_code . '-' . (round(microtime(true)) . '.' . end($temp_product_image));
    move_uploaded_file(
        $_FILES['product_image']['tmp_name'],
        '../public/uploads/products/' . $new_product_image
    );

    /* Persist */
    $sql = "INSERT INTO products (product_category_id, product_seller_id, product_sku_code, product_name, product_details, product_qty_in_stock, product_price, product_image, product_available_from)
    VALUES('{$product_category_id}', '{$product_seller_id}', '{$product_sku_code}', '{$product_name}', '{$product_details}', '{$product_qty_in_stock}', '{$product_price}', '{$new_product_image}', '{$product_available_from}')";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Product added";
    } else {
        $err = "Failed, please try again";
    }
}

/* Update Product */
if (isset($_POST['Update_Product'])) {
    $product_id = mysqli_real_escape_string($mysqli, $_POST['product_id']);
    $product_category_id = mysqli_real_escape_string($mysqli, $_POST['product_category_id']);
    $product_seller_id = mysqli_real_escape_string($mysqli, $_POST['product_seller_id']);
    $product_sku_code = mysqli_real_escape_string($mysqli, $_POST['product_sku_code']);
    $product_name = mysqli_real_escape_string($mysqli, $_POST['product_name']);
    $product_details = mysqli_real_escape_string($mysqli, $_POST['product_details']);
    $product_qty_in_stock = mysqli_real_escape_string($mysqli, $_POST['product_qty_in_stock']);
    $product_price = mysqli_real_escape_string($mysqli, $_POST['product_price']);
    $product_available_from = date('Y-m-d g:ia', strtotime(mysqli_real_escape_string($mysqli, $_POST['product_available_from'])));


    /* Check If Posted Update Has Image */
    if (!empty($_FILES['product_image']['name'])) {
        /* Process Product Image */
        $temp_product_image = explode('.', $_FILES['product_image']['name']);
        $new_product_image = $product_sku_code . '-' . (round(microtime(true)) . '.' . end($temp_product_image));
        move_uploaded_file(
            $_FILES['product_image']['tmp_name'],
            '../public/uploads/products/' . $new_product_image
        );

        /*Check If Product Had 
        Existing  Photo And If It
        Was There Delete It From Storage Then Replace With New One
        */
        $sql = "SELECT * FROM  products WHERE  product_id = '{$product_id}'";
        $res = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($res);
        if (!empty($row['product_image'])) {
            /* User Has Old Photo */
            $old_product_photo = $row['product_image'];
            $old_product_photo_location = '../public/uploads/products/' . $old_product_photo;
            /* Delete It */
            unlink($old_product_photo_location);
        }

        /* Persist */
        $sql = "UPDATE products SET product_category_id = '{$product_category_id}', product_seller_id = '{$product_seller_id}', product_sku_code= '{$product_sku_code}',
        product_name = '{$product_name}',product_details = '{$product_details}', product_qty_in_stock = '{$product_qty_in_stock}', product_price = '{$product_price}', product_image = '{$new_product_image}', product_available_from = '{$product_available_from}'
        WHERE product_id = '{$product_id}'";

        if (mysqli_query($mysqli, $sql)) {
            $success = "Product updated";
        } else {
            $err = "Failed, please try again";
        }
    } else {
        /* Persist Update Without affecting the image */
        $sql = "UPDATE products SET product_category_id = '{$product_category_id}', product_seller_id = '{$product_seller_id}', product_sku_code= '{$product_sku_code}',
        product_name = '{$product_name}',product_details = '{$product_details}', product_qty_in_stock = '{$product_qty_in_stock}', product_price = '{$product_price}', product_available_from = '{$product_available_from}'
        WHERE product_id = '{$product_id}'";

        if (mysqli_query($mysqli, $sql)) {
            $success = "Product updated";
        } else {
            $err = "Failed, please try again";
        }
    }
}

/* Delete Product */
if (isset($_POST['Delete_Product'])) {
    $product_id = mysqli_real_escape_string($mysqli, $_POST['product_id']);

    /* Persist */
    $sql = "UPDATE products SET product_delete_status = '1' WHERE product_id = '{$product_id}'";

    if (mysqli_query($mysqli, $sql)) {
        $success = "Product moved to recycle bin";
    } else {
        $err = "Failed please try again";
    }
}
