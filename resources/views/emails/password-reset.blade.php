{{-- resources/views/emails/password-reset.blade.php --}}
@php
$appName = config('app.name');
// If you pass a prebuilt reset URL to the view, use $resetUrl.
// Otherwise you can build it here if you pass $token and $email:
// $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $email], false));
@endphp

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Reset password — {{ $appName }}</title>
</head>

<body style="margin:0;padding:0;background:#f4f4f5;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;color:#333;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5;padding:20px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:6px;overflow:hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="padding:20px;color:#0ec12f;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-size:20px;font-weight:600;">{{ $appName }}</td>

                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:10px 20px 16px;">
                            <h1 style="margin:0 0 12px 0;font-size:20px;font-weight:600;color:#111827;">Reset password</h1>
                            <p style="margin:0 0 20px 0;line-height:1.5;color:#374151;">
                                You recently asked to change your {{ $appName }} password. Click below to get started.
                            </p>


                            <!-- Button -->
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:18px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $url }}" style="display:inline-block;padding:12px 22px;background:#197bff;color:#ffffff;text-decoration:none;border-radius:6px;font-weight:600;">
                                            Reset password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:50px 0 12px 0;font-size:15px;color:#6b7280;line-height:1.5;">
                                If you did not request a password reset, please ignore this email.
                            </p>


                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:16px 20px 24px;background:#f9fafb;color:#9ca3af;font-size:12px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        © {{ date('Y') }} {{ $appName }}. All rights reserved.
                                    </td>
                                    <td align="right">
                                        <a href="{{ url('/') }}" style="color:#8a919c;text-decoration:none; font-size:12px;">Go to website</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>