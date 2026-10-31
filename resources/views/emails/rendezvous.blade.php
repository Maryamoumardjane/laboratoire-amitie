<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre rendez-vous</title>
</head>
<body style="margin:0; padding:0; background-color:#eef1f7; font-family: Georgia, 'Times New Roman', serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#eef1f7; padding:40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 30px rgba(26,46,90,0.15);">

                <!-- EN-TÊTE avec logo -->
                <tr>
                    <td style="background: linear-gradient(135deg, #1a2e5a 0%, #0d1f3c 100%); padding:36px 40px; text-align:center;">

                        <!-- Logo (remplace l'URL par ton vrai logo) -->
                   <img src="cid:logo_laboratoire"
     alt="Logo Laboratoire de l'Amitié"
     width="90" height="90"
     style="border-radius:50%; border:3px solid rgba(255,255,255,0.2); margin-bottom:16px; display:block; margin-left:auto; margin-right:auto;">

                        <!-- Ligne décorative tricolore -->
                        <table width="180" cellpadding="0" cellspacing="0" style="margin:0 auto 16px;">
                            <tr>
                                <td width="60" height="4" style="background:#1a2e5a; border-radius:2px 0 0 2px;"></td>
                                <td width="60" height="4" style="background:#2e7d32;"></td>
                                <td width="60" height="4" style="background:#e65100; border-radius:0 2px 2px 0;"></td>
                            </tr>
                        </table>

                        <h1 style="margin:0 0 6px; color:#ffffff; font-size:24px; font-weight:700; letter-spacing:2px; text-transform:uppercase;">
                            Laboratoire de l'Amitié
                        </h1>
                        <p style="margin:0; color:rgba(255,255,255,0.65); font-size:13px; font-style:italic; letter-spacing:1px;">
                            Votre santé, notre engagement
                        </p>
                    </td>
                </tr>

                <!-- BANDEAU STATUT -->
                @php
                    $isConfirme = str_contains(strtolower($messageContent), 'confirm');
                    $isAnnule   = str_contains(strtolower($messageContent), 'annul');
                @endphp

                @if($isConfirme)
                <tr>
                    <td style="background:linear-gradient(90deg, #e8f5e9, #f1f8e9); padding:16px 40px; text-align:center; border-left:5px solid #2e7d32;">
                        <span style="color:#1b5e20; font-weight:700; font-size:15px; letter-spacing:0.5px;">
                            ✅ &nbsp; Rendez-vous Confirmé
                        </span>
                    </td>
                </tr>
                @elseif($isAnnule)
                <tr>
                    <td style="background:linear-gradient(90deg, #fbe9e7, #fff3e0); padding:16px 40px; text-align:center; border-left:5px solid #e65100;">
                        <span style="color:#bf360c; font-weight:700; font-size:15px; letter-spacing:0.5px;">
                            ❌ &nbsp; Rendez-vous Annulé
                        </span>
                    </td>
                </tr>
                @else
                <tr>
                    <td style="background:linear-gradient(90deg, #e3f2fd, #e8eaf6); padding:16px 40px; text-align:center; border-left:5px solid #1a2e5a;">
                        <span style="color:#1a2e5a; font-weight:700; font-size:15px; letter-spacing:0.5px;">
                            ℹ️ &nbsp; Mise à jour de votre rendez-vous
                        </span>
                    </td>
                </tr>
                @endif

                <!-- CORPS -->
                <tr>
                    <td style="padding:40px;">

                        <!-- Salutation -->
                        <p style="margin:0 0 24px; font-size:17px; color:#1a2e5a; font-weight:600;">
                            Bonjour <span style="color:#2e7d32;">{{ $rdv->nom }}</span>,
                        </p>

                        <!-- Message principal -->
                        <div style="background:#f8f9fc; border-left:4px solid #1a2e5a; border-radius:0 10px 10px 0; padding:18px 22px; margin-bottom:30px;">
                            <p style="margin:0; font-size:15px; color:#444; line-height:1.8;">
                                {!! $messageContent !!}
                            </p>
                        </div>

                        <!-- Carte détails -->
                        <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e0e6f0; border-radius:12px; overflow:hidden; margin-bottom:30px;">

                            <!-- Titre carte -->
                            <tr>
                                <td colspan="2" style="background:linear-gradient(90deg, #1a2e5a, #243b6e); padding:12px 20px;">
                                    <span style="color:#ffffff; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px;">
                                        📋 Détails du rendez-vous
                                    </span>
                                </td>
                            </tr>

                            <!-- Patient -->
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:14px 20px; color:#888; font-size:13px; width:40%; background:#fafbff;">
                                    👤 Patient
                                </td>
                                <td style="padding:14px 20px; color:#1a2e5a; font-weight:700; font-size:14px;">
                                    {{ $rdv->nom }}
                                </td>
                            </tr>

                            <!-- Examen -->
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:14px 20px; color:#888; font-size:13px; background:#fafbff;">
                                    🔬 Examen
                                </td>
                                <td style="padding:14px 20px; color:#1a2e5a; font-weight:700; font-size:14px;">
                                    {{ $rdv->examen->nom ?? 'Non spécifié' }}
                                </td>
                            </tr>

                            <!-- Date -->
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:14px 20px; color:#888; font-size:13px; background:#fafbff;">
                                    📅 Date
                                </td>
                                <td style="padding:14px 20px; color:#1a2e5a; font-weight:700; font-size:14px;">
                                    {{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }}
                                </td>
                            </tr>

                            <!-- Heure -->
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:14px 20px; color:#888; font-size:13px; background:#fafbff;">
                                    🕐 Heure
                                </td>
                                <td style="padding:14px 20px; color:#1a2e5a; font-weight:700; font-size:14px;">
                                    {{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}
                                </td>
                            </tr>

                            <!-- Statut -->
                            <tr>
                                <td style="padding:14px 20px; color:#888; font-size:13px; background:#fafbff;">
                                    📌 Statut
                                </td>
                                <td style="padding:14px 20px; font-weight:700; font-size:14px;
                                    color:{{ $isConfirme ? '#2e7d32' : ($isAnnule ? '#e65100' : '#1a2e5a') }}">
                                    @if($isConfirme) ✅ Confirmé
                                    @elseif($isAnnule) ❌ Annulé
                                    @else ⏳ En attente
                                    @endif
                                </td>
                            </tr>

                        </table>

                        <!-- Message de clôture -->
                        <p style="margin:0 0 6px; font-size:14px; color:#666; line-height:1.7;">
                            Pour toute question ou information complémentaire, n'hésitez pas à nous contacter.
                        </p>
                        <p style="margin:0; font-size:14px; color:#666;">
                            Cordialement,<br>
                            <strong style="color:#1a2e5a;">L'équipe du Laboratoire de l'Amitié</strong>
                        </p>

                    </td>
                </tr>

                <!-- SÉPARATEUR TRICOLORE -->
                <tr>
                    <td style="padding:0;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="33%" height="4" style="background:#1a2e5a;"></td>
                                <td width="34%" height="4" style="background:#2e7d32;"></td>
                                <td width="33%" height="4" style="background:#e65100;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- PIED DE PAGE -->
                <tr>
                    <td style="background:#f8f9fc; padding:24px 40px; text-align:center;">
                        <p style="margin:0 0 8px; font-size:13px; color:#666;">
                            📍 Yaoundé, Cameroun &nbsp;|&nbsp; 📞 675 85 82 39
                        </p>
                        
                        <p style="margin:0; font-size:11px; color:#aaa; font-style:italic;">
    Pour toute question, répondez directement à cet email.
</p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>