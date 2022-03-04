<?php

// Në kodin e mëposhtem, ne shtojmë veprimin për të lidhur 'edit_user_profile' dhe krijojmë një fushë hyrëse në funksionin e kthimit të thirrjes.

add_action( 'edit_user_profile', 'wk_custom_user_profile_fields' );

function wk_custom_user_profile_fields( $user )
{
    echo '<h3 class="heading">Custom Fields</h3>';
    
    ?>
    
    <table class="form-table">
	<tr>
            <th><label for="contact">Contact</label></th>

	    <td><input type="text" class="input-text form-control" name="contact" id="contact" />
		        </td>

	</tr>
    </table>
    
    <?php
}

?>

<!-- Nëse dëshironi të shfaqni fushat e krijuara për të gjitha profilet, atëherë përdorni "show_user_profile" hook dhe shtojm veprim për të njëjtin funksion kthimi të thirrjes. -->
<?php

add_action( 'show_user_profile', 'wk_custom_user_profile_fields' );

?>

<?php

add_action( 'edit_user_profile_update', 'wk_save_custom_user_profile_fields' );


function wk_save_custom_user_profile_fields( $user_id )
{
		
    $custom_data = $_POST['contact'];
    update_user_meta( $user_id, 'contact', $custom_data );

}

?>
<!-- Pas ekzekutimit të kodit të mësipërm, fusha e personalizuar do të shfaqet në faqen e redaktimit të profilit të përdoruesit -->