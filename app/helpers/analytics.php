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



/* Customers */
$query = "SELECT COUNT(*)  FROM users WHERE user_access_level = 'Customer' AND user_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($customers);
$stmt->fetch();
$stmt->close();


/* Staffs */
$query = "SELECT COUNT(*)  FROM users WHERE (user_access_level = 'Staff' || user_access_level ='Administrator') AND user_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($staffs);
$stmt->fetch();
$stmt->close();

/* Products */
$query = "SELECT COUNT(*)  FROM products WHERE  product_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($products);
$stmt->fetch();
$stmt->close();

/* Overall Revenue */
$query = "SELECT SUM(payment_amount)  FROM payments WHERE  payment_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($payments);
$stmt->fetch();
$stmt->close();

/* Bids */
$query = "SELECT COUNT(*)  FROM bids WHERE bid_status = 'Pending'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($placed_bids);
$stmt->fetch();
$stmt->close();


/* Placed Orders */
$query = "SELECT COUNT(*)  FROM orders WHERE order_status = 'Placed Orders' AND  order_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($placed_orders);
$stmt->fetch();
$stmt->close();

/* Awaiting Fullfilment */
$query = "SELECT COUNT(*)  FROM orders WHERE order_status = 'Awaiting Fullfilment' AND  order_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($awaiting_fulfillment);
$stmt->fetch();
$stmt->close();


/* Shipped Orders */
$query = "SELECT COUNT(*)  FROM orders WHERE order_status = 'Shipped' AND  order_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($shipped);
$stmt->fetch();
$stmt->close();

/* Out For Delivery */
$query = "SELECT COUNT(*)  FROM orders WHERE order_status = 'Out For Delivery' AND  order_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($out_for_delivery);
$stmt->fetch();
$stmt->close();


/* Delivered Orders */
$query = "SELECT COUNT(*)  FROM orders WHERE order_status = 'Delivered' AND  order_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($delivered);
$stmt->fetch();
$stmt->close();

/* Returned Orders */
$query = "SELECT COUNT(*)  FROM orders WHERE order_status = 'Returned' AND  order_delete_status = '0'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($returned);
$stmt->fetch();
$stmt->close();
