<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - NulliCarbon</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f3f4f6;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 40px 30px; text-align: center;">
                            <div style="font-size: 50px; margin-bottom: 15px;">🍃</div>
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">NulliCarbon</h1>
                            <p style="margin: 10px 0 0 0; color: #ffffff; font-size: 14px; opacity: 0.9;">Carbon Offset Platform</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="margin: 0 0 20px 0; color: #1f2937; font-size: 24px; font-weight: 600;">Reset Your Password</h2>
                            
                            <p style="margin: 0 0 15px 0; color: #4b5563; font-size: 15px; line-height: 1.6;">
                                Hello,
                            </p>
                            
                            <p style="margin: 0 0 15px 0; color: #4b5563; font-size: 15px; line-height: 1.6;">
                                You are receiving this email because we received a password reset request for your NulliCarbon account.
                            </p>

                            <p style="margin: 0 0 25px 0; color: #4b5563; font-size: 15px; line-height: 1.6;">
                                To reset your password, please click the button below:
                            </p>

                            <!-- Button -->
                            <table role="presentation" style="margin: 0 0 25px 0;">
                                <tr>
                                    <td style="border-radius: 25px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                        <a href="{{ $url }}" target="_blank" style="display: inline-block; padding: 14px 40px; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 16px;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 0 0 20px 0; border-radius: 6px;">
                                <p style="margin: 0; color: #92400e; font-size: 14px; line-height: 1.5;">
                                    <strong>⚠️ Important:</strong> This password reset link will expire in <strong>60 minutes</strong>.
                                </p>
                            </div>

                            <p style="margin: 0 0 15px 0; color: #4b5563; font-size: 14px; line-height: 1.6;">
                                If the button above doesn't work, copy and paste this link into your browser:
                            </p>

                            <div style="background-color: #f9fafb; padding: 12px; border-radius: 6px; margin: 0 0 20px 0; word-break: break-all;">
                                <a href="{{ $url }}" style="color: #10b981; text-decoration: none; font-size: 13px;">{{ $url }}</a>
                            </div>

                            <p style="margin: 0 0 15px 0; color: #4b5563; font-size: 14px; line-height: 1.6;">
                                If you did not request a password reset, no further action is required. Your password will remain unchanged.
                            </p>

                            <div style="border-top: 2px solid #e5e7eb; margin: 25px 0; padding-top: 25px;">
                                <p style="margin: 0 0 10px 0; color: #6b7280; font-size: 13px; line-height: 1.5;">
                                    <strong>Security Tips:</strong>
                                </p>
                                <ul style="margin: 0; padding-left: 20px; color: #6b7280; font-size: 13px; line-height: 1.7;">
                                    <li>Never share your password with anyone</li>
                                    <li>Use a strong and unique password</li>
                                    <li>Enable two-factor authentication for extra security</li>
                                    <li>Be cautious of phishing emails</li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 10px 0; color: #6b7280; font-size: 13px;">
                                Need help? Contact us at <a href="mailto:support@nullicarbon.com" style="color: #10b981; text-decoration: none;">support@nullicarbon.com</a>
                            </p>
                            
                            <div style="margin: 15px 0;">
                                <a href="#" style="display: inline-block; margin: 0 8px; color: #9ca3af; text-decoration: none; font-size: 18px;">📱</a>
                                <a href="#" style="display: inline-block; margin: 0 8px; color: #9ca3af; text-decoration: none; font-size: 18px;">🐦</a>
                                <a href="#" style="display: inline-block; margin: 0 8px; color: #9ca3af; text-decoration: none; font-size: 18px;">💼</a>
                            </div>

                            <p style="margin: 15px 0 0 0; color: #9ca3af; font-size: 12px;">
                                © {{ date('Y') }} NulliCarbon. All rights reserved.<br>
                                Jakarta, Indonesia
                            </p>

                            <p style="margin: 10px 0 0 0; color: #9ca3af; font-size: 11px;">
                                This email was sent to you because you requested a password reset.<br>
                                If you did not make this request, please contact our support team immediately.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>