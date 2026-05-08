<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Cancelled - QuickBookApp</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:'Segoe UI', Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                       style="max-width:600px; width:100%; background-color:#ffffff;
                              border-radius:12px; overflow:hidden;
                              box-shadow:0 4px 24px rgba(0,0,0,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td align="center"
                            style="background: linear-gradient(135deg, #1a56db 0%, #1e40af 100%);
                                   padding:36px 40px;">
                            <h1 style="margin:0; color:#ffffff; font-size:26px;
                                       font-weight:700; letter-spacing:-0.5px;">
                                QuickBookApp
                            </h1>
                            <p style="margin:6px 0 0; color:#bfdbfe; font-size:13px;
                                      letter-spacing:0.5px; text-transform:uppercase;">
                                Appointment Update
                            </p>
                        </td>
                    </tr>

                    {{-- Hero --}}
                    <tr>
                        <td align="center" style="padding:44px 40px 24px;">
                            <div style="font-size:56px; line-height:1; margin-bottom:20px;">❌</div>
                            <h2 style="margin:0 0 10px; color:#111827; font-size:24px; font-weight:700;">
                                Your Appointment Has Been Cancelled
                            </h2>
                            <p style="margin:0; color:#6b7280; font-size:15px; line-height:1.6;">
                                The following appointment has been successfully cancelled.
                            </p>
                        </td>
                    </tr>

                    {{-- Details Box --}}
                    <tr>
                        <td style="padding:0 40px 36px;">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                   style="background-color:#fff5f5; border:1px solid #fecaca;
                                          border-radius:10px; overflow:hidden;">

                                {{-- Service --}}
                                <tr>
                                    <td style="padding:16px 24px; border-bottom:1px solid #fee2e2;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color:#9ca3af; font-size:12px;
                                                           font-weight:600; text-transform:uppercase;
                                                           letter-spacing:0.5px; width:35%;">
                                                    Service
                                                </td>
                                                <td style="color:#111827; font-size:15px; font-weight:600;">
                                                    {{ $appointment->service->service_name }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                {{-- Date --}}
                                <tr>
                                    <td style="padding:16px 24px; border-bottom:1px solid #fee2e2;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color:#9ca3af; font-size:12px;
                                                           font-weight:600; text-transform:uppercase;
                                                           letter-spacing:0.5px; width:35%;">
                                                    Date
                                                </td>
                                                <td style="color:#111827; font-size:15px; font-weight:600;">
                                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, M j Y') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                {{-- Time --}}
                                <tr>
                                    <td style="padding:16px 24px; border-bottom:1px solid #fee2e2;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color:#9ca3af; font-size:12px;
                                                           font-weight:600; text-transform:uppercase;
                                                           letter-spacing:0.5px; width:35%;">
                                                    Time
                                                </td>
                                                <td style="color:#111827; font-size:15px; font-weight:600;">
                                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                {{-- Provider --}}
                                <tr>
                                    <td style="padding:16px 24px; border-bottom:1px solid #fee2e2;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color:#9ca3af; font-size:12px;
                                                           font-weight:600; text-transform:uppercase;
                                                           letter-spacing:0.5px; width:35%;">
                                                    Provider
                                                </td>
                                                <td style="color:#111827; font-size:15px; font-weight:600;">
                                                    {{ $appointment->service->owner->name }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                {{-- Status --}}
                                <tr>
                                    <td style="padding:16px 24px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color:#9ca3af; font-size:12px;
                                                           font-weight:600; text-transform:uppercase;
                                                           letter-spacing:0.5px; width:35%;">
                                                    Status
                                                </td>
                                                <td>
                                                    <span style="display:inline-block;
                                                                 background-color:#fee2e2;
                                                                 color:#b91c1c;
                                                                 font-size:13px; font-weight:700;
                                                                 padding:4px 12px;
                                                                 border-radius:20px;
                                                                 text-transform:uppercase;
                                                                 letter-spacing:0.5px;">
                                                        Cancelled
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    {{-- Message --}}
                    <tr>
                        <td align="center" style="padding:0 40px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                   style="background-color:#fffbeb; border:1px solid #fde68a;
                                          border-radius:8px; padding:0;">
                                <tr>
                                    <td style="padding:18px 24px;">
                                        <p style="margin:0; color:#92400e; font-size:14px; line-height:1.7; text-align:center;">
                                            Your appointment has been cancelled.<br>
                                            If you have any questions, please contact us or
                                            <a href="#" style="color:#1a56db; text-decoration:none; font-weight:600;">
                                                book a new appointment
                                            </a>
                                            through QuickBookApp.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td align="center"
                            style="background-color:#f9fafb; border-top:1px solid #e5e7eb;
                                   padding:24px 40px;">
                            <p style="margin:0; color:#9ca3af; font-size:12px;">
                                © {{ date('Y') }} QuickBookApp. All rights reserved.
                            </p>
                            <p style="margin:6px 0 0; color:#d1d5db; font-size:11px;">
                                This is an automated message, please do not reply.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
