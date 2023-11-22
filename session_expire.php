<?php
/*
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
*/
function setSessionTime($_timeSeconds, $url = null, $return = false, $check_access = null, $renewTime = null)
{
    // Redirect if access check is null and a URL is provided
    if ($check_access === null && $url !== null) {
        header("Location: " . $url);
        exit;
    }

    // Initialize session time if not set
    if (!isset($_SESSION['ses_time_life'])) {
        $_SESSION['ses_time_life'] = time();
    }

    $sessionCleared = false; // Indicates whether session is cleared (true) or not (false)

    // Check if the session has expired
    if (isset($_SESSION['ses_time_life']) && time() - $_SESSION['ses_time_life'] > $_timeSeconds) {
        if (!empty($_SESSION)) {
            // Clear all session variables
            $_SESSION = array();

            // Destroy the session
            session_destroy();

            // Clear the session cookie
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }

            $sessionCleared = true;

            if ($return) {
                return $sessionCleared;
            }

            // Redirect if URL is provided after clearing session variables
            if ($url) {
                header("Location: " . $url);
                exit;
            }
        }
    } else {
        // Update session time to the current time if renewTime is set to true
        if ($renewTime === true) {
            $_SESSION['ses_time_life'] = time();
        }
        if ($return) {
            return $sessionCleared;
        }
    }
}
