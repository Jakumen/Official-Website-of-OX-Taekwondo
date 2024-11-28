<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OX Taekwondo Martial Arts - Terms & Conditions</title>
    <link rel="stylesheet" href="../css/Med.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="../Photo/OX_LOGOO.png" alt="OX Taekwondo Martial Arts Logo" class="logo">
            <h1>OX TAEKWONDO MARTIAL ARTS</h1>
        </div>

        <div class="terms-title">
            <h2>Terms & Conditions</h2>
        </div>

        <form action="../PHP/medcert_upload.php" method="POST" enctype="multipart/form-data" id="termsForm">
            <div class="content">
                <h3>Parents Consent (For Minors)</h3>
                <ol>
                    <li>I voluntarily allow my son/daughter to participate in this training program.</li>
                    <li>I hereby certify that my son/daughter is physically fit to participate in this training program.</li>
                </ol>

                <h3>Certification & Waiver</h3>
                <p>
                    1. I hereby certify that all above information is true & correct.<br>
                    2. I release the instructors, organizers, and officials of the Philippine Taekwondo Association from any liability whatsoever, arising from any injury or damage which may be sustained during the training and waive any course of action relative thereto.
                </p>

                <div class="upload-section">
                    <label for="medical-certificate">Upload Medical Certificate *</label>
                    <input type="file" id="medical-certificate" name="medical_certificate" required>
                    <span>Note: Medical Certificate is REQUIRED to Register</span>
                </div>

                <div class="privacy-note">
                    <p><strong>[REPUBLIC ACT NO. 10173]</strong></p>
                    <p>An act protecting individual personal information in information and communications systems in the government and the private sector, creating for this purpose a National Privacy Commission, and for other purposes.</p>
                </div>

                <div class="terms-agreement">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I Agree to the Terms & Conditions</label>
                </div>

                <div class="buttons">
                    <button type="button" onclick="history.back()">Cancel</button>
                    <button type="submit" id="accept" class="accept" >Accept</button>
                </div>
            </div>
        </form>
    </div>
    <script src = "../script/script.js"></script>
</body>
</html>
