<?php
function setSessionTime($_timeSecond, $url = null, $return = null, $check_access = null, $renewTime = null)
{
    if ($check_access == null && $url != "") {
        header("Location: " . $url);
        exit;
    }

    if (!isset($_SESSION['ses_time_life'])) {
        $_SESSION['ses_time_life'] = time();
    }

    $data_back = 0; // Indicates session not cleared (0) or cleared (1)

    if (isset($_SESSION['ses_time_life']) && time() - $_SESSION['ses_time_life'] > $_timeSecond) {
        if (count($_SESSION) > 0) {
            // Unset all session variables or specific ones
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }

            // Example: unset specific session variables
            // unset($_SESSION['idno']);

            // Always unset the session time life
            unset($_SESSION['ses_time_life']);

            if ($return) {
                $data_back = 1;
                return $data_back;
            }

            // Redirect if URL is provided after unsetting session variables
            if ($url) {
                header("Location: " . $url);
                exit;
            }
        }
    } else {
        // Update session time to the current time if renewTime is set to true
        if ($renewTime == true) {
            $_SESSION['ses_time_life'] = time();
        }
        if ($return) {
            return $data_back;
        }
    }
}