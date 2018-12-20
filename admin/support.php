<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<style type="text/css">.levelup-query-success{color: #006600;}.levelup-query-error{color: #bf3322;}.levelup_hide{display: none;}</style>
<div class="levelup_support_div">
    <h2>Passionate Developers are here to serve you!</h2>
    <p><?php echo esc_html__('If you have any query, please write the query in below box or email us at', LEVELUP_TEXT_DOMAIN) ?> <a href="mailto:team@magazine3.com">team@magazine3.com</a>. <?php echo esc_html__('We will reply to your email address shortly', LEVELUP_TEXT_DOMAIN) ?></p>

    <ul>
        <li>
            <textarea rows="5" cols="60" id="levelup_query_message" name="levelup_query_message"> </textarea>
            <br>
            <span class="levelup-query-success levelup_hide"><?php echo esc_html__('Message sent successfully, Please wait we will get back to you shortly', LEVELUP_TEXT_DOMAIN); ?></span>
            <span class="levelup-query-error levelup_hide"><?php echo esc_html__('Message not sent. please check your network connection', LEVELUP_TEXT_DOMAIN); ?></span>
        </li> 
        <li><button class="button levelup-send-query"><?php echo esc_html__('Send Message', LEVELUP_TEXT_DOMAIN); ?></button></li>
    </ul>            
           
</div>