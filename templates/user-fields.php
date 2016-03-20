<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/20/2016
 * Time: 2:26 PM
 */
?>

<h3>Extra profile information</h3>

    <table class="form-table">
        <?php if((is_object($user) && in_array('parent', $user->roles)) || (is_object($user) && in_array('administrator', $user->roles)) || !is_object($user)) {

    /**
     * Parents Fields
     */
    ?>
    <tr class="ta-table-phone">
        <th><label for="phone">Phone</label></th>

        <td>
            <input type="text" name="phone" id="phone"
                   value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('phone', $user->ID)) : ''; ?>"
                   class="regular-text"/><br/>
            <span class="description">Please enter the phone.</span>
        </td>
    </tr>
    <tr class="ta-table-cnp">
        <th><label for="cnp">CNP</label></th>

        <td>
            <input type="text" name="cnp" id="cnp"
                   value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('cnp', $user->ID)) : ''; ?>"
                   class="regular-text"/><br/>
            <span class="description">Please enter the parent's CNP.</span>
        </td>
    </tr>
    <tr class="ta-table-address">
        <th><label for="address">Address</label></th>

        <td>
            <input type="text" name="address" id="address"
                   value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('address', $user->ID)) : ''; ?>"
                   class="regular-text"/><br/>
            <span class="description">Please enter the parent's address.</span>
        </td>
    </tr>
    <tr class="ta-table-job">
        <th><label for="job">Place of Work</label></th>

        <td>
            <input type="text" name="job" id="job"
                   value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('job', $user->ID)) : ''; ?>"
                   class="regular-text"/><br/>
            <span class="description">Please enter the parent's Work Place.</span>
        </td>
    </tr>
    <tr class="ta-table-help">
        <th><label for="help">Help Type</label></th>

        <td>
            <?php is_object($user) ? $help = esc_attr(get_the_author_meta('help', $user->ID)) : $help = ''; ?>
            <select name="help">
                <option <?php echo $help == 'financial' ? 'selected="selected"' : ''; ?> value="financial">Financial</option>
                <option <?php echo $help == 'clothing' ? 'selected="selected"' : ''; ?> value="clothing">Clothing</option>
                <option <?php echo $help == 'requisites' ? 'selected="selected"' : ''; ?> value="requisites">Requisites</option>
                <option <?php echo $help == 'furniture' ? 'selected="selected"' : ''; ?> value="furniture">Furniture</option>
                <option <?php echo $help == 'other' ? 'selected="selected"' : ''; ?> value="other">Other</option>
            </select>
            <br/>
            <span class="description">Please enter the type of help.</span>
        </td>
    </tr>
    <tr class="ta-table-children">
        <th><label for="children">Children</label></th>
        <td>
            <input type="text" id="children" class="search_child regular-text" value=""><br/>
            <ul class="child-search-results" style="display: none;"></ul>
            <span class="description">Choose a child to add.</span>
        </td>
    </tr>

    <tr class="ta-table-added-children" style="<?php  echo is_object($user) && get_the_author_meta('children', $user->ID) ? 'display:table-row' : 'display: none'; ?>">
        <?php $children = get_the_author_meta('children', $user->ID); ?>
        <th><label for="added-children">Added Children</label></th>
        <td class="ta-children-list">
            <?php foreach($children as $child_id) {
                $child = get_post( $child_id ); ?>
                <li><?php echo $child->post_title ?> <a href="javascript:void(0)" class="remove-child">[x]</a><input type="hidden" name="children[]" value="<?php echo $child->ID; ?>"></li>
            <?php } ?>
        </td>
    </tr>
    <tr class="ta-table-anonymus">
        <th><label for="anonymus">Anonymus Parent</label></th>

        <td>
            <?php is_object($user) ? $anonymus = esc_attr(get_the_author_meta('anonymus', $user->ID)) : $anonymus = ''; ?>
            <input type="radio" <?php echo $anonymus == '0' ? 'checked="checked"' : ''; ?> name="anonymus" value="0"> Yes
            <input type="radio" <?php echo $anonymus == '1' ? 'checked="checked"' : ''; ?> name="anonymus" value="1"> No<br>
            <span class="description">Please choose if the parent wants to remain anonymus.</span>
        </td>
    </tr>
    <tr class="ta-table-has-children">
        <th><label for="has-children">Number of children</label></th>

        <td>
            <?php is_object($user) ? $has_children = esc_attr(get_the_author_meta('has_children', $user->ID)) : $has_children = '';  ?>
            <select name="has_children">
                <option <?php echo $has_children == '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
                <option <?php echo $has_children == '1' ? 'selected="selected"' : ''; ?> value="1">1</option>
                <option <?php echo $has_children == '2' ? 'selected="selected"' : ''; ?> value="2">2</option>
                <option <?php echo $has_children == '3' ? 'selected="selected"' : ''; ?> value="3">3</option>
                <option <?php echo $has_children == '4' ? 'selected="selected"' : ''; ?> value="4">4</option>
            </select>
            <br/>
            <span class="description">Please choose the number of children the parent has.</span>
        </td>
    </tr>
    <tr class="ta-table-status">
        <th><label for="status">Marital Status</label></th>

        <td>
            <?php is_object($user)  ? $married = esc_attr(get_the_author_meta('married', $user->ID)) : $married = ''; ?>
            <input type="radio" <?php echo $married == '0' ? 'checked="checked"' : ''; ?> name="married" value="0"> Not Married
            <input type="radio" <?php echo $married == '1' ? 'checked="checked"' : ''; ?> name="married" value="1"> Married<br>
            <span class="description">Please choose if the parent is married.</span>
        </td>
    </tr>
    <?php
}
        /**
         * Partners Fields
         */
        if((is_object($user) && in_array('partner', $user->roles)) || (is_object($user) && in_array('administrator', $user->roles)) || !is_object($user)) {
            ?>
            <tr id="pt-logo-cont" class="ta-table-logo">
                <th><label for="logo">Logo</label></th>

                <td>
                    <?php
                    is_object($user) && get_the_author_meta('logo', $user->ID) !== '' ? $src = esc_attr(get_the_author_meta('logo', $user->ID)) : $src = '';
                    ?>
                    <!-- Your image container, which can be manipulated with js -->
                    <div class="custom-img-container">
                        <?php if ( $src ) : ?>
                            <img src="<?php echo $src ?>" alt="" style="max-width:100%;" />
                        <?php endif; ?>
                    </div>
                    <!-- Your add & remove image links -->
                    <p class="hide-if-no-js" data-metaboxid="pt-logo-cont">
                        <a class="upload-custom-img <?php if ( $src  ) { echo 'hidden'; } ?>"
                           href="">
                            <?php _e('Set Partner Logo') ?>
                        </a>
                        <a class="delete-custom-img <?php if ( ! $src  ) { echo 'hidden'; } ?>"
                           href="#">
                            <?php _e('Remove Partner Logo') ?>
                        </a>
                    </p>
                    <!-- A hidden input to set and post the chosen image id -->
                    <input class="logo-url" name="logo" type="hidden" value="<?php echo esc_attr( $src ); ?>"

                </td>
            </tr>
            <tr class="ta-table-contact-name">
                <th><label for="contact-name">Contact Name</label></th>

                <td>
                    <input type="text" name="contact_name" id="contact-name"  value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('contact_name', $user->ID)) : ''; ?>" class="regular-text"/><br/>
                    <span class="description">Please enter the company contact name.</span>
                </td>
            </tr>
            <tr class="ta-table-contact-surname">
                <th><label for="contact-surname">Contact Surname</label></th>

                <td>
                    <input type="text" name="contact_surname" id="contact-surname"  value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('contact_surname', $user->ID)) : ''; ?>" class="regular-text"/><br/>
                    <span class="description">Please enter the company contact surname.</span>
                </td>
            </tr>
            <tr class="ta-table-contact-phone">
                <th><label for="contact-phone">Contact Phone</label></th>

                <td>
                    <input type="text" name="contact_phone" id="contact-phone"  value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('contact_phone', $user->ID)) : ''; ?>" class="regular-text"/><br/>
                    <span class="description">Please enter the contact phone.</span>
                </td>
            </tr>
            <tr class="ta-table-contact-function">
                <th><label for="contact-function">Contact Function</label></th>

                <td>
                    <input type="text" name="contact_function" id="contact-function"  value="<?php echo is_object($user) ? esc_attr(get_the_author_meta('contact_function', $user->ID)) : ''; ?>" class="regular-text"/><br/>
                    <span class="description">Please enter the company contact function.</span>
                </td>
            </tr>
        <?php } ?>
</table>