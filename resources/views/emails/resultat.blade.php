<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#eef1f7; font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
    <tr><td align="center">
        <table width="600" cellpadding="0" cellspacing="0"
               style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 8px 30px rgba(26,46,90,0.15);">

            <!-- EN-TÊTE -->
            <tr>
                <td style="background:linear-gradient(135deg,#1a2e5a,#0d1f3c); padding:36px 40px; text-align:center;">
                    <img src="cid:logo_laboratoire" width="80" height="80"
                         style="border-radius:50%; margin-bottom:16px; display:block; margin-left:auto; margin-right:auto;">
                    <h1 style="margin:0; color:#fff; font-size:22px;">Laboratoire de l'Amitié</h1>
                    <p style="margin:6px 0 0; color:rgba(255,255,255,0.65); font-size:13px;">
                        Vos résultats sont disponibles
                    </p>
                </td>
            </tr>

            <!-- CORPS -->
            <tr>
                <td style="padding:40px;">
                    <p style="font-size:17px; color:#1a2e5a; font-weight:600;">
                        Bonjour <span style="color:#2e7d32;">{{ $rdv->nom }}</span>,
                    </p>
                    <p style="color:#555; font-size:15px; line-height:1.7;">
                        Vos résultats d'analyse sont maintenant disponibles.<br>
                        Utilisez le code ci-dessous pour les télécharger.
                    </p>

                    <!-- CODE -->
                    <div style="text-align:center; margin:30px 0;">
                        <p style="color:#888; font-size:13px; margin-bottom:8px;">Votre code de téléchargement</p>
                        <div style="background:#1a2e5a; color:#fff; font-size:32px; font-weight:700;
                                    letter-spacing:8px; padding:20px 40px; border-radius:12px;
                                    display:inline-block;">
                            {{ $code }}
                        </div>
                    </div>

                    <!-- BOUTON -->
                    <div style="text-align:center; margin:24px 0;">
                        <a href="{{ url('/resultats/telecharger') }}"
                           style="background:linear-gradient(135deg,#2e7d32,#1b5e20); color:#fff;
                                  padding:14px 32px; border-radius:30px; text-decoration:none;
                                  font-weight:700; font-size:15px;">
                            📥 Télécharger mes résultats
                        </a>
                    </div>

                    <p style="color:#888; font-size:13px; text-align:center;">
                        ⚠️ Ce code est personnel et confidentiel. Ne le partagez pas.
                    </p>

                    <p style="color:#666; font-size:14px;">
                        Cordialement,<br>
                        <strong style="color:#1a2e5a;">L'équipe du Laboratoire de l'Amitié</strong>
                    </p>
                </td>
            </tr>

            <!-- PIED -->
            <tr>
                <td style="background:#f8f9fc; padding:20px 40px; text-align:center;
                            border-top:1px solid #e0e0e0;">
                    <p style="margin:0; font-size:12px; color:#aaa;">
                        📍 Yaoundé, Cameroun &nbsp;|&nbsp; 📞 675 85 82 39
                    </p>
                </td>
            </tr>

        </table>
    </td></tr>
</table>
</body>
</html>