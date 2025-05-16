Here’s a full `README.md` (or `setup-email.md`) you can use in your project to document how to set up PHPMailer with Gmail using an app password.

---

## 📧 PHPMailer Gmail SMTP Setup

This guide explains how to set up PHPMailer to send emails using a Gmail account with an **App Password**. This method is secure and ideal for production or testing environments where Gmail is used as an SMTP provider.

---

### ✅ Requirements

* PHP 7.2+
* [Composer](https://getcomposer.org/)
* A Gmail account with **2-Step Verification enabled**
* An **App Password** generated from your Google account

---

### 📦 Installation

Install PHPMailer using Composer:

```bash
composer require phpmailer/phpmailer
```

This will install PHPMailer into the `vendor/` directory and create the autoloader.

---

### 🛠️ Setup Gmail App Password

1. Go to [Google Account Security](https://myaccount.google.com/security).
2. Enable **2-Step Verification** if it's not already on.
3. Under "Signing in to Google", click **App Passwords**.
4. Choose **Mail** for the app and **Other** for the device name (e.g. `PHPMailer Script`).
5. Click **Generate** and copy the 16-character app password (no spaces).

---

### 📄 Example PHP Script

Create a file called `send_email.php` and paste this working example:

```php
<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Change to SMTP::DEBUG_OFF for production
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-email@gmail.com';      // ✅ Your Gmail address
    $mail->Password   = 'your-app-password';         // ✅ Your App Password from Google
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // or use PHPMailer::ENCRYPTION_STARTTLS
    $mail->Port       = 465;                         // Use 587 for STARTTLS

    // Recipients
    $mail->setFrom('your-email@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'Hello! This is a test email using <b>PHPMailer + Gmail SMTP</b>.';
    $mail->AltBody = 'Hello! This is a test email using PHPMailer + Gmail SMTP.';

    $mail->send();
    echo "✅ Message has been sent successfully\n";
} catch (Exception $e) {
    echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
}
```

---

### 🔄 Common Adjustments

| Option             | Notes                                                                   |
| ------------------ | ----------------------------------------------------------------------- |
| `$mail->Port`      | Use `587` with `ENCRYPTION_STARTTLS`, or `465` with `ENCRYPTION_SMTPS`. |
| `$mail->SMTPDebug` | Use `SMTP::DEBUG_OFF` for production environments.                      |
| HTML Emails        | Use `$mail->isHTML(true);` and set both `Body` and `AltBody`.           |

---

### ⚠️ Troubleshooting

* **SMTP Error: Could not authenticate**
  → Double-check that you're using the correct Gmail **App Password**, not your Google login password.

* **Gmail blocks sign-in attempt**
  → App passwords work only when **2FA is enabled** and login is done via the app password.

* **Firewall blocks SMTP**
  → Make sure your host/server allows outbound connections on ports 465 or 587.

---

### 📁 Minimal Files to Deploy

If you’re not using Composer autoload, you must include at least:

```
src/PHPMailer.php
src/SMTP.php
src/Exception.php
```

And load them manually:

```php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';
```

---

### 📬 Bonus: Test via CLI

You can test the email from terminal:

```bash
php send_email.php
```

---

### 🧹 Security Notes

* Never hard-code passwords into public repositories.
* Consider storing credentials in environment variables or a `.env` file.
* Use logging or database entries (not screen output) for production success/failure tracking.

---

Let me know if you’d like the same setup for Zoho, Outlook, Mailgun, or another SMTP provider.
