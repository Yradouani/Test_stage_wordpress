<?php

/**
 * Visions Nouvelles functions.
 *
 * @package testdevwp
 */

/**
 * Only edit this variable.
 * Replace this with theme option getter function.
 *
 * These fields are used in this file:
 * default_contact_name
 * default_contact_email
 * default_contact_mail_cc
 * default_contact_mail_bcc
 * g_recaptcha_secret
 * thank_you_body_code
 * thank_you_page
 * after_body_code
 * footer_code
 * meta_author
 * meta_reply_to
 * meta_copyright
 * meta_owner
 */
$options_function = 'test_opt';

/**
 * Check required values from post values.
 *
 * @param array $requires Posted fields.
 * @param bool $sanitize Sanitize field or not.
 *
 * @return array|bool|null
 */
function vn_check_req_values($requires = array(), $sanitize = false)
{
    $sanitize_array = array();
    foreach ($requires as $key => $value) {
        $check_type = false;
        if (is_array($value)) {
            $check_type = true;
        }

        $result = (!$check_type) ? vn_isset_value_and_not_empty($value, array(), $sanitize) : vn_isset_value_and_not_empty($key, $value, $sanitize);

        if (!$result) {
            return null;
        } else {
            if ($sanitize) {
                if ($check_type) {
                    $sanitize_array[$key] = $result;
                } else {
                    $sanitize_array[$value] = $result;
                }
            }
        }
    }

    return (is_array($sanitize_array)) ? $sanitize_array : true;
}

/**
 * Check whatever is value not empty and isset.
 *
 * @param string $input Field key.
 * @param array $type_check Field type.
 * @param bool $sanitize Sanitize field or not.
 *
 * @return bool|mixed|string
 */
function vn_isset_value_and_not_empty($input, $type_check = array(), $sanitize = false)
{
    $result = false;
    $result = (isset($_POST[$input]) && $_POST[$input] != '') ? $_POST[$input] : $result; // phpcs:ignore
    $result = (isset($_FILES[$input]) && $_FILES[$input] != '') ? $input : $result; // phpcs:ignore

    if (empty($result)) {
        return false;
    }

    return (empty($type_check)) ? $result : vn_check_type($result, $type_check, $sanitize);
}

/**
 * Check posted field type.
 *
 * @param string $input Field.
 * @param array $type_check Field type.
 * @param bool $sanitize Sanitize field or not.
 *
 * @return bool|mixed|string
 */
function vn_check_type($input, $type_check, $sanitize = false)
{
    $return = true;
    if (isset($type_check['type'])) {
        switch ($type_check['type']) {
            case 'email':
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    $return = false;
                } else {
                    $return = ($sanitize) ? sanitize_email($input) : true;
                }
                break;

            case 'textarea':
                $return = ($sanitize) ? sanitize_textarea_field($input) : true;
                break;

            case 'int':
                $return = $input;
                break;

            case 'file':
                if (vn_check_type_file($input, $type_check)) {
                    if ($sanitize) {
                        if (!function_exists('wp_handle_upload')) {
                            require_once ABSPATH . 'wp-admin/includes/file.php';
                        }
                        $file = $_FILES[$input]; // phpcs:ignore

                        $upload_overrides = array('test_form' => false);
                        $return = wp_handle_upload($file, $upload_overrides);
                        if (!$return || isset($return['error'])) {
                            $message = __('Bad file type.', 'navi-france');
                            wp_send_json_error(array('message' => $message));
                        }
                        $return = $return['file'];
                    } else {
                        $return = true;
                    }
                } else {
                    $return = false;
                }
                break;

            default:
                wp_send_json_error(array('message' => 'Type <span>' . $type_check['type'] . '</span> does not exist.'));
                break;
        }
    } elseif ($sanitize) {
        $return = sanitize_text_field($_POST[$input]); // phpcs:ignore
    }

    return $return;
}

/**
 * Check posted file type.
 *
 * @param string $input Field.
 * @param array $type_check Field type.
 *
 * @return bool|mixed|string
 */
function vn_check_type_file($input, $type_check)
{
    if (!empty($type_check['min_size']) && $_FILES[$input]['size'] <= $type_check['min_size']) { // phpcs:ignore
        return false;
    }

    if (!empty($type_check['max_size']) && $_FILES[$input]['size'] >= $type_check['max_size']) { // phpcs:ignore
        return false;
    }

    return true;
}

/**
 * Generate email fields from options.
 *
 * @return array
 */
function vn_mail_fields()
{
    global $options_function;

    $contact_name_opt = call_user_func($options_function, 'default_contact_name');
    $contact_email_opt = call_user_func($options_function, 'default_contact_email');
    $contact_mail_cc_opt = call_user_func($options_function, 'default_contact_mail_cc');
    $contact_mail_bcc_opt = call_user_func($options_function, 'default_contact_mail_bcc');

    $name = !empty($contact_name_opt) ? $contact_name_opt : '';
    $email = !empty($contact_email_opt) ? $contact_email_opt : get_option('admin_email');

    $cc_fields = !empty($contact_mail_cc_opt) ? $contact_mail_cc_opt : '';
    $bcc_fields = !empty($contact_mail_bcc_opt) ? $contact_mail_bcc_opt : '';

    $cc = array();
    $cc_fields_array = explode(',', $cc_fields);
    if (is_array($cc_fields_array)) {
        foreach ($cc_fields_array as $cc_field) {
            if (is_email($cc_field)) {
                $cc[] = $cc_field;
            }
        }
    }

    $bcc = array();
    $bcc_fields_array = explode(',', $bcc_fields);
    if (is_array($bcc_fields_array)) {
        foreach ($bcc_fields_array as $bcc_field) {
            if (is_email($bcc_field)) {
                $bcc[] = $bcc_field;
            }
        }
    }

    $fields = array(
        'name' => $name,
        'email' => $email,
        'cc' => $cc,
        'bcc' => $bcc,
    );

    return $fields;
}
