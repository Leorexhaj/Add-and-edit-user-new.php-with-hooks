// First i create a custom field, say “Company Name” and show it on both Add/Update user screens.

function userMetaBirthdayForm(WP_User $user) {
?>
<h2>Birthday</h2>
    <table class="form-table">
        <tr>
            <th><label for="user_birthday">Birthday</label></th>
            <td>
                <input
                    type="date"
                    value="<?php echo esc_attr(get_user_meta($user->ID, 'birthday', true)); ?>"
                    name="user_birthday"
                    id="user_birthday"
                >
                <span class="description">Some description to the input</span>
            </td>
        </tr>
    </table>
<?php
}
add_action('show_user_profile', 'userMetaBirthdayForm'); // editing your own profile
add_action('edit_user_profile', 'userMetaBirthdayForm'); // editing another user
add_action('user_new_form', 'userMetaBirthdayForm'); // creating a new user
 
function userMetaBirthdaySave($userId) {
    if (!current_user_can('edit_user', $userId)) {
        return;
    }
 
    update_user_meta($userId, 'birthday', $_REQUEST['user_birthday']);
}
add_action('personal_options_update', 'userMetaBirthdaySave');
add_action('edit_user_profile_update', 'userMetaBirthdaySave');
add_action('user_register', 'userMetaBirthdaySave');

//Lastly we need to save the custom field in database.

function save_custom_user_profile_fields($user_id){
    # again do this only if you can
    if(!current_user_can('manage_options'))
        return false;
 
    # save my custom field
    update_user_meta($user_id, 'company', $_POST['company']);
}
add_action('user_register', 'save_custom_user_profile_fields');
add_action('profile_update', 'save_custom_user_profile_fields');
