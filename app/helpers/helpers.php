<?php

/**
 * This function is used to display flash messages
 *
 * @param string $name The name of the flash message
 * @param string $message The message to be displayed
 * @param string $class The CSS class of the message box
 */
function flashMsg(string $name = '', string $message = '', string $class = 'alert alert-success') : void
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * Check if the user is logged in
 *
 * @return bool true if the user is logged in, false otherwise
 */
function isLoggedInUser(): bool
{
    if (isset($_SESSION['email'])) {
        return true;
    }

    return false;
}

/**
 * This function is used to redirect the user to a specific page
 *
 * @param string $page The page to be redirected to
 */
function redirect(string $page) : void
{
    header("Location: " . URLROOT . "/" . $page);
}

/**
 * This function is used to filter user input data
 *
 * @param array $type The input data to be filtered
 * @return array The filtered input data
 */
function filteration(array $type): array
{
    foreach ($type as $key => $value) {
        // Trim leading and trailing spaces
        $value = trim($value);
        // Remove backslashes
        $value = stripslashes($value);
        // Remove HTML tags
        $value = strip_tags($value);
        // Encode special characters in a string
        $value = htmlspecialchars($value);
        // Assign the filtered value back to the original array
        $type[$key] = $value;
    }
    return $type;
}

/**
 * This function is used to upload an image
 *
 * @param string $img_name The name of the image input field
 * @param string $path The path where the image should be uploaded
 * @return string The name of the uploaded image
 */
function imageUpload(string $img_name, string $path): string 
{
    $ext = pathinfo($_FILES[$img_name]['name'], PATHINFO_EXTENSION);
    $image = random_int(1111111, 9999999) . '.' . $ext;

    if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $path . $image)) {
        return $image;
    } else {
        flashMsg('success', 'Image Upload Error', 'alert-danger');
        return '';
    }
}